<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Chang Ching We
   Date: 09/08/2022
   Filename: member_payment_content.php

-->

<?php
//workshop register when user click to register the workshop on member catalogue page
if (isset($_GET['eid'])) {
    $regId = isset($_GET['rgid']) ? $_GET['rgid'] : "";
    $eID = isset($_GET['eid']) ? $_GET['eid'] : "";

    $eType = substr($eID, 0, 2);

    if ($eType == "CC" || $eType == "WS") {
        $capacitySQL = "SELECT * FROM event WHERE EventID = '$eID'";
        $cp = mysqli_query($dbConnection, $capacitySQL);
        while ($row = mysqli_fetch_array($cp)) {
            $pax = $row['Capacity'];
        }

        $regPax = 0;
        $countPax = "SELECT * FROM event E, register R WHERE R.RegStatus = 'AC' AND E.EventID = R.EventID AND E.EventID = '$eID'";
        $cpax = mysqli_query($dbConnection, $countPax);
        while ($row = mysqli_fetch_array($cpax)) {
            $regPax++;
        }

        if ($regPax >= $pax) {
            echo "<script>alert('Sorry, this event has been fully register.')</script>";
            echo "<script>window.location.href='member_catalogue.php'</script>";
        }
    }

    if ($eID == "" || $eID == null) {
        echo "<h1 style='color: red;'>Warning! you are not allow to enter this page!<br/>Please contact to the admin for help!</h1>";
        exit();
    }

    $checkCommand = "SELECT * FROM event WHERE EventID LIKE 'WS%' OR EventID LIKE 'CC%' OR EventID LIKE 'CP%'";
    $result = mysqli_query($dbConnection, $checkCommand);
    $correct = false;
    while ($check = mysqli_fetch_array($result)) {
        $cID = $check['EventID'];

        if ($eID == $cID) {
            $correct = true;
        }
    }

    if ($correct == false) {
        echo "<h1 style='color: red;'>Warning! you are not allow to enter this page!<br/>Please contact to the admin for help!</h1>";
        exit();
    }
}

//check concert's seat no, if user dont select seat, back to the seat selection page
if (isset($_POST['btnConfirm'])) {
    $seatNo = isset($_POST['seatNo']) ? trim($_POST['seatNo']) : "";
    $eID = isset($_POST['eid']) ? trim($_POST['eid']) : "";
    $regId = isset($_POST['rgid']) ? $_POST['rgid'] : "";

    if ($seatNo == "" || $seatNo == null) {
        echo "<script>alert('Please select the seat no!')</script>";
        echo "<script>history.back()</script>";
    }

    $capacitySQL = "SELECT * FROM event WHERE EventID = '$eID'";
    $cp = mysqli_query($dbConnection, $capacitySQL);
    while ($row = mysqli_fetch_array($cp)) {
        $pax = $row['Capacity'];
    }

    $regPax = 0;
    $countPax = "SELECT * FROM event E, register R WHERE R.RegStatus = 'AC' AND E.EventID = R.EventID AND E.EventID = '$eID'";
    $cpax = mysqli_query($dbConnection, $countPax);
    while ($row = mysqli_fetch_array($cpax)) {
        $regPax++;
    }

    if ($regPax >= $pax) {
        echo "<script>alert('Sorry, this event has been fully register.')</script>";
        echo "<script>window.location.href='member_catalogue.php'</script>";
    }
}

//concert and workshop register and proceed payment
if (isset($_POST['btnSubmit'])) {

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date = NEW DateTime('now');
    $regDate = $date->format('Y-m-d');

    //Transaction id generator
    $sqlTR = "SELECT TransID FROM payment WHERE TransID LIKE 'TR%' ORDER BY TransID DESC LIMIT 1";
    $trIdTR = mysqli_query($dbConnection, $sqlTR);

    $transId = $trChar = $trNum = $tID = "";

    while ($row = mysqli_fetch_array($trIdTR)) {
        $transId = $row["TransID"];
    }

    //Check whether inside db have record(s) or not, if no the will start at 101
    if ($transId != NULL || $transId != "") {
        $trChar = substr($transId, 0, 2);
        $trNum = substr($transId, 2);
        $trNum += 1;
        $tID = $trChar . sprintf("%03d", $trNum);
    } else {
        $tID = "TR001";
    }

    $seatNo = isset($_POST['seatNo']) ? trim($_POST['seatNo']) : "";
    $eID = isset($_POST['eid']) ? $_POST['eid'] : "";
    $regId = isset($_POST['rgid']) ? $_POST['rgid'] : "";
    $fees = isset($_POST['fees']) ? $_POST['fees'] : "";
    $eType = substr($eID, 0, 2);
    $cardHolder = isset($_POST['cardHolder']) ? trim($_POST['cardHolder']) : "";
    $cardNo = isset($_POST['cardNo']) ? trim($_POST['cardNo']) : "";
    $expMonth = isset($_POST['expMonth']) ? trim($_POST['expMonth']) : "";
    $expYear = isset($_POST['expYear']) ? trim($_POST['expYear']) : "";
    $verificationCode = isset($_POST['verificationCode']) ? trim($_POST['verificationCode']) : "";

    $errMsgCardHolder = validateCardHolder($cardHolder);
    $errMsgCardNo = validateCardNo($cardNo);
    $errMsgExpMonth = validateExpMonth($expMonth);
    $errMsgExpYear = validateExpYear($expYear);
    $errMsgVerificationCode = validateVerificationCode($verificationCode);

    $finalErrorMessage = array_merge(array_merge(array_merge(array_merge($errMsgCardHolder, $errMsgCardNo), $errMsgExpMonth), $errMsgExpYear), $errMsgVerificationCode);
    $capacitySQL = "SELECT * FROM event WHERE EventID = '$eID'";
    $cp = mysqli_query($dbConnection, $capacitySQL);
    while ($row = mysqli_fetch_array($cp)) {
        $pax = $row['Capacity'];
    }

    $regPax = 0;
    $countPax = "SELECT * FROM event E, register R WHERE R.RegStatus = 'AC' AND E.EventID = R.EventID AND E.EventID = '$eID'";
    $cpax = mysqli_query($dbConnection, $countPax);
    while ($row = mysqli_fetch_array($cpax)) {
        $regPax++;
    }

    if ($regPax >= $pax && ($eType == "CC" || $eType == "WS")) {
        echo "<script>alert('Sorry, this event has been fully register.')</script>";
        echo "<script>window.location.href='member_catalogue.php'</script>";
    } else if (count($finalErrorMessage) > 0) {

        // Alert Messages
        echo "<div class = 'alert warning'>";
        echo "<span class = 'closebtn'>&times;</span>";
        echo "<strong>Warning!</strong>";

        // Display final Error Message
        echo "<ul>";
        foreach ($finalErrorMessage as $message) {
            echo "<ul>" . $message . "</ul>";
        }
        echo "</ul>";
        echo "</div>";
    } else {
        $insertCommand = "INSERT INTO `payment`(`TransID`, `CardHolder`, `CardNo`, `ExpMonth`, `ExpYear`, `CVV`, `TransAmt`, `RegID`) VALUES ('$tID','$cardHolder','$cardNo','$expMonth','$expYear','$verificationCode','$fees','$regId')";
        $result = mysqli_query($dbConnection, $insertCommand);

        if ($eType == "CC") {
            $regCommand = "INSERT INTO register (RegID, RegDate, RegStatus, SeatNo, StudentID, EventID, TransID) VALUES ('$regId','$regDate', 'AC', '$seatNo', '$msID', '$eID', '$tID')";
        } else if ($eType == "WS") {
            $regCommand = "INSERT INTO register (RegID, RegDate, RegStatus, SeatNo, StudentID, EventID, TransID) VALUES ('$regId','$regDate', 'AC', NULL, '$msID', '$eID', '$tID')";
        } else if ($eType == "CP") {
            $regCommand = "INSERT INTO register (RegID, RegDate, RegStatus, SeatNo, StudentID, EventID, TransID) VALUES ('$regId','$regDate', 'PD', NULL, '$msID', '$eID', '$tID')";
        } else {
            echo "<script>alert('Register fail. Please contact to the admin for help!')</script>";
            exit();
        }
        $results = mysqli_query($dbConnection, $regCommand);

        echo "<script>alert('Payment Successful.')</script>";
        echo "<script>window.location.href='member_enrollment_details.php?rgid=$regId'</script>";
    }
}

// Display Payment Amount
$selectCommand = "SELECT Fees FROM event WHERE EventID = '$eID';";
$result = mysqli_query($dbConnection, $selectCommand);
?>

<!-- Payment Form Details -->
<section class="information">
    <article>
        <div class="content ">
            <div class="content_container">
                <div class="payment">
                    <div class="payment_panel">

                        <!--Payment Form-->
                        <form method="POST" action="member_payment.php">
                            <h2 class="title">Make Payment</h2>
                            <div class="payment_method">
                                <label for="card" class="method_card">
                                    <div class="card_logo">
                                        <img class="visa_master_logo" src="images/visa_master_logo.png"/>
                                    </div>

                                    <div class="payment_amount">
                                        <span class="payment_desc" name="fee">Payment : RM <?php $row = mysqli_fetch_array($result); $fees = $row[0]; echo $fees ?>.00</span>
                                        <input type="hidden" value="<?php echo $fees; ?>" name="fees"/>
                                        <input type="hidden" value="<?php echo $eID; ?>" name="eid"/>
                                        <input type="hidden" value="<?php echo $regId; ?>" name="rgid"/>
                                        <?php
                                        $eType = substr($eID, 0, 2);
                                        if ($eType == "CC") {
                                            echo "<input type='hidden' value='$seatNo' name='seatNo'/>";
                                        }
                                        ?>

                                    </div>
                                </label>
                            </div>

                            <div class="card_details_field">
                                <div class="col_1">
                                    <label for="cardHolderName">Cardholder's Name <span class="material-symbols-outlined">person</span></label>
                                    <input type="text" id="cardHolderName" placeholder="Name" name="cardHolder" maxlength="50" require="true" value="<?php echo(isset($_POST['cardHolder']) ? $_POST['cardHolder'] : ""); ?>"/> 

                                    <label for="cardNo">Card Number <span class="material-symbols-outlined">credit_card</span></label>
                                    <input type="text" id="cardNo" placeholder="16 digits card numbers" name="cardNo" maxlength="16" require="true" value="<?php echo(isset($_POST['cardNo']) ? $_POST['cardNo'] : ""); ?>" /> 

                                    <div class="indent_input_field">
                                        <div>
                                            <label for="expDate">Exp Month <span class="material-symbols-outlined">calendar_month</span></label>
                                            <select id="expDate" class="selector_box" name="expMonth" require="true" value="<?php echo(isset($_POST['expMonth']) ? $_POST['expMonth'] : ""); ?>" >
                                                <option value="null" selected>Select</option>
                                                <option value="Jan">Jan</option>
                                                <option value="Feb">Feb</option>
                                                <option value="Mar">Mar</option>
                                                <option value="Apr">Apr</option>
                                                <option value="May">May</option>
                                                <option value="Jun">Jun</option>
                                                <option value="Jul">Jul</option>
                                                <option value="Aug">Aug</option>
                                                <option value="Sep">Sep</option>
                                                <option value="Oct">Oct</option>
                                                <option value="Nov">Nov</option>
                                                <option value="Dec">Dec</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="expDate">Exp Year <span class="material-symbols-outlined">calendar_month</span></label>
                                            <select id="expDate" class="selector_box" name="expYear" require="true" value="<?php echo(isset($_POST['expYear']) ? $_POST['expYear'] : ""); ?>" >
                                                <option value="null" selected>Select</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                                <option value="2031">2031</option>
                                                <option value="2032">2032</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="verificationCode">CVV / CVC * <span class="material-symbols-outlined">domain_verification</span></label>
                                        <input type="password" id="verificationCode" name="verificationCode" maxlength="3" require="true" value="<?php echo(isset($_POST['verificationCode']) ? $_POST['verificationCode'] : ""); ?>" />
                                    </div>

                                    <span class="shortInfo">* CVV or CVC is the card security code, unique three digits number on the back of your card separate from its number.</span>
                                </div>
                            </div>

                            <div class="button">
                                <button type="submit" class="btn_submit" name="btnSubmit" title="Click Here to Submit">Submit</button>
                                <button type="button" class="btn_cancel"  name="btnCancel" title="Click Here to Cancel"
                                        onclick="location = 'member_catalogue.php'">Cancel</button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
    </article>
</section>

<!-- Alert Messages -->
<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function () {
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function () {
                div.style.display = "none";
            }, 600);
        };
    }
</script>