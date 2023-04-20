<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Eric Chee Wei Jiat
   Date: 8/9/2022
   
   Filename: admin_booking_details.php

-->
<?php
//session start
include './includes/session.php';
$msID = $_SESSION['msId'];
include './includes/msDBConnect.php';
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
        <link href="css/admin_button.css" rel="stylesheet"/>
        <link href="css/admin_form.css" rel="stylesheet"/>
        <link href="css/admin_details.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/navbar.css" rel="stylesheet"/>
        <link href="css/admin_header.css" rel="stylesheet"/>
        <link href="css/footer.css" rel="stylesheet"/>
        <link href="css/admin_print.css" rel="stylesheet" type="text/css" media="print"/>

        <style>
            html{
                scroll-behavior: smooth;
            }
        </style>

    </head>
    <body>
        <?php
        //header
        $pageTitle = "STUDENT REGISTER DETAILS"; //put your page title
        include './includes/admin/admin_header.php';

        //article
        include './includes/admin/register/register_details_article.php';

        //footer
        include './includes/dashboard_footer.php';
        ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="js/img.js"></script>
</body>
</html>

<?php
//close connect
mysqli_close($dbConnection);
?>