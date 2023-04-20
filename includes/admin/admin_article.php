<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author: Leong Kuan Fei
   Date: 5/9/2022
   
   Filename: member_catalogue_content.php

-->
<?php
// Display all the available events/activities
$selectCommand = "SELECT * FROM event WHERE Status = 'AL' ";
$displayList = mysqli_query($dbConnection, $selectCommand);
?>

<article class="justify-content-center pt-5">

    <!-- events & activities -->
    <div class="container">
        <table class="mb-2 upEvents">
            <tr>
                <th colspan="2"><h1 class="title text-center">THE UPCOMING EVENTS</h1></th>
            </tr>
            <?php
            $eTypeArr = array('CC', 'CP', 'WS');

            date_default_timezone_set('Asia/Kuala_Lumpur');
            $date = NEW DateTime('now');
            $cDate = $date->format('Y-m-d');
            for ($e = 0; $e < count($eTypeArr); $e++) {
                $eventCommand = "SELECT * FROM event WHERE Status = 'AL' AND StartDate >= '$cDate' HAVING EventID LIKE '$eTypeArr[$e]%' ORDER BY StartDate LIMIT 1;";
                $result = mysqli_query($dbConnection, $eventCommand);
                while ($row = mysqli_fetch_array($result)) {
                    $eId = $row['EventID'];
                    $eType = substr($eId, 0, 2);
                    $eName = $row['EventName'];
                    $sDate = $row['StartDate'];
                    $eDate = $row['EndDate'];
                    $sTime = $row['StartTime'];
                    $eTime = $row['EndTime'];
                    $duration = $row['Duration'];
                    $capacity = $row['Capacity'];
                    $venue = $row['Venue'];
                    $fees = $row['Fees'];
                    $eImg = $row['EventImg'];

                    echo "<tr class='pEventImg'>";
                    echo "<td>";
                    echo "<a class = 'card' href = 'admin_event_details.php?eID=$eId' style = 'margin: 0px 10px 10px 10px;'>";
                    echo "<img src = 'images/event_images/$eImg' class = 'card-img' style = 'height: 500px;' alt = '$eName'>";
                    echo "</a>";
                    echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='eventImg'>";
                    echo "<a class = 'card' href = 'admin_event_details.php?eID=$eId'>";
                    echo "<img src = 'images/event_images/$eImg' class = 'card-img cardEvent' alt = '$eName'>";
                    echo "</a>";
                    echo "</td>";

                    $regPax = 0;

                    $countPax = "SELECT * FROM register WHERE EventID = '$eId' AND RegStatus = 'AC'";
                    $pax = mysqli_query($dbConnection, $countPax);
                    while (mysqli_fetch_array($pax)) {
                        $regPax++;
                    }

                    echo "<td>";
                    echo "<div class='cardDesc'>";
                    echo "<h1>$eName ($eId)</h1>";
                    if ($sDate == $eDate) {
                        echo "<h3><span class='material-symbols-outlined'>today</span>Date: $sDate</h3>";
                    } else {
                        echo "<h3><span class='material-symbols-outlined'>today</span>Date: $sDate to $eDate</h3>";
                    }

                    if ($eType == "CC" || $eType == "WS") {
                        echo "<h3><span class='material-symbols-outlined'>schedule</span>Time: " . sprintf("%04d", $sTime) . " - $eTime hrs</h3>";
                        echo "<h3><span class='material-symbols-outlined'>timer</span>Duration: $duration hrs</h3>";
                    }

                    $bgcolor = $cpRate = $width = $cpRates = "";
                    if ($regPax != 0 && ($eType == "CC" || $eType == "WS")) {
                        $cpRate = ($regPax / $capacity) * 100;
                        if ($cpRate >= 75) {
                            $bgcolor = "lightgreen";
                        } else if ($cpRate >= 50 && $cpRate <= 74) {
                            $bgcolor = "blue";
                        } else if ($cpRate >= 25 && $cpRate <= 49) {
                            $bgcolor = "orange";
                        } else {
                            $bgcolor = "red";
                        }
                        $cpRates = sprintf('%.2f', $cpRate)."%";
                        $width = "width: " . $cpRate . "%;";
                    } else {
                        $cpRates = "<i>No student register this event yet</i>";
                        $bgcolor = "red";
                    }

                    if ($eType == "CC" || $eType == "WS") {
                        echo "<h3><span class='material-symbols-outlined'>groups</span>Capacity: $cpRates ($regPax / $capacity pax)"
                        . "<div class='capacityBar'> "
                        . "<div class='register text-center' style='background-color: $bgcolor; $width'></div>"
                        . "</div>"
                        . "</h3>";
                    } else {
                        echo "<h3>Capacity: $regPax student(s)</h3>";
                    }
                    echo "<h3><span class='material-symbols-outlined'>location_on</span>Venue: $venue</h3>";
                    echo "<h3><span class='material-symbols-outlined'>payments</span>Fees: RM $fees</h3>";
                    echo "<div class='justify-content-center container'>";
                    echo "<button class='button capacity' onclick=\"window.location.href = 'admin_list_register.php?eID=$eId';\" type='button'><span class='material-symbols-outlined'>groups</span>CAPACITY</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
</article>