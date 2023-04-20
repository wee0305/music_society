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
//   Date: 27/8/2022
//   
//   Filename: admin_eventId_generator.php
//

$eventIDCC = $eventIDCP = $eventIDWS = "";

//CC
$sqlCC = "SELECT EventID FROM event WHERE EventID LIKE 'CC%' ORDER BY EventID DESC LIMIT 1";
$eIdCC = mysqli_query($dbConnection, $sqlCC);

while ($row = mysqli_fetch_array($eIdCC)) {
    $eventIDCC = $row["EventID"];
}

//Check whether inside db have record(s) or not, if no the will start at 101
if ($eventIDCC != NULL || $eventIDCC != "") {
    $numCC = substr($eventIDCC, 2);
    $numCC += 1;
    echo "<input type='hidden' id='eNumCC' value='$numCC'/>";
} else {
    echo "<input type='hidden' id='eNumCC' value='101'/>";
}

//CP
$sqlCP = "SELECT EventID FROM event WHERE EventID LIKE 'CP%' ORDER BY EventID DESC LIMIT 1";
$eIdCP = mysqli_query($dbConnection, $sqlCP);

while ($row = mysqli_fetch_array($eIdCP)) {
    $eventIDCP = $row["EventID"];
}

//Check whether inside db have record(s) or not, if no the will start at 101
if ($eventIDCP != NULL || $eventIDCP != "") {
    $numCP = substr($eventIDCP, 2);
    $numCP += 1;
    echo "<input type='hidden' id='eNumCP' value='$numCP'/>";
} else {
    echo "<input type='hidden' id='eNumCP' value='101'/>";
}

//WS
$sqlWS = "SELECT EventID FROM event WHERE EventID LIKE 'WS%' ORDER BY EventID DESC LIMIT 1";
$eIdWS = mysqli_query($dbConnection, $sqlWS);

while ($row = mysqli_fetch_array($eIdWS)) {
    $eventIDWS = $row["EventID"];
}

//Check whether inside db have record(s) or not, if no the will start at 101
if ($eventIDWS != NULL || $eventIDWS != "") {
    $numWS = substr($eventIDWS, 2);
    $numWS += 1;
    echo "<input class='form-control' type='hidden' id='eNumWS' value='$numWS'/>";
} else {
    echo "<input type='hidden' id='eNumWS' value='101'/>";
}