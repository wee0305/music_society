<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

// Validation Functions
function validateCardHolder($cardHolder) {
    $errMsgCardHolder = array();

    if ($cardHolder == "" || $cardHolder == null) {
        $errMsgCardHolder[] = "Please enter card holder name.";
    }

    if (strlen($cardHolder) > 50) {
        $errMsgCardHolder[] = "Name cannot exceed 50 characters.";
    }

    $pattern = "/(?:[A-Za-z ]+ ?)$/";

    if (preg_match($pattern, $cardHolder) == false) {
        $errMsgCardHolder[] = "Invalid card holder name entered.";
    }

    return $errMsgCardHolder;
}

function validateCardNo($cardNo) {
    $errMsgCardNo = array();

    if ($cardNo == "" || $cardNo == null) {
        $errMsgCardNo[] = "Please enter card numbers";
    }

    if (strlen($cardNo) < 16) {
        $errMsgCardNo[] = "Card numbers cannot less than 16 digits.";
    }

    if (strlen($cardNo) > 16) {
        $errMsgCardNo[] = "Card numbers cannot exceed 16 digits.";
    }

    return $errMsgCardNo;
}

function validateExpMonth($expMonth) {
    $errMsgExpMonth = array();

    if ($expMonth == "" || $expMonth == null || $expMonth == "null") {
        $errMsgExpMonth[] = "Please select card expiry month.";
    }

    return $errMsgExpMonth;
}

function validateExpYear($expYear) {
    $errMsgExpYear = array();

    if ($expYear == "" || $expYear == null || $expYear == "null") {
        $errMsgExpYear[] = "Please select card expiry year.";
    }

    return $errMsgExpYear;
}

function validateVerificationCode($verificationCode) {
    $errMsgVerificationCode = array();

    if ($verificationCode == "" || $verificationCode == null) {
        $errMsgVerificationCode[] = "Please enter CVV / CVC numbers.";
    }

    if (strlen($verificationCode) < 3) {
        $errMsgVerificationCode[] = "CVV / CVC cannot less than 3 digits.";
    }

    if (strlen($verificationCode) > 3) {
        $errMsgVerificationCode[] = "CVV / CVC cannot exceed 3 digits.";
    }

    $pattern = "/^(\d{3})$/";

    if (preg_match($pattern, $verificationCode) == false) {
        $errMsgVerificationCode[] = "Invalid CVV / CVC entered.";
    }

    return $errMsgVerificationCode;
}

// Member Event & Activity
// Purpose: To show date message
function getDateMsg($startDate, $endDate) {

    //Change YYYY-MM-DD to DD-MM-YYYY
    $startDate1 = $startDate;
    $formattedStartDate = date("d M Y", strtotime($startDate1));

    $endDate1 = $endDate;
    $formattedEndDate = date("d M Y", strtotime($endDate1));

    if ($startDate == $endDate) {
        return $formattedStartDate;
    } else {
        return $formattedStartDate . " to " . $formattedEndDate;
    }
}

function getTimeMsg($startTime, $endTime) {

    //Change HH-MM-SS to HH-MM
    $startTime1 = $startTime;
    $formattedStartTime = date("H:i", strtotime($startTime1));

    $endTime1 = $endTime;
    $formattedEndTime = date("H:i", strtotime($endTime1));

    if ($startTime == NULL || $endTime == NULL) {
        return "Not Applicable";
    } else {
        return $formattedStartTime . " - " . $formattedEndTime . " Hrs";
    }
}

// Purpose: To return duration message
function getDurationMsg($duration) {
    switch ($duration) {
        case "3":
            return "3 Hrs (Every Weekend)";
        case "4":
        return "4 Hrs";
        default:
            return "Not Applicable";
    }
}

// Purpose: To show fees amount 
function getFeesMsg($fees) {
    switch ($fees) {
        case "15":
            return "RM 15.00";
        case "300":
            return "RM 300.00";
        case "2":
            return "RM 2.00";
    }
}

// Purpose: To show availability message 
function getAvailalibilityMsg($capacity) {

    if ($capacity == NULL) {
        return "No Limit";
    } else if ($capacity == 15) {
        return " /$capacity";
    } else if ($capacity == 150) {
        return " /$capacity";
    } else {
        return "Pending";
    }
}

// Member Enrollment List
// Purpose: To convert register date format
function getRegDateMsg($regDate) {

    //Change YYYY-MM-DD to DD-MM-YYYY
    $regDate1 = $regDate;
    $formattedRegDate = date("d M Y", strtotime($regDate1));
    
        return $formattedRegDate;
}

// Purpose: To display registration status message
function getRegStatusMsg($regStatus) {
    switch ($regStatus) {
        case "AC":
            return "Accepted";
        case "CX":
            return "Cancelled";
        case "PD":
            return "Pending";
        case "RJ":
            return "Rejected";
        default:
            return "Pending";
    }
}

// Member Details
// Purpose: To display seat no. message
function getSeatMsg($seatNo) {
    if ($seatNo == NULL || $seatNo == 0) {
            return "Not Applicable";
    } else{
            return "$seatNo";
    }
}

// Purpose: To show registration date message
function getReqDateMsg($regDate) {

    //Change YYYY-MM-DD to DD-MM-YYYY
    $regDate1 = $regDate;
    $formattedStartDate = date("d M Y", strtotime($regDate1));
    return $formattedStartDate;
}

function getEventTypeName($eType){
    
    $eventType = "";
    
    if($eType == "CC"){
        $eventType = "Concert";
    } else if ($eType == "WS"){
        $eventType = "Workshop";
    } else if ($eType == "CP"){
        $eventType = "Competition";
    } else {
        $eventType = "";
    }
    
    return $eventType;
}