<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//
//   Web System
//    
//   Music Society
//   Author:Chang Ching We
//   Date: 21/9/2022
//   
//   Filename: member_delete_event.php
//

if (isset($_GET['regId'])) {
    include '../session.php';
    $msID = $_SESSION['msId'];
    include '../msDBConnect.php';

    $regId = isset($_GET['regId']) ? trim($_GET['regId']) : null;
    
    if ($regId == null || $regId == "") {
        echo "Error registration id!";
        exit();
    } else {
            $cancelCommand = "UPDATE `register` SET `RegStatus`='CX',`SeatNo`=NULL WHERE `RegID` = '$regId' AND StudentID = '$msID'";
            if(mysqli_query($dbConnection, $cancelCommand)){
            echo "<script>alert('The registration id: $regId was cancelled successfully. Please email cancellation screenshot to mstaruc@tarc.edu.my for refund process assistance.')</script>";
            echo "<script>window.location.href='../../member_enrollment_list.php'</script>";
        } else {
            echo "<script>alert('Fail to cancel registration $regId. Please contact admin for further assistance!')</script>";
            echo "<script>window.location.href='../../member_enrollment_list.php'</script>";
        }
    }
    
    mysqli_close($dbConnection);
} else {
    echo "Error! Please contact to the admin for assistance!";
}