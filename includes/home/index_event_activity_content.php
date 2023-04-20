<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

<article>    
    <!-- Flip Card - Workshop -->
    <div class="flex-container">
        <?php

        $eventCommand = "SELECT * FROM event WHERE Status = 'AL'";
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

            echo "<div class='flip-card'>";
            echo "<div class='flip-card-inner'>";

            //the front of the card with img
            echo "<div class='flip-card-front'>";
            echo "<img src='images/event_images/$eImg'  alt='$eName'>";
            echo "</div>";

            //the back of the card with event details
            //the class of the card based on the event type
            $card = $week = $hrsWeek = $rm = "";

            if ($eType == "CC") {
                $card = "concert";
                $rm = "RM ";
            } else if ($eType == "CP") {
                $card = "competition";
                $rm = "RM ";
            } else if ($eType == "WS") {
                $card = "workshop";
                $week = "(Every Weekend)";
                $hrsWeek = "per week";
                $rm = "RM ";
            }

            echo "<div class='flip-card-back $card'>";
            echo "<table>";
            echo "<th colspan='3'><h1>$eName</h1></th>";

            //date row
            echo "<tr>";
            echo "<td>Date</td>";
            echo "<td>:</td>";
            //echo "<td>$sDate - $eDate</td>";
            echo "<td>" . getDateMsg($sDate, $eDate) . "</td>";
            echo "</tr>";

            if ($eType != "CP") {
                //time row
                echo "<tr>";
                echo "<td>Time</td>";
                echo "<td>:</td>";
                echo "<td>" . sprintf("%04d", $sTime) . " - " . sprintf("%04d", $eTime) . "Hrs $week</td>";
                echo "</tr>";

                //duration row
                echo "<tr>";
                echo "<td>Duration</td>";
                echo "<td>:</td>";
                echo "<td>$duration Hrs $hrsWeek</td>";
                echo "</tr>";
            }

            //venue row
            echo "<tr>";
            echo "<td>Venue</td>";
            echo "<td>:</td>";
            echo "<td>$venue</td>";
            echo "</tr>";

            if ($eType != "CP") {
                //capacity row
                echo "<tr>";
                echo "<td>Capacity</td>";
                echo "<td>:</td>";
                echo "<td>$capacity seats</td>";
                echo "</tr>";
            }

            //fees row
            echo "<tr>";
            echo "<td>Fees</td>";
            echo "<td>:</td>";
            echo "<td>" . $rm . "" . $fees . "</td>";
            echo "</tr>";

            echo "</table>";
            echo " <button class='button-join' type='button' onclick=\"window.location.href = 'index_login.php'\" title='Click here to join'>Join Now !</button>";

            echo "</div>";

            echo "</div>";
            echo "</div>";
        }
        ?>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="images/upcoming_event.png"  alt="Upcoming Event">
                </div>
                <div class="flip-card-back upcoming">

                    <form method:"" action="">

                        <table>
                            <th colspan="3">
                                <h1>Stay Tuned for<br/>Upcoming Event</h1> 
                                <img src="images/smiling_face.png"  class="smilling-face" alt="Smiling Face">
                            </th>
                        </table>
                    </form>
                </div>   
            </div>
        </div>
    </div>

</article>