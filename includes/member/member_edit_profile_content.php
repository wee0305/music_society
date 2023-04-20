<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Wong Jia He
   Date: 10/08/2022
   
   Filename: member_profile_content.php

-->
<?php
if (isset($_SESSION['msId'])) {

    $selectCommand = "SELECT * FROM member WHERE StudentID = '$msID'";

    $result = mysqli_query($dbConnection, $selectCommand);

    //using error to access object
    if ($result->num_rows == 1) {
        $student = mysqli_fetch_object($result);

        $avatar = $student->MemberAvatar;
        $FirstName = $student->FirstName;
        $LastName = $student->LastName;
        $Programme = $student->Programme;
        $Interest = $student->Interest;
        $Faculty = $student->Faculty;
        $StudentEmail = $student->StudentEmail;
        $Contact = $student->Contact;
    }
}
?>

<article class="text-center justify-content-center pt-5">
    <div class="bg-content pb-5">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="profile">
                <div class="left">
                    <label class="editAvatar" for="memberImg" id="editAvatar" title="Click to edit the profile picture">
                        <img src="./images/member_avatar/<?php echo $avatar; ?>" class="rounded-circle avatarImg" id="output"/>
                        <div class="editLink">
                            <span class="material-symbols-outlined camera">photo_camera</span>
                            <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" name="memberImg" style="display: none;" id="memberImg" onchange="loadFile(event)"/>
                        </div>
                    </label>
                    <h6>Click to edit the profile picture</h6>
                    <?php
                    if (isset($_POST['btnEdit'])) {

                        global $avatar;
                        $AvatarErr = $_FILES['memberImg']['error'];
                        $AvatarName = $_FILES['memberImg']['name'];
                        $FirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : "";
                        $LastName = isset($_POST['LastName']) ? $_POST['LastName'] : "";
                        $Faculty = isset($_POST['Faculty']) ? trim($_POST['Faculty']) : "";
                        $Programme = isset($_POST['Programme']) ? trim($_POST['Programme']) : "";
                        $Interest = isset($_POST['Interest']) ? trim($_POST['Interest']) : "";
                        $StudentEmail = isset($_POST['StudentEmail']) ? trim($_POST['StudentEmail']) : "";
                        $Contact = isset($_POST['Contact']) ? trim($_POST['Contact']) : "";

                        $errMsgFirstName = validateFirstName($FirstName);
                        $errMsgLastName = validateLastName($LastName);
                        $errMsgProgramme = validateProgramme($Programme);
                        $errMsgStudentEmail = validateStudentEmail($StudentEmail);
                        $errMsgContact = validateContact($Contact);

                        $finalErrMessage = array_merge(array_merge(array_merge($errMsgFirstName, $errMsgLastName), $errMsgProgramme), $errMsgStudentEmail, $errMsgContact);

                        if (count($finalErrMessage) > 0) {
                            echo "<div class='error'>";
                            echo "<h4>Error Message!!!</h4>";
                            $total = 1;
                            foreach ($finalErrMessage as $message) {
                                echo "<ul>$total.$message</ul>";
                                $total++;
                            }
                            echo "</div>";
                        } else {
                            if ($AvatarErr == 0) {
                                if ($AvatarName != "avatar.jpg") {
                                    $oldAvatar = "images/member_avatar/$avatar";

                                    if (file_exists($oldAvatar)) {
                                        unlink($oldAvatar);
                                    }

                                    $image = pathinfo($AvatarName);
                                    $ext = $image['extension'];
                                    $AvatarName = $msID . "." . $ext;
                                    if (move_uploaded_file($_FILES['memberImg']['tmp_name'], "images/member_avatar/{$AvatarName}")) {
                                        $memberAvatar = $AvatarName;
                                    }
                                } else {
                                    $image = pathinfo($AvatarName);
                                    $ext = $image['extension'];
                                    $AvatarName = $msID . "." . $ext;
                                    if (move_uploaded_file($_FILES['memberImg']['tmp_name'], "images/member_avatar/{$AvatarName}")) {
                                        $memberAvatar = $AvatarName;
                                    }
                                }
                            } else {
                                $memberAvatar = $avatar;
                            }

                            $editCommand = "UPDATE `member` SET `FirstName`='$FirstName',`LastName`='$LastName', `MemberAvatar`='$memberAvatar',`Faculty`='$Faculty',`Programme`='$Programme',`Interest`='$Interest',`StudentEmail`='$StudentEmail',`Contact`='$Contact' WHERE StudentID = '$msID'";
                            mysqli_query($dbConnection, $editCommand);
                            echo "<script>alert('Profile details has been updated.')</script>";
                            echo "<script>window.location.href='member_profile.php';</script>";
                        }
                    }
                    ?>
                </div>
                <div class="right">
                    <div class="info_data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fname" name="FirstName" value="<?php echo $FirstName; ?>" placeholder="Mei Ling"/>
                            <label for="fname">First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lname" name="LastName" value="<?php echo $LastName; ?>" placeholder="Lim"/>
                            <label for="lname">Last Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Programme" name="Programme" value="<?php echo $Programme; ?>" placeholder="DFTY1S1"/>
                            <label for="Programme">Programme</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="Interest" id="interest">
                                <option selected>Select a music type</option>
                                <option value="jazz" <?php echo ($Interest == "jazz") ? "selected='true'" : ""; ?>>Jazz</option>
                                <option value="hipPop" <?php echo ($Interest == "hiphop") ? "selected='true'" : ""; ?>>Hip Hop</option>
                                <option value="classical" <?php echo ($Interest == "classical") ? "selected='true'" : ""; ?>>Classical</option>
                                <option value="popular" <?php echo ($Interest == 'popular') ? "selected='true'" : ""; ?>>Popular</option>
                                <option value="soul" <?php echo ($Interest == "soul") ? "selected='true'" : ""; ?>>Soul</option>
                                <option value="country music" <?php echo ($Interest == "country music") ? "selected='true'" : ""; ?>>Country Music</option>
                                <option value="latin" <?php echo ($Interest == "latin") ? "selected='true'" : ""; ?>>Latin</option>
                                <option value="rhythmAndBlues" <?php echo ($Interest == "rhythmAndBlues") ? "selected='true'" : ""; ?>>Rhythm and blues</option>
                                <option value="electronic" <?php echo ($Interest == "electronic") ? "selected='true'" : ""; ?>>Electronic</option>
                            </select>
                            <label for="interest">Interest</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="Faculty" id="faculty"> 
                                <option selected>Select from list</option>
                                <option value="FOSS" <?php echo ($Faculty == "FOSS") ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOSS") ?></option>
                                <option value="FOAS" <?php echo ($Faculty == "FOAS") ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOAS") ?></option>
                                <option value="FOBE" <?php echo ($Faculty == "FOBE") ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOBE") ?></option>
                                <option value="FOCS" <?php echo ($Faculty == "FOCS") ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOCS") ?></option>
                                <option value="FOET" <?php echo ($Faculty == "FOET") ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOET") ?></option>
                                <option value="FAFB" <?php echo ($Faculty == "FAFB") ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FAFB") ?></option>
                                <option value="FCCI" <?php echo ($Faculty == "FCCI") ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FCCI") ?></option>
                            </select>
                            <label for="faculty">Faculty</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="StudentEmail" value="<?php echo $StudentEmail; ?>" placeholder="alimz@student.tarc.edu.my"/>
                            <label for="email">Student Email</label>
                        </div>
                        <div class="form-floating pb-3">
                            <input type="text" class="form-control" id="contact" name="Contact" value="<?php echo $Contact; ?>" placeholder="012-3456789"/>
                            <label for="contact">Contact No</label>
                        </div>

                    </div>
                    
                </div> 
            </div>
            <button type="submit" name="btnEdit" class="btn btn-edit" title="Click here to edit profile">Edit</button>
            <button type="button" onclick="window.location.href = 'member_profile.php'" class="btn btn-back" title="Click here to return previous page">Back</button>
        </form>
    </div>
</article>

