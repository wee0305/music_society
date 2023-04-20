<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//
//   Web System
//    
//   Music Society
//   Author: Eric Chee Wei Jiat
//   Date: 18/9/2022
//   
//   Filename: admin_cancel_register.php
//

if (isset($_GET['eID']) && isset($_GET['sID'])) {
    include '../../session.php';
    $msID = $_SESSION['msId'];
    include '../../msDBConnect.php';

    $eID = isset($_GET['eID']) ? trim($_GET['eID']) : null;
    $sID = isset($_GET['sID']) ? trim($_GET['sID']) : null;

    if ($eID == null || $eID == "") {
        echo "<script>alert('Invalid event id!')</script>";
        $_SESSION = array(); // Clear the variables.
        session_destroy(); // Destroy the session itself.
        setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, 0); // Destroy the cookie.
        echo "<script type='text/javascript'>window.location.href='../index.php'; </script>";
    } else if ($sID == null || $sID == "") {
        echo "<script>alert('Invalid student id!')</script>";
        $_SESSION = array(); // Clear the variables.
        session_destroy(); // Destroy the session itself.
        setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, 0); // Destroy the cookie.
        echo "<script type='text/javascript'>window.location.href='../index.php'; </script>";
    } else {
        $dropCommand = "UPDATE `register` SET `RegStatus`='RJ' WHERE EventID = '$eID' AND StudentID = '$sID'";
        if (mysqli_query($dbConnection, $dropCommand)) {
            echo "<script>alert('The registration for student $sID is cancelled.')</script>";
            echo "<script>window.location.href = '../../../admin_list_register.php?eID=$eID'</script>";
        } else {
            echo "<script>alert('Fail to cancel the registration for student $sID. Please contact to the author of the program!')</script>";
            echo "<script>window.location.href = '../../../admin_list_register.php?eID=$eID</script>";
        }
    }

    mysqli_close($dbConnection);
} else {
    echo "Error! Please contact to the author of the program!";
}    