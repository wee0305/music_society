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
        $Gender = $student->Gender;
        $Faculty = $student->Faculty;
        $Programme = $student->Programme;
        $Interest = $student->Interest;
        $StudentEmail = $student->StudentEmail;
        $Contact = $student->Contact;
        $DateOfBirth = $student->DOB;
    }
}

if (isset($_FILES['memberImg'])) {
    global $avatar;
    $AvatarErr = $_FILES['memberImg']['error'];
    $AvatarName = $_FILES['memberImg']['name'];

    if ($AvatarErr == 0) {
        if ($avatar != "avatar.jpg") {
            $oldAvatar = "images/member_avatar/$avatar";

            if (file_exists($oldAvatar)) {
                unlink($oldAvatar);
            }
        }

        $image = pathinfo($AvatarName);
        $ext = $image['extension'];
        $AvatarName = $msID . "." . $ext;
        if (move_uploaded_file($_FILES['memberImg']['tmp_name'], "images/member_avatar/{$AvatarName}")) {
            $memberAvatar = $AvatarName;
        }

        $editCommand = "UPDATE member SET MemberAvatar = '$memberAvatar' WHERE StudentID = '$msID'";
        mysqli_query($dbConnection, $editCommand);
        echo "<script>alert('Profile picture has been updated.')</script>";
        echo "<script>window.location.href='member_profile.php';</script>";
    }
}
?>

<article class="text-center justify-content-center pt-5">
    <div class="bg-content">
        <div class="profile">
            <div class="left">
                <label class="editAvatar" for="memberImg" id="editAvatar">
                    <img src="./images/member_avatar/<?php echo $avatar; ?>" class="rounded-circle avatarImg" alt="<?php echo $avatar ?>"/>
                    <form action="" method="POST" enctype="multipart/form-data" title="Click to edit the profile picture" id="editAvatar">
                        <div class="editLink">
                            <span class="material-symbols-outlined camera">photo_camera</span>
                            <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" name="memberImg" style="display: none;" id="memberImg"/>
                        </div>
                    </form>
                </label>

                <h4><?php echo $LastName . ' ' . $FirstName; ?></h4> <!-- fname and lname -->
                <h6><?php echo $msID ?></h6> <!-- student id -->
                <h6><?php echo $Faculty ?></h6> <!-- Faculty -->
            </div>
            <div class="right">
                <div class="info">
                    <h3>Information</h3>
                    <div class="info_data">
                        <div class="data">
                            <h4>Email</h4>
                            <h6><?php echo $StudentEmail ?></h6><!-- Email -->
                        </div>
                    </div>
                    <div class="info_data">
                        <div class="data">
                            <h4>Programme</h4>
                            <h6><?php echo $Programme ?></h6> 
                        </div>
                    </div>
                </div>

                <div class="personal-part">
                    <h3>Personal Particulars</h3>
                    <div class="prog_data">
                        <div class="data">
                            <h4>Phone</h4>
                            <h6><?php echo $Contact ?></h6>
                        </div>
                    </div>
                    <div class="prog_data">
                        <div class="data">
                            <h4>Interest</h4>
                            <h6><?php echo $Interest ?></h6>
                        </div>
                    </div> 
                    <div class="prog_data">
                        <div class="data">
                            <h4>Day of Birth</h4>
                            <h6><?php echo $DateOfBirth ?></h6>
                        </div>
                    </div>     
                </div>
            </div> 
        </div>
        <button type="button" onclick="window.location.href = 'member_edit_profile.php'" class="btn btn-edit" title="Click here proceed to edit profile">Edit Profile</button>
        <button type="button" onclick="window.location.href = 'member_change_password.php'" class="btn btn-psw" title="Click here proceed to change password">Change Password</button>
    </div>
</article>

