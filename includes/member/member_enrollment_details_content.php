<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Chang Ching We
   Date: 09/08/2022
   Filename: member_enrollment_details_content.php

-->

<?php
if (isset($_GET['rgid'])) {
    $regId = $_GET['rgid'];
    // Display enrollment details
    $selectCommand = "SELECT * FROM member M, register R, event E WHERE M.StudentID = '$msID' AND R.RegID = '$regId' AND M.StudentID = R.StudentID AND R.EventID = E.EventID";
    $result = mysqli_query($dbConnection, $selectCommand);
}
?>

<section class="information">
    <article>
        <div class="content ">
            <div class="content_container">
                <h4>TARUC Music Society<br/>Enrollment Details</h4>

                <!--member particular details-->
                <div class="content_table" style="overflow-x:auto;">
                    <table class="memberDetails">
                        <col style="width:25%">
                        <col style="width:5%">
                        <col style="width:70%">

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                
                                $imgE = $row['EventImg'];
                                
                                echo "<tr>";
                                echo "<td colspan='3' class='eImg'><img style='width: 200px; height: 200px; border: 2px solid #99ccff; display: block; margin-left: auto; margin-right: auto;' src='images/event_images/$imgE'/></td>";
                                echo "</tr>";
                                                                
                                echo "<tr>";
                                echo "<td colspan='3'>" . "<b>Member's Particulars</b>" . "</td>";
                                echo "</tr>";
                                
                                echo "<tr>";
                                echo "<td>" . "Student Last Name" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['LastName'] . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Student First Name" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['FirstName'] . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Student ID." . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['StudentID'] . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Contact No." . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['Contact'] . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Student Email" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['StudentEmail'] . "</td>";
                                echo "</tr>";

                                // blank link
                                echo "<tr>";
                                echo "<td colspan='3'></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td colspan='3'>" . "<b>Registration Details</b>" . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Registration ID" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['RegID'] . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Registration Date" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . getReqDateMsg($row['RegDate']) . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Event Name" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['EventName'] . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Date" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . getDateMsg($row['StartDate'], $row['EndDate']) . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Time" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . getTimeMsg($row['StartTime'], $row['EndTime']) . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Duration" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . getDurationMsg($row['Duration']) . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Venue" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['Venue'] . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Transaction ID" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . $row['TransID'] . "</td>";
                                echo "</tr>";

                                
                                echo "<tr>";
                                echo "<td>" . "Fees" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . getFeesMsg($row['Fees']) . "</td>";
                                echo "</tr>";

                                // blank link
                                echo "<tr>";
                                echo "<td colspan='3'></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td colspan='3'>" . "<b>Additional Details</b>" . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                $seat = isset($row['SeatNo']);
                                if ($seat == NULL || $seat == 0) {
                                    echo "<td>" . "Seat No." . "</td>";
                                    echo "<td>" . ":" . "</td>";
                                    echo "<td>" . getSeatMsg($row['SeatNo']) . "</td>";
                                } else if ($seat != NULL) {
                                    echo "<td>" . "Seat No." . "</td>";
                                    echo "<td>" . ":" . "</td>";
                                    echo "<td>" . $row['SeatNo'] . "</td>";
                                }
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Registration Status" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . getRegStatusMsg($row['RegStatus']) . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td>" . "Message" . "</td>";
                                echo "<td>" . ":" . "</td>";
                                echo "<td>" . "*Please show this registration upon attending the event / activity." . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td colspan='3'>"
                                . "<button class='btn-print' onclick='window.print()' title='Click here to Print' >Print</button>"
                                . "<button class='btn-back' onclick='location = \"member_enrollment_list.php\"' title='Go to Enrollment List' >Back</button>"
                                . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>                                                   
                </div> 
            </div>
        </div>
    </article>
</section>