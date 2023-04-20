<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


//   Web System
//    
//   Music Society
//   Author:Leong Kuan Fei
//   Date: 31/8/2022
//   
//   Filename: member_search_event.php

include '../msDBConnect.php';
include '../session.php';
include './function_helper.php';
$msID = $_SESSION['msId'];
//get today date
date_default_timezone_set('Asia/Kuala_Lumpur');
$date = NEW DateTime('now');
$today = $date->format('Y-m-d');

if (isset($_REQUEST["term"])) {

    $countCommand = "SELECT EventID FROM register WHERE RegStatus = 'AC'";
    $result = mysqli_query($dbConnection, $countCommand);

    $total = 0;
    while (mysqli_fetch_array($result)) {
        $total++;
    }

    $regId = "";
    $regCommand = "SELECT RegID FROM register WHERE RegID LIKE 'RG%' ORDER BY RegID DESC LIMIT 1";
    $rg = mysqli_query($dbConnection, $regCommand);
    while ($rows = mysqli_fetch_array($rg)) {
        $regId = $rows['RegID'];
    }
    if ($regId != null || $regId != "") {
        $codeRg = "RG";
        $numRg = substr($regId, 2);
        $numRg += 1;
        $regId = $codeRg . sprintf("%03d", $numRg);
    } else {
        $numRg = 1;
        $codeRg = "RG";
        $regId = $codeRg . sprintf("%03d", $numRg);
    }

    $registeredCount = 0;
    $totalAvailEvents = 0;
    $regEID = "";
    global $numPax;

    global $msID;
    $searchQuery = "SELECT * FROM event WHERE (Status = 'AL') AND (EventID LIKE ? OR EventName LIKE ? OR StartDate LIKE ? OR EndDate LIKE ? OR StartTime LIKE ? OR EndTime LIKE ? OR Duration LIKE ? OR Venue LIKE ? OR Fees LIKE ?)";
    $stmt = mysqli_prepare($dbConnection, $searchQuery);
    if ($stmt) {

        //set parameters
        $eid = '%' . $_REQUEST["term"] . '%';
        $ename = '%' . $_REQUEST["term"] . '%';
        $sdt = '%' . $_REQUEST["term"] . '%';
        $edt = '%' . $_REQUEST["term"] . '%';
        $est = '%' . $_REQUEST["term"] . '%';
        $eet = '%' . $_REQUEST["term"] . '%';
        $eduration = '%' . $_REQUEST["term"] . '%';
        $evenue = '%' . $_REQUEST["term"] . '%';
        $efees = '%' . $_REQUEST["term"] . '%';

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssssss", $eid, $ename, $sdt, $etd, $est, $eet, $eduration, $evenue, $efees);

        //attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            //check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    $display = "";
                    $eID = $row['EventID'];

                    // to get the registered events
                    $buttonCommand = "SELECT * FROM event E, register R WHERE E.EventID = R.EventID AND R.StudentID = '$msID' AND E.Status = 'AL' ";
                    $btnResult = mysqli_query($dbConnection, $buttonCommand);
                    while ($btnRow = mysqli_fetch_array($btnResult)) {
                        $regEID = $btnRow['EventID'];
                        if ($eID == $regEID) {
                            $display = "n";
                            $registeredCount += 1;
                        }
                    }

                    if ($display != "n") {
                        $eName = $row['EventName'];
                        $imgE = $row['EventImg'];
                        echo "<tr>";
                        echo "<td>"
                        . "<div class='col-left' ><img class='eImg' src='images/event_images/$imgE'/></div>"
                        . "<div class='col-right'>" . $eName . " ($eID)" . "</div>"
                        . "</td>";
                        echo "<td>" . getDateMsg($row['StartDate'], $row['EndDate']) . "</td>";
                        echo "<td>" . getTimeMsg($row['StartTime'], $row['EndTime']) . "</td>";
                        echo "<td>" . getDurationMsg($row['Duration']) . "</td>";
                        echo "<td>" . $row['Venue'] . "</td>";
                        echo "<td>" . getFeesMsg($row['Fees']) . "</td>";

                        $capacity = $row['Capacity'];

                        if ($capacity !== null) {
                            $regPax = 0;

                            $countPax = "SELECT StudentID FROM register WHERE EventID = '$eID' AND RegStatus = 'AC'";
                            $pax = mysqli_query($dbConnection, $countPax);
                            while (mysqli_fetch_array($pax)) {
                                $regPax++;
                            }

                            echo "<td>" . $regPax . getAvailalibilityMsg($capacity) . "</td>";
                        } else {
                            echo "<td>" . getAvailalibilityMsg($capacity) . "</td>";
                        }

                        // Display button link to next page
                        $concertNamePattern = "/^[Cc][Cc](\d{3})+$/";
                        $competitionNamePattern = "/^[Cc][Pp](\d{3})+$/";
                        $workshopNamePattern = "/^[Ww][Ss](\d{3})+$/";

                        if (preg_match($concertNamePattern, $eID) && $eID != $regEID) {
                            if ($regPax <= $capacity) {
                                echo "<td>"
                                . "<button type='button' name='btnReg' class='btn-reg' onclick='return confirm(\"Proceed Registration?\") ? window.location.href=\"member_seat_selection.php?rgid=$regId&eid=$eID&name=$eName\" : \"\"' title='Click here to Register'>Register"
                                . "</button>"
                                . "</td>";
                            } else {
                                echo "<td>"
                                . "<button type='submit' name='btnReg' style='background-color : grey; color: white;' disabled='true'>Registed"
                                . "</button>"
                                . "</td>";
                            }
                        } else if (preg_match($competitionNamePattern, $eID) && $eID != $regEID) {
                            echo "<td>"
                            . "<button type='button' name='btnReg' class='btn-reg' onclick='return confirm(\"Proceed Registration?\") ? window.location.href=\"member_payment.php?rgid=$regId&eid=$eID\" : \"\"' title='Click here to Register'>Register"
                            . "</button>"
                            . "</td>";
                        } else if (preg_match($workshopNamePattern, $eID) && $eID != $regEID) {
                            if ($regPax <= $capacity) {
                                echo "<td>"
                                . "<button type='button' name='btnReg' class='btn-reg' onclick='return confirm(\"Proceed Registration?\") ? window.location.href=\"member_payment.php?rgid=$regId&eid=$eID\" : \"\"' title='Click here to Register'>Register"
                                . "</button>"
                                . "</td>";
                            } else {
                                echo "<td>"
                                . "<button type='submit' name='btnReg' style='background-color : grey; color: white;' disabled='true'>Registed"
                                . "</button>"
                                . "</td>";
                            }
                        } else {
                            echo "<td>"
                            . "<button type='submit' name='btnReg' style='background-color : grey; color: white;' disabled='true'>Registed"
                            . "</button>"
                            . "</td>";
                        }
                    }
                    echo "</tr>";

                    $totalAvailEvents += 1;
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
}
    