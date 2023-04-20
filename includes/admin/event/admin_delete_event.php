<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//
//   Web System
//    
//   Music Society
//   Author:Leong Kuan Fei
//   Date: 26/8/2022
//   
//   Filename: admin_delete_event.php
//

if (isset($_GET['eID'])) {
    include '../../session.php';
    $msID = $_SESSION['msId'];
    include '../../msDBConnect.php';

    $eID = isset($_GET['eID']) ? trim($_GET['eID']) : null;

    if ($eID == null || $eID == "") {
        echo "Error event id!";
        exit();
    } else {
        $dropCommand = "UPDATE `event` SET `Status`='NA' WHERE EventID = '$eID' AND AdminID = '$msID'";
        if(mysqli_query($dbConnection, $dropCommand)){
            echo "<script>alert('Event $eID was disabled successfully.')</script>";
            echo "<script>window.location.href = '../../../admin_list_event.php'</script>";
        } else {
            echo "<script>alert('Fail to drop event $eID. Please contact to the author of the program!')</script>";
            echo "<script>window.location.href = '../../../admin_list_event.php'</script>";
        }
    }
    
    mysqli_close($dbConnection);
} else {
    echo "Error! Please contact to the author of the program!";
}