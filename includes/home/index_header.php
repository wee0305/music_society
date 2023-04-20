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
   
   Filename: index_header.php

-->
<!-- Header -->
<header class="position-relative">            
    <nav class="navbar navbar-expand-lg fixed-top" id="contact">
        <div class="container-fluid">
            <!--logo-->
            <a href="index.php" class="nav-brand">
                <img class="rounded logo" src="images/music_society_logo.png" alt="music society logo"/>
            </a>

            <!-- become a icon when the screen become small -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bg-light rounded"></span>
            </button>

            <!-- Nav -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" href="index_about_us.php">About Us</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" href="index_member.php">Members</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" href="index.php#musicPhilosophy">Music Philosophy</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" href="#contactus">Contact Us</a>
                    </li>

                    <!-- dropdown -->
                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" href="index_event_activity.php" >Events & Activities</a>
                    </li>

                    <!-- login -->
                    <li class="nav-item px-3">
                        <a class="btn btn-primary px-3" href="index_login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    echo "<h1 class='position-absolute d-flex'>$pageTitle</h1>";
    ?>

</header>
