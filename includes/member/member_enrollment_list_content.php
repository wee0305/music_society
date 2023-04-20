<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Chang Ching We
   Date: 09/08/2022
   
   Filename: member_enrollment_list_content.php

-->

<?php
//Display current enromllment list
if (isset($_SESSION["msId"])) {
    $selectCommand = "SELECT * FROM event E, register R WHERE R.StudentID = '$msID' AND R.EventID = E.EventID";
    $result = mysqli_query($dbConnection, $selectCommand);
}
?>

<section class="information">
    <article>
        <div class="content ">
            <div class="content_container">
                <h4>Current Enrollment(s)</h4>

                <!--event list table-->
                <table class="eventList">
                    <thead>
                        <tr>
                            <th>Event / Activity Name</th>
                            <th>Event Type</th>
                            <th>Registration ID</th>
                            <th>Registration Date</th>
                            <th>Registration Status</th>
                            <th>View</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 0;

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            $eID = $row['EventID'];
                            $eName = $row['EventName'];
                            $eType = substr($eID, 0, 2);
                            $regId = $row['RegID'];
                            $status = $row['Status'];
                            echo "<td>$eName</td>";
                            echo "<td>" . getEventTypeName($eType) . "</td>";
                            echo "<td>" . $regId . "</td>";
                            echo "<td>" . getRegDateMsg($row['RegDate']) . "</td>";
                            echo "<input type='hidden' name='reg' value='$regId'/>";
                            echo "<td>" . getRegStatusMsg($row['RegStatus']) . "</td>";
                            echo "<td><input type='button' name='btnDetail' class='btnDetail' value='Details' title='Click here to view Details'"
                            . "onclick='location.href=\"member_enrollment_details.php?rgid=$regId\"'/>"
                            . "</td>";

                            if ($status == "AL") {
                                if ($row['RegStatus'] == "AC" || $row['RegStatus'] == "PD") {
                                    echo "<td><button type='button' name='btnSubmit' class='btnSubmit' title='Click here to Cancel'"
                                    . "onclick='return confirm(\"Note: The member is not allowed to re-register the same event again after the first cancellation received. The registration id: $regId will be cancel. Would you like to proceed with this cancellation?\")"
                                    . " ? window.location.href=\"includes/member/member_delete_enrollment.php?regId=" . $regId . "\" : \"\"'/>Cancel</button>"
                                    . "</td>";
                                } else {
                                    echo "<td><button type='button' disabled='true'/>Cancel</button></td>";
                                }
                            } else {
                                echo "<td><button type='button' disabled='true'/>Cancel</button></td>";
                            }
                            echo "</tr>";

                            $counter += 1;
                        }

                        if ($counter == 0) {
                            echo "<tr>";
                            echo "<td colspan='7'>No record(s) founded.</td>";
                            echo "</tr>";
                        }


                        // Display to total counts
                        echo "<caption>";
                        echo "Total record(s) : $counter";
                        echo "</caption>";
                        ?>                           
                    </tbody>
                </table>
            </div>
        </div>
    </article>
</section>
