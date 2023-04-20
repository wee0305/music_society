<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//
//  Web System
//
//  Music Society
//  Author:Leong Kuan Fei
//  Date: 27/8/2022
//
//  Filename: admin_validate.php
//

function validateImg($eImg, $eImgName) {

    $errMsgImg = array();

    if ($eImg > 0) {
        $errMsgImg[] = "Plese upload the event image!";
    } else {

        global $dbConnection;
        $selectCommand = "SELECT * FROM event WHERE EventImg = '$eImgName'";
        $result = mysqli_query($dbConnection, $selectCommand);

        if ($result->num_rows > 0) {
            $errMsgImg[] = "Event Images that you uploaded is already exist!";
        }
    }

    return $errMsgImg;
}

function validateEventName($eName) {

    $errMsgName = array();

    if ($eName == "" || $eName == null) {
        $errMsgName[] = "Please enter event name!!";
    }

    return $errMsgName;
}

function validateSDate($sDate) {

    $errMsgSDate = array();
    $cdate = date("Y-m-d");

    if ($sDate == "" || $sDate == null) {
        $errMsgSDate[] = "Please select the start date!";
    }

    if ($sDate < $cdate) {
        $errMsgSDate[] = "Start date cannot smaller or equal than the current date!";
    }

    return $errMsgSDate;
}

function validateEDate($sDate, $eDate) {

    $errMsgEDate = array();

    if ($eDate == "" || $eDate == null) {
        $errMsgEDate[] = "Please select the end date!";
    }

    if ($eDate < $sDate) {
        $errMsgEDate[] = "End date cannot smaller than Start Date!";
    }

    return $errMsgEDate;
}

function validateTime($sTime, $eTime) {

    $errMsgTime = array();

    if ($sTime < 900 || $sTime > 2100 || $eTime < 1000 || $eTime > 2200) {
        $errMsgTime[] = "Please select the correct time!";
    }

    if ($sTime == $eTime) {
        $errMsgTime[] = "End Time cannot same as Start Time!";
    }

    if (is_int($sTime) == false) {
        $errMsgTime[] = "Invalid Start Time!";
    }

    if (is_int($eTime) == false) {
        $errMsgTime[] = "Invalid End Time!";
    }

    return $errMsgTime;
}

function validateEventId($eID) {

    $errMsgID = array();

    if ($eID == "" || $eID == null) {
        $errMsgID[] = "Please select the event Id!";
    } else {
        global $dbConnection;
        $selectCommand = "SELECT * FROM event WHERE EventID = '$eID'";
        $result = mysqli_query($dbConnection, $selectCommand);

        if ($result->num_rows > 0) {
            $errMsgID[] = "Event Id " . $eID . " already exist!";
        }
    }

    return $errMsgID;
}

function validateCapacity($capacity) {

    $errMsgCapacity = array();

    if ($capacity != 0 && $capacity != 15 && $capacity != 150 && $capacity != null && $capacity != "NULL") {
        $errMsgCapacity[] = "Invalid capacity!";
    }

    if ($capacity != null && $capacity != "NULL" && $capacity > 150) {
        $errMsgCapacity[] = "Maximum capacity is 150!";
    }

    return $errMsgCapacity;
}

function validateStatus($status) {

    $errMsgStatus = array();

    if ($status == "" || $status == null) {
        $errMsgStatus[] = "Plese select the event status!";
    }

    if ($status != "AL" && $status != "NA") {
        $errMsgStatus[] = "Invalid status!";
    }

    return $errMsgStatus;
}

function statusFullName($status) {

    $statusName = "";

    if ($status == "AL") {
        $statusName = "Available";
    } else if ($status == "NA") {
        $statusName = "Not Available";
    } else {
        $statusName = "Invalid Status!";
    }

    return $statusName;
}

function eventTypeName($eTypeID) {

    $eTypeName = "";

    if ($eTypeID == "CC") {
        $eTypeName = "Concert";
    } else if ($eTypeID == "CP") {
        $eTypeName = "Competition";
    } else if ($eTypeID == "WS") {
        $eTypeName = "Workshop";
    } else {
        $eTypeName = "Invalid Event Type!";
    }

    return $eTypeName;
}
