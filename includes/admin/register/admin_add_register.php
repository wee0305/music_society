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
            echo "<script>window.location.href='admin_list_register.php?eID=$eID'</script>";
        }
    }
    if ($eID == null || $eID == "") {
        echo "<script>alert('Invalid event id! $eID')</script>";
        exit();
    } else if ($sID == null || $sID == "") {
        echo "<script>alert('Invalid student id!')</script>";
        exit();
    } else {
        $addCommand = "UPDATE `register` SET `RegStatus`='AC' WHERE EventID = '$eID' AND StudentID = '$sID'";
        if (mysqli_query($dbConnection, $addCommand)) {
            echo "<script>alert('The registration for student $sID is accepted.')</script>";
            echo "<script>window.location.href = '../../../admin_list_register.php?eID=$eID'</script>";
        } else {
            echo "<script>alert('Fail to accept the registration for student $sID. Please contact to the author of the program!')</script>";
            echo "<script>window.location.href = '../../../admin_list_register.php?eID=$eID</script>";
        }
    }

    mysqli_close($dbConnection);
} else {
    echo "Error! Please contact to the author of the program!";
}    