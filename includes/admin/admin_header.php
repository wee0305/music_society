<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<!--
   Web System
    
   Music Society
   Author:Leong Kuan Fei
   Date: 7/8/2022
   
   Filename: admin_header.php

-->

<!-- Header -->
<header class="position-relative">            
    <nav class="navbar navbar-expand-lg fixed-top" id="contact">
        <div class="container-fluid">
            <!--logo-->
            <a href="admin_dashboard.php" class="nav-brand">
                <img class="rounded" width="30% object-fit:cover;" src="images/music_society_logo.png" alt="music society logo"/>
            </a>

            <!-- become a icon when the screen become small -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bg-light rounded"></span>
            </button>

            <!-- Nav -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" aria-current="page" href="admin_dashboard.php">Home</a>
                    </li>

                    <!-- dropdown -->
                    <li class="nav-item dropdown-center px-3">
                        <button class="btn btn-outline-light dropdown-toggle px-3 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                            Event Management
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin_add_event.php"><span class="material-symbols-outlined">add</span>Add New Event / Activity</a></li>
                            <li><a class="dropdown-item" href="admin_list_event.php"><span class="material-symbols-outlined">manage_search</span>Search / View</a></li>
                        </ul>
                    </li>

                </ul>
                <!-- avatar -->
                <div class="dropdownAvatar navAvatar">
                    <a class="dropdownBtn" id="avatar">
                        <?php
                        $avatar = "";
                        $adCommand = "SELECT * FROM admin WHERE AdminID = '$msID'";
                        $result = mysqli_query($dbConnection, $adCommand);
                        while ($adminRow = mysqli_fetch_array($result)) {
                            $avatar = $adminRow['AdminAvatar'];
                            $lname = $adminRow['LName'];
                            $fname = $adminRow['FName'];
                        }
                        ?>
                        <img src="images/admin_avatar/<?php echo $avatar ?>" class="rounded-circle" style="width: 50px; height: 50px;" alt="avatar" />
                    </a>
                    <div class="dropdownContent adminDrop">
                        <div class="personal">
                            <table style="border: none;">
                                <tr style="border: none;">Personal</tr>
                                <tr style="border: none;">
                                    <td rowspan="2" style="border: none; padding: 5px;"><img src="images/admin_avatar/<?php echo $avatar ?>" class="rounded-circle" style="width: 100px; height: 100px;" alt="avatar" /></td>
                                    <?php echo "<td style='border: none; padding: 5px; font-size: 18px; font-weight: normal;'>$lname $fname</td>"; ?>
                                </tr>
                            </table>
                        </div>
                        <a href="includes/logout.php" onclick="return confirm('Proceed to log-out your account?')"><span class="material-symbols-outlined">logout</span>Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <?php
    echo "<h1 class='position-absolute d-flex'>$pageTitle</h1>";
    ?>


</header>