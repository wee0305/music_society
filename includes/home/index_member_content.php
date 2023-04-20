<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author: Wong Jia He
   Date: 10/8/2022
   
   Filename: index_member_content.php

-->

<article>
    <div>
        <section section class="member">
            <div class="main">
                <div class="member-text">
                    <h1>Member</h1>
                    <h5>Benefits <a><span>of Member</span></a></h5>
                    <p>Members of our club can participate in various activities held by us, 
                        and can also receive free teaching. There is no membership fee for our members.</p>
                </div>
            </div>
        </section>
    </div>
    <!-- Member Registration -->
    <div class="content ">
        <div class="content_container">
            <?php
            if (isset($_POST['btn_sub'])) {
                $AvatarErr = $_FILES['memberImg']['error'];
                $AvatarName = $_FILES['memberImg']['name'];
                $FirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : "";
                $LastName = isset($_POST['LastName']) ? $_POST['LastName'] : "";
                $Faculty = isset($_POST['Faculty']) ? trim($_POST['Faculty']) : "";
                $Programme = isset($_POST['Programme']) ? trim($_POST['Programme']) : "";
                $StudentID = isset($_POST['StudentID']) ? trim($_POST['StudentID']) : "";
                $Interest = isset($_POST['Interest']) ? trim($_POST['Interest']) : "";
                $StudentEmail = isset($_POST['StudentEmail']) ? trim($_POST['StudentEmail']) : "";
                $Contact = isset($_POST['Contact']) ? trim($_POST['Contact']) : "";
                $Gender = isset($_POST['Gender']) ? trim($_POST['Gender']) : "";
                $DateOfBirth = isset($_POST['DateOfBirth']) ? trim($_POST['DateOfBirth']) : "";
                $Password = isset($_POST['Password']) ? trim($_POST['Password']) : "";
                $ConfPsw = isset($_POST['ConfPsw']) ? trim($_POST['ConfPsw']) : "";

                $errMsgFirstName = validateFirstName($FirstName);   // $pattern = "/^[A-Za-z ]+$/"; and cant > 30 characters
                $errMsgLastName = validateLastName($LastName);      // $pattern = "/^[A-Za-z ]+$/"; and cant > 30 characters
                $errMsgProgramme = validateProgramme($Programme);   // $pattern = "/^[D][A-Z]{2}{Y}[1-3][S][1-3]$/"; and cant > 7 characters
                $errMsgStudentID = validateStudentID($StudentID);   // $pattern = "/^[0-9]{2}[A-Z]{3}[0-9]{5}$/"; and cant > 10 characters
                $errMsgStudentEmail = validateStudentEmail($StudentEmail); // $pattern = "/^[A-za-z -]+$/"; and cant > 30 chararcters
                $errMsgContact = validateContact($Contact);         // $pattern = "/^[0-9-]+$/"; and cant > 12 characters
                $errMsgPassword = validatePassword($Password);      // $pattern = "/^[A-Za-z0-9@?]{8,12}$/"; and cant > 12 characters
                $errMsgConfPassword = validateConfPassword($Password, $ConfPsw);
                // Join all arrays of error messages into one big array.
                $finalErrMessage = array_merge(array_merge(array_merge(array_merge(array_merge(array_merge(array_merge($errMsgFirstName, $errMsgLastName), $errMsgProgramme), $errMsgStudentID), $errMsgStudentEmail), $errMsgContact), $errMsgPassword), $errMsgConfPassword);

                // If the form is error free, then register the user
                if (count($finalErrMessage) > 0) {
                    echo "<div class='err_msg'>";
                    echo "<h4>Error Message!!!</h4>";
                    foreach ($finalErrMessage as $message) {
                        echo "<ul>$message</ul>";
                    }
                    echo "</div>";
                } else {
                    if ($AvatarErr == 0) {
                        $image = pathinfo($AvatarName);
                        $ext = $image['extension'];
                        $AvatarName = $StudentID . "." . $ext;
                        if (move_uploaded_file($_FILES['memberImg']['tmp_name'], "images/member_avatar/{$AvatarName}")) {
                            $memberAvatar = $AvatarName;
                        }
                    } else {
                        $memberAvatar = "avatar.jpg";
                    }

                    // Inserting data into table
                    $insertCommand = "INSERT INTO member (StudentID, FirstName, LastName, Password, MemberAvatar, Faculty, Programme, Interest, StudentEmail, Contact, Gender, DOB)"
                            . "VALUES ('$StudentID', '$FirstName', '$LastName', '$Password', '$memberAvatar', '$Faculty', '$Programme', '$Interest', '$StudentEmail', '$Contact', '$Gender', '$DateOfBirth')";

                    $result = mysqli_query($dbConnection, $insertCommand);

                    echo "<script>alert('You account has been successfully registered.')</script>";
                    echo "<script>window.location.href='index_login.php'</script>";
                }
            }
            ?>
            <h2>MEMBER REGISTRATION</h2>
            <form action="" method="POST" id="submitMember" enctype="multipart/form-data">
                <table>
                    <!-- Insert Guest's Personal Information -->
                    <tr>
                        <td >Avatar</td>
                        <td>:</td>
                        <td class="uploadImg">
                            <label for="memberImg" class="form-control text-center eImg">
                                <span class="material-symbols-outlined">imagesmode</span><br/>
                                <p style="margin-bottom: 0px;" id="word">Upload Avatar</p>
                                <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" name="memberImg" style="display: none;" id="memberImg" onchange="loadFile(event)"/>
                                <img id="output" style="width: 50%; height: 50%; margin-left: auto; margin-right: auto; border-radius: 50%;" src="images/member_avatar/avatar.jpg" title="avatar"/>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>First name</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="FirstName" maxlength="30" id="fname" placeholder="Mei Ling" required="true" value="<?php echo isset($_POST['FirstName']) ? $_POST['FirstName'] : ""; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="LastName" maxlength="30" id="lname" placeholder="Lim" required="true" value="<?php echo isset($_POST['LastName']) ? $_POST['LastName'] : ""; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Faculty</td>
                        <td>:</td>
                        <td><div class="selection">
                                <div class="faculty">
                                    <select class="form-select" name="Faculty" id="faculty" required="true"> 
                                        <option selected>Select from list</option>
                                        <option value="FOSS" <?php echo isset($_POST['Faculty']) == "FOSS" ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOSS") ?></option>
                                        <option value="FOAS" <?php echo isset($_POST['Faculty']) == "FOAS" ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOAS") ?></option>
                                        <option value="FOBE" <?php echo isset($_POST['Faculty']) == "FOBE" ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOBE") ?></option>
                                        <option value="FOCS" <?php echo isset($_POST['Faculty']) == "FOCS" ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOCS") ?></option>
                                        <option value="FOET" <?php echo isset($_POST['Faculty']) == "FOET" ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FOET") ?></option>
                                        <option value="FAFB" <?php echo isset($_POST['Faculty']) == "FAFB" ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FAFB") ?></option>
                                        <option value="FCCI" <?php echo isset($_POST['Faculty']) == "FCCI" ? "selected='true'" : ""; ?>><?php echo getFacultyFullName("FCCI") ?></option>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Programme</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="Programme" maxlength="7" id="programme" placeholder="DFTY1S1" required="true" value="<?php echo isset($_POST['Programme']) ? $_POST['Programme'] : ""; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Student ID</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="StudentID" maxlength="10" id="stud_id" placeholder="21WMD00000" required="true" value="<?php echo isset($_POST['StudentID']) ? $_POST['StudentID'] : ""; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Interest</td>
                        <td>:</td>
                        <td>
                            <div class="selection">
                                <div class="interest">
                                    <select name="Interest" id="interest" required="true">
                                        <option selected>Select a music type</option>
                                        <option value="jazz" <?php echo isset($_POST['Interest']) == "jazz" ? "selected='true'" : ""; ?>>Jazz</option>
                                        <option value="hipPop" <?php echo isset($_POST['Interest']) == "hiphop" ? "selected='true'" : ""; ?>>Hip Hop</option>
                                        <option value="classical" <?php echo isset($_POST['Interest']) == "classical" ? "selected='true'" : ""; ?>>Classical</option>
                                        <option value="popular" <?php echo isset($_POST['Interest']) == "popular" ? "selected='true'" : ""; ?>>Popular</option>
                                        <option value="soul" <?php echo isset($_POST['Interest']) == "soul" ? "selected='true'" : ""; ?>>Soul</option>
                                        <option value="country music" <?php echo isset($_POST['Interest']) == "country music" ? "selected='true'" : ""; ?>>Country Music</option>
                                        <option value="latin" <?php echo isset($_POST['Interest']) == "latin" ? "selected='true'" : ""; ?>>Latin</option>
                                        <option value="rhythmAndBlues" <?php echo isset($_POST['Interest']) == "rhythmAndBlues" ? "selected='true'" : ""; ?>>Rhythm and blues</option>
                                        <option value="electronic" <?php echo isset($_POST['Interest']) == "electronic" ? "selected='true'" : ""; ?>>Electronic</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Email</td>
                        <td>:</td>
                        <td>
                            <input type="email" name="StudentEmail" id="email" placeholder="alimz@student.tarc.edu.my" required="true" value="<?php echo isset($_POST['StudentEmail']) ? $_POST['StudentEmail'] : ""; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Contact No.</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="Contact" id="tel" placeholder="012-3456789" required="true" value="<?php echo isset($_POST['Contact']) ? $_POST['Contact'] : ""; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td>
                            <input type="radio" name="Gender" id="Male" value="M"><label for="Male"> Male</label>
                            <input type="radio" name="Gender" id="Female" value="F"><label for="Female"> Female</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>:</td>
                        <td>
                            <input type="date" name="DateOfBirth" id="DateOfBirth" value="<?php echo isset($_POST['DateOfBirth']) ? $_POST['DateOfBirth'] : ""; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td>
                            <input type="password" name="Password" maxlength="12" id="password" placeholder="Please enter password" required="true"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>:</td>
                        <td>
                            <input type="password" name="ConfPsw" maxlength="12" id="confPsw" placeholder="Please re-enter again" required="true"/>
                        </td>
                    </tr>
                    <th colspan="3" id="rg_right">
                        <p>Already have account？<a href="index_login.php" id="login">Login Now!</a></p>
                    </th>
                </table>
                <div class="button_style">
                    <input type="submit" name="btn_sub" id="btn_sub" value="Sign Up"/>
                    <input type="reset" name="btn_reset" id="btn_reset" value="Reset"/>
                </div>
            </form>
        </div>
    </div>
</article>