<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Chang Ching We
   Date: 09/08/2022
   
   Filename: member_catalogue_content.php

-->
<?php
$countCommand = "SELECT EventID FROM register WHERE RegStatus = 'AC'";
$result = mysqli_query($dbConnection, $countCommand);

$total = 0;
while (mysqli_fetch_array($result)) {
    $total++;
}

// Display all the available events/activities
$selectCommand = "SELECT * FROM event WHERE Status = 'AL' ";

$displayList = mysqli_query($dbConnection, $selectCommand);

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
?>

<section class="information">
    <article>
        <div class="content ">
            <div class="content_container">
                <h4>Events / Activity List</h4>

                <!--enrollment list table-->
                <div class="content_table" style="overflow-x:auto;">
                    <form method="POST" action="">

                        <table class="eventList">
                            <col style="width:27%">
                            <col style="width:15%">
                            <col style="width:10%">
                            <col style="width:15%">
                            <col style="width:15%">
                            <col style="width:8%">
                            <col style="width:5%">
                            <col style="width:5%">

                            <thead>
                                <tr class="searchBar">
                                    <th>
                                        Search
                                        <span class="material-symbols-outlined">search</span>                        
                                    </th>
                                    <th colspan="7">
                                        <input type="text" class="form-control" placeholder="search event" id="search" name="search"/>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Event / Activity Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Duration</th>
                                    <th>Venue</th>
                                    <th>Fees</th>
                                    <th>Availability</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="post_data">
                                <?php
                                $registeredCount = 0;
                                $totalAvailEvents = 0;
                                $regEID = "";
                                global $numPax;

                                while ($row = mysqli_fetch_array($displayList)) {
                                    $display = "";
                                    $eID = $row['EventID'];

                                    // to get the registered events
                                    $buttonCommand = "SELECT * FROM event E, register R WHERE E.EventID = R.EventID AND R.StudentID = '$msID' AND E.Status = 'AL' OR R.RegStatus = 'PD'";
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

                                // Display to final counts
                                $finalCount = $totalAvailEvents - $registeredCount;
                                echo "<caption>";
                                echo "Total record(s) : $finalCount";
                                echo "</caption>";
                                ?>                            
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </article>
</section>

