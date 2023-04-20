<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author: Wong Jia He
   Date: 10/8/2022
   
   Filename: member_faqs.php

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
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/navbar.css" rel="stylesheet"/>
        <link href="css/style_member_header.css" rel="stylesheet"/>
        <link href="css/style_member_dashboard.css" rel="stylesheet"/>
        <link href="css/style_member_faqs.css" rel="stylesheet"/>
        <link href="css/footer.css" rel="stylesheet"/>

        <style>
            html{
                scroll-behavior: smooth;
            }
        </style>
    </head>

    <body>
        <?php
        $headTitle = "FREQUENLY ASKED QUESTIONS";
        include './includes/member/member_header.php';
        include './includes/member/member_faqs_content.php';
        include './includes/member/member_footer.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    </body>
</html>
