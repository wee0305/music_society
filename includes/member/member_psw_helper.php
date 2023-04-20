<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function validateCPassword($cpsw) {

    $errMsgCPsw = array();

    global $dbConnection, $msID;

    $selectCommand = "SELECT * FROM member WHERE StudentID = '$msID'";
    $result = mysqli_query($dbConnection, $selectCommand);
    //using error to access object
    while($row = mysqli_fetch_array($result)){
        $psw = $row['Password'];
    }

    if ($cpsw != $psw) {
        $errMsgCPsw[] = "Invalid Password. Please try again!";
    }

    return $errMsgCPsw;
}

function validateNPassword($npsw) {
    $errMsgNPsw = array();

    if ($npsw == "" || $npsw == null) {
        $errMsgNPsw[] = "Please enter your Password.";
    }

    if (strlen($npsw) < 8 || strlen($npsw) > 12) {
        $errMsgNPsw[] = "Password cannot exceed 12 characters.";
    }

    $pattern = "/^[A-Za-z0-9@?]{8,12}$/";

    if (preg_match($pattern, $npsw) == false) {
        $errMsgNPsw[] = "Invalid new password entered.";
    }

    return $errMsgNPsw;
}

function validateConfPassword($npsw, $confirmPsw) {
    $errMsgConfPassword = array();

    $pattern = "/^[A-Za-z0-9@?]{8,12}$/";

    if (preg_match($pattern, $confirmPsw) == false) {
        $errMsgConfPassword[] = "Invalid confirm password entered.";
    }
    
    if($npsw !== $confirmPsw){
        $errMsgConfPassword[] = "The confirm password not matched";
    }

    return $errMsgConfPassword;
}
