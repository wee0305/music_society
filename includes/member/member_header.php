<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Chang Ching We
   Date: 09/08/2022
   
   Filename: member_header.php

-->

<!-- Header -->
<header class="position-relative">            
    <nav class="navbar navbar-expand-lg fixed-top" id="contact">
        <div class="container-fluid">
            <!--logo-->
            <a href="member_dashboard.php" class="nav-brand" >
                <img class="rounded" width="30% object-fit:cover;" src="images/music_society_logo.png" alt="music society logo"/>
            </a>

            <!-- become a icon when the screen become small -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon rounded"></span>
            </button>

            <!-- Nav -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" aria-current="page" href="member_dashboard.php">Home</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" aria-current="page" href="member_enrollment_list.php">My Enrollment</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" aria-current="page" href="member_catalogue.php">Events & Activities</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="btn btn-outline-light px-3 border-0" aria-current="page" href="member_faqs.php">FAQs</a>
                    </li>

                </ul>

                <!-- avatar -->
                <ul class="dropdownAvatar">
                    <a class="dropdownBtn" id="avatar">
                        <?php
                        $avatar = "";
                        $memCommand = "SELECT * FROM member WHERE StudentID = '$msID'";
                        $result = mysqli_query($dbConnection, $memCommand);
                        while ($memberRow = mysqli_fetch_array($result)) {
                            $avatar = $memberRow['MemberAvatar'];
                            $lname = $memberRow['LastName'];
                            $fname = $memberRow['FirstName'];
                        }
                        ?>
                        <img src="images/member_avatar/<?php echo $avatar ?>" class="rounded-circle" style="width: 50px; height: 50px;" alt="avatar" />
                    </a>
                    <div class="dropdownContent memberDrop">
                        <div class="personal">
                            <table style="border: none; background-color: transparent;">
                                <tr style="border: none;">Personal</tr>
                                <tr style="border: none;">
                                    <td rowspan="2" style="border: none; padding: 5px;"><img src="images/member_avatar/<?php echo $avatar ?>" class="rounded-circle" style="width: 100px; height: 100px;" alt="avatar" /></td>
                                    <?php echo "<td style='border: none; padding: 5px; font-size: 18px; font-weight: normal;'>$lname $fname</td>"; ?>
                                </tr>
                            </table>
                        </div>
                        <a href="member_profile.php"><span class="material-symbols-outlined">person</span>Profile</a>
                        <a href="member_change_password.php"><span class="material-symbols-outlined">password</span>Change Password</a>
                        <a href="includes/logout.php" onclick="return confirm('Proceed to log-out your account?')"><span class="material-symbols-outlined">logout</span>Log Out</a>
                    </div>
                </ul>

            </div>
        </div>
    </nav>

    <?php
    echo "<h1 class='position-absolute d-flex'>" . $headTitle . "</h1>";
    ?>
</header>
