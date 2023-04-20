<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<!--
   Web System
    
   Music Society
   Author:Leong Kuan Fei
   Date: 27/7/2022
   
   Filename: login.php

-->

<!-- login -->
<?php
//connect music society db
include './includes/msDBConnect.php';

$msId = $psw = $errMsgID = $errMsgPsw = "";

if (isset($_POST['login'])) {

    $msId = isset($_POST['msId']) ? trim($_POST['msId']) : null;
    $psw = isset($_POST['psw']) ? trim($_POST['psw']) : null;
    $adminSql = "SELECT AdminID, Password FROM admin WHERE AdminID = '$msId' AND Password = '$psw'";
    $memberSql = "SELECT StudentID, Password FROM member WHERE StudentID = '$msId' AND Password = '$psw'";

    //id
    if ($msId == "" || $msId == null) {
        $errMsgID = "* Please enter your id!";
    }

    if ($psw == "" || $psw == null) {
        $errMsgPsw = "* Please enter your password!";
    }

    $test = "";
    //if errMsg is empty, then proceed to this, else will display error message
    if (empty($errMsgID) && empty($errMsgPsw)) {
        //combine string and num to one variable
        $id = substr($msId, 0, 2);

        //check whether is admin login or member login
        if ($id == "AD") { //admin login
            $sql = mysqli_query($dbConnection, $adminSql);
            $row = mysqli_fetch_assoc($sql);
            if (mysqli_num_rows($sql) === 1) {
                if ($row['AdminID'] === $msId && $row['Password'] === $psw) {
                    session_start();
                    $_SESSION['msId'] = $_POST['msId'];
                    $msID = $_SESSION['msId'];
                    $name = $fname = $lname = "";
                    $selectCommand = "SELECT LName, FName FROM admin WHERE AdminID = '$msID'";
                    $result = mysqli_query($dbConnection, $selectCommand);
                    while ($name = mysqli_fetch_array($result)) {
                        $fname = $name['FName'];
                        $lname = $name['LName'];
                    }
                    echo "<script>alert('Welcome Admin $lname $fname')</script>";
                    echo "<script type='text/javascript'>window.location.replace('admin_dashboard.php') </script>";
                } else {
                    $errMsgID = "* Invalid ID!";
                    $errMsgPsw = "* Invalid Password!";
                }
            } else {
                $errMsgID = "* Invalid ID!";
                $errMsgPsw = "* Invalid Password!";
            }
        } else { //member login
            $sql = mysqli_query($dbConnection, $memberSql);
            $row = mysqli_fetch_assoc($sql);
            if (mysqli_num_rows($sql) === 1) {
                if ($row['StudentID'] === $msId && $row['Password'] === $psw) {
                    session_start();
                    $_SESSION['msId'] = $_POST['msId'];
                    $msID = $_SESSION['msId'];
                    $name = $fname = $lname = "";
                    $selectCommand = "SELECT LastName, FirstName FROM member WHERE StudentID = '$msID'";
                    $result = mysqli_query($dbConnection, $selectCommand);
                    while ($name = mysqli_fetch_array($result)) {
                        $fname = $name['FirstName'];
                        $lname = $name['LastName'];
                    }
                    echo "<script>alert('Welcome $lname $fname')</script>";
                    echo "<script type='text/javascript'>window.location.replace('member_dashboard.php') </script>";
                } else {
                    $errMsgID = "* Invalid ID!";
                    $errMsgPsw = "* Invalid Password!";
                }
            } else {
                $errMsgID = "* Invalid ID!";
                $errMsgPsw = "* Invalid Password!";
            }
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Music Society</title>

        <!-- icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <!-- Favicons -->
        <link href="images/music_society_logo.png" rel="icon" />

        <!-- style -->
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/navbar.css" rel="stylesheet"/>
        <link href="css/login.css" rel="stylesheet"/> 
        <link href="css/footer.css" rel="stylesheet"/>

        <style>
            html{
                scroll-behavior: smooth;
            }
        </style>

    </head>
    <body>
        <?php
        //page title
        $pageTitle = null;

        //header
        include './includes/home/index_header.php';

        //article
        include './includes/login/login_form.php';

        //footer
        include './includes/home/footer.php';
        ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

</body>
</html>
<?php
//close connect
mysqli_close($dbConnection);
?>