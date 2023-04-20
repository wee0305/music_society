<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Eric Chee Wei Jiat
   Date: 8/9/2022
   
   Filename: register_details_article.php

-->

<!-- php code -->
<?php
if (isset($_GET['eID']) && isset($_GET['sID']) && isset($_GET['regId']) && isset($_GET['tID'])) {
    $eID = trim($_GET['eID']);
    $sID = trim($_GET['sID']);
    $regId = trim($_GET['regId']);
    $tID = trim($_GET['tID']);

    $evntCommand = "SELECT * FROM event E, admin A, register R, payment P, member M WHERE E.AdminID = A.AdminID AND A.AdminID = '$msID' AND E.EventID = R.EventID AND M.StudentID = R.StudentID AND M.StudentID = '$sID' AND E.EventID = '$eID' AND P.TransID = R.TransID AND P.TransID = '$tID'";

    $evntResult = mysqli_query($dbConnection, $evntCommand);

    if ($evntResult->num_rows == 1) {
        $evntDetail = mysqli_fetch_object($evntResult);

        //student details
        $fname = $evntDetail->FirstName;
        $lname = $evntDetail->LastName;
        $email = $evntDetail->StudentEmail;
        $contact = $evntDetail->Contact;
        $faculty = $evntDetail->Faculty;
        $programme = $evntDetail->Programme;
        $interest = $evntDetail->Interest;
        $gender = $evntDetail->Gender;
        $dob = $evntDetail->DOB;
        $avatarMem = $evntDetail->MemberAvatar;

        //register details
        $regDate = $evntDetail->RegDate;
        $regStatus = $evntDetail->RegStatus;
        $seatNo = $evntDetail->SeatNo;

        //payment details
        $card = $evntDetail->CardHolder;
        $cardNo = $evntDetail->CardNo;
        $expMonth = $evntDetail->ExpMonth;
        $expYear = $evntDetail->ExpYear;
        $cvv = $evntDetail->CVV;
        $amount = $evntDetail->TransAmt;

        //event
        $status = $evntDetail->Status;
    }
}
?>
<article class="text-center justify-content-center pt-5">

    <h1 class="title d-block">Student Details</h1>

    <!-- student details -->
    <div class="container d-flex justify-content-center mb-5">

        <!-- Student Avatar -->
        <div class="avatar">
            <img src="images/member_avatar/<?php echo $avatarMem ?>" class="memAvatar" alt="<?php echo $avatarMem ?>"/>
            <h4>Student Profile Picture</h4>
        </div>

        <!-- Students details -->
        <table class="mb-2 sDetails">
            <tr>
                <td>
                    <img src="images/member_avatar/<?php echo $avatarMem ?>" class="pMemAvatar" alt="<?php echo $avatarMem ?>"/> 
                    <h4 class="avatarDesc">Student Profile Picture</h4>
                </td>
            </tr>
            <tr>
                <td class="input-group mt-3 mb-3">
                    <label for="studentID" class="input-group-text">
                        <span class="material-symbols-outlined">person</span>
                        Student ID
                    </label>
                    <input class="form-control" type="text" name="studentID" id="studentID" value="<?php echo $sID; ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="studentname" class="input-group-text">
                        <span class="material-symbols-outlined">badge</span>
                        Student Name
                    </label>
                    <input class="form-control" type="text" name="studentname" id="studentname" value="<?php echo "$lname" . " " . "$fname"; ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="email" class="input-group-text">
                        <span class="material-symbols-outlined">mail</span>
                        Student Email
                    </label>
                    <input class="form-control" type="text" name="email" id="email" value="<?php echo $email ?>" disabled="true"/>
                </td>
            </tr>

            <tr>
                <td class="input-group mb-3">
                    <label for="contact" class="input-group-text">
                        <span class="material-symbols-outlined">phone</span>
                        Contact
                    </label>
                    <input class="form-control" type="text" name="contact" id="contact" value="<?php echo $contact ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3 pGender">
                    <label for="gender" class="input-group-text">
                        <span class="material-symbols-outlined" style="padding: 0px">male</span>
                        <span class="material-symbols-outlined" style="padding: 0px">female</span>
                        Gender
                    </label>
                    <input class="form-control" type="text" name="gender" id="gender" value="<?php echo ($gender == "M") ? "Male" : "Female" ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="faculty" class="input-group-text">
                        <span class="material-symbols-outlined">apartment</span>
                        Faculty
                    </label>
                    <input class="form-control" type="text" name="faculty" id="faculty" value="<?php echo $faculty ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="programme" class="input-group-text">
                        <span class="material-symbols-outlined">import_contacts</span>
                        Programme
                    </label>
                    <input class="form-control" type="text" name="programme" id="programme" value="<?php echo $programme ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="interest" class="input-group-text">
                        <span class="material-symbols-outlined">interests</span>
                        Interest
                    </label>
                    <input class="form-control" id="interest" type="text" value="<?php echo $interest ?>" name="interest" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="dob" class="input-group-text">
                        <span class="material-symbols-outlined">celebration</span>
                        Date Of Birth
                    </label>
                    <input class="form-control" type="text" name="dob" id="dob" value="<?php echo $dob ?>" disabled="true"/>
                </td>
            </tr>
        </table>
    </div>

    <h1 class="title d-block">Event Registration Details</h1>

    <!-- Payment and register details -->
    <div class="container justify-content-center mb-5 prDetails">

        <!-- register details -->
        <table class="mb-2 rDetails">
            <tr>
                <th>Register Details</th>
            </tr>
            <tr>
                <td class="input-group mt-3 mb-1">
                    <label for="regID" class="input-group-text">
                        <span class="material-symbols-outlined">app_registration</span>
                        Register ID
                    </label>
                    <input class="form-control" type="text" name="regID" id="regID" value="<?php echo $regId; ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-1">
                    <label for="regDate" class="input-group-text">
                        <span class="material-symbols-outlined">edit_calendar</span>
                        Register Date
                    </label>
                    <input class="form-control" type="text" name="regDate" id="regDate" value="<?php echo $regDate; ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-1">
                    <label for="regStatus" class="input-group-text">
                        <span class="material-symbols-outlined">legend_toggle</span>
                        Register Status
                    </label>
                    <input class="form-control" type="text" name="regStatus" id="regStatus" value="<?php echo $regStatus ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-5">
                    <label for="seat" class="input-group-text">
                        <span class="material-symbols-outlined">chair_alt</span>
                        Seat No
                    </label>
                    <input class="form-control" type="text" name="seat" id="seat" value="<?php echo ($seatNo != "" || $seatNo != null) ? $seatNo : "Not applicable" ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
        </table>

        <!-- payment details -->
        <table class="mb-2 pDetails">
            <tr>
                <th>Payment Details</th>
            </tr>
            <tr>
                <td class="input-group mt-3 mb-3">
                    <label for="tID" class="input-group-text">
                        <span class="material-symbols-outlined">receipt_long</span>
                        Transaction ID
                    </label>
                    <input class="form-control" type="text" name="tID" id="tID" value="<?php echo $tID; ?>" disabled="true"/>
                    <label for="cvv" class="input-group-text">
                        <span class="material-symbols-outlined">password</span>
                        CVV
                    </label>
                    <input class="form-control" type="text" name="cvv" id="cvv" value="<?php echo $cvv; ?>" disabled="true"/>
                </td>
            </tr>

            <tr>
                <td class="input-group mb-3">
                    <label for="card" class="input-group-text">
                        <span class="material-symbols-outlined">person</span>
                        Card Holder
                    </label>
                    <input class="form-control" type="text" name="card" id="card" value="<?php echo $card ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="cardNo" class="input-group-text">
                        <span class="material-symbols-outlined">credit_card</span>
                        Card No
                    </label>
                    <input class="form-control" type="text" name="cardNo" id="cardNo" value="<?php echo $cardNo ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="exp" class="input-group-text">
                        <span class="material-symbols-outlined">pending_actions</span>
                        Card Expiry
                    </label>
                    <input class="form-control" type="text" name="exp" id="exp" value="<?php echo $expMonth . " " . $expYear; ?>" disabled="true"/>
                </td>
            </tr>
            <tr>
                <td class="input-group mb-3">
                    <label for="amount" class="input-group-text">
                        <span class="material-symbols-outlined">paid</span>
                        Transaction Amount
                    </label>
                    <input class="form-control" type="text" name="amount" id="amount" value="<?php echo "RM" . $amount . ".00"; ?>" disabled="true"/>
                </td>
            </tr>
        </table>
    </div>


    <div class="btnGroup">
        <button class="button back" onclick="location.href = 'admin_list_register.php?eID=<?php echo $eID ?>'" type="button"><span class="material-symbols-outlined">undo</span>BACK</button>
        <?php
        $eType = substr($eID, 0, 2);
        if ($status == "AL" && $regStatus == "AC" && $eType == "CC") {
            echo "<td class='st'><button class='button back'><span class='material-symbols-outlined'>paid</span>$tID</button></td>";
            echo '<td class="st"><button class="button delete" type="button" '
            . 'onclick="return confirm (\'Are you sure want to cancel the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_cancel_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
            . '<span class="material-symbols-outlined">close</span></button></td>';
        } else if ($status == "AL" && ($eType == "CP" || $eType == "WS")) {
            if ($regStatus == "AC") {
                echo '<td class="st" colspan="2"><button class="button delete" type="button" '
                . 'onclick="return confirm (\'Are you sure want to cancel the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_cancel_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                . '<span class="material-symbols-outlined">close</span></button></td>';
            } else if ($regStatus == "PD") {
                echo '<td class="st"><button class="button confirm" type="button" '
                . 'onclick="return confirm (\'Are you sure want to accept the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_add_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                . '<span class="material-symbols-outlined">check</span></button></td>';
                echo '<td class="st"><button class="button delete" type="button" '
                . 'onclick="return confirm (\'Are you sure want to reject the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_cancel_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                . '<span class="material-symbols-outlined">close</span></button></td>';
            } else if ($regStatus == "RJ") {
                echo '<td class="st" colspan="2"><button class="button readd" type="button" '
                . 'onclick="return confirm (\'Are you sure want to add the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_add_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                . '<span class="material-symbols-outlined">add_circle</span></button></td>';
            } else {
                echo '<td class="st"><a class="button disabled" type="button" disabled="true"><span class="material-symbols-outlined">block</span>CANCEL</a></td>';
            }
        } else {
            echo '<td class="st" colspan="2"><a class="button disabled" type="button" disabled="true"><span class="material-symbols-outlined">block</span></a></td>';
        }
        ?>
        <button class="button print" onclick="window.print()" title="Click here to Print" type="button"><span class="material-symbols-outlined">print</span>PRINT</button>
    </div>
</article>



