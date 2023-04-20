<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author: Wong Jia He
   Date: 10/8/2022
   
   Filename: member_change_password_content.php

-->

<article class="text-center justify-content-center pt-5 pb-5">

    <div class="bg-content">
        <form action="" method="POST">
            <table class="change">
                <?php
                if (isset($_POST['btnSubmit'])) {
                    $CPassword = isset($_POST['currentPsw']) ? trim($_POST['currentPsw']) : "";
                    $NPassword = isset($_POST['newPsw']) ? trim($_POST['newPsw']) : "";
                    $ConfPsw = isset($_POST['confirmPsw']) ? trim($_POST['confirmPsw']) : "";

                    $errMsgCPassword = validateCPassword($CPassword);
                    $errMsgNPassword = validateNPassword($NPassword);
                    $errMsgConfPassword = validateConfPassword($ConfPsw, $NPassword);

                    $finalErrMsg = array_merge(array_merge($errMsgCPassword, $errMsgNPassword), $errMsgConfPassword);

                    if (count($finalErrMsg) > 0) {
                        echo "<div class='error'>";
                        echo "<h4>Error Message!!!</h4>";
                        echo "<ul>";
                        foreach ($finalErrMsg as $message) {
                            echo "<li>$message</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    } else {

                        $updateCommand = "UPDATE member SET Password = '$NPassword' WHERE StudentID = '$msID'";
                        $result = mysqli_query($dbConnection, $updateCommand);

                        echo "<script>alert('Password has been updated.')</script>";
                        echo "<script>window.location.href='member_profile.php'</script>";
                    }
                }
                ?>
                <tr>
                    <td colspan="3" style="border-bottom: 1px solid grey;"><h2>Change Password</h2></td>
                </tr>
                <tr>
                    <td>Current Password</td>
                    <td>:</td>
                    <td>
                        <input type="password" name="currentPsw" id="currentPsw" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>:</td>
                    <td>
                        <input type="password" name="newPsw" id="newPsw" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>:</td>
                    <td>
                        <input type="password" name="confirmPsw" id="confirmPsw" placeholder="Confirm Password">
                    </td>
                </tr>
            </table>
            <div class="btn-grp">
                <input class="btn_info" type="submit" value="Save" name="btnSubmit" title="Click here to change password"/>
                <a class="btn_reset" type="button" href="member_profile.php" name="btnReset" title="Click here to cancel action">Cancel</a>
            </div>
        </form>
    </div>
</article>
