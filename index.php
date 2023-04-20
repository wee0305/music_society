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
   
   Filename: index_head.php

-->

<?php
include './includes/msDBConnect.php';
$expireCommand = "SELECT * FROM event WHERE Status = 'AL'";
$result = mysqli_query($dbConnection, $expireCommand);
while ($row = mysqli_fetch_array($result)) {

    $eId = $row['EventID'];
    $sDate = $row['StartDate'];
    $eImg = $row['EventImg'];

    //check the end date of the event
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date = NEW DateTime('now');
    if ($date->format('Y-m-d') > $row['EndDate']) {
        $dropCommand = "UPDATE `event` SET `Status`='NA' WHERE EventID = '$eId'";
        mysqli_query($dbConnection, $dropCommand);
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
        <link href="css/index_header.css" rel="stylesheet"/>
        <link href="css/index_article.css" rel="stylesheet"/> 
        <link href="css/footer.css" rel="stylesheet"/>

        <style>
            html{
                scroll-behavior: smooth;
            }
        </style>

    </head>


    <body>
        <?php
        $pageTitle = "DIVE IN WITH MUSIC";
        include './includes/home/index_header.php';

        //article
        include './includes/home/index_article.php';

        //footer
        include './includes/home/footer.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    </body>
</html>