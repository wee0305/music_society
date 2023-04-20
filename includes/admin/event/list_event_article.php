<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Leong Kuan Fei
   Date: 8/8/2022
   
   Filename: list_event_article.php

-->

<?php
//get today date
date_default_timezone_set('Asia/Kuala_Lumpur');
$date = NEW DateTime('now');
$today = $date->format('Y-m-d');
$eventList = "SELECT * FROM event WHERE AdminID = '$msID' ORDER BY StartDate < '$today', Status";
$result = mysqli_query($dbConnection, $eventList);
?>
<article class="text-center d-flex justify-content-center pt-5">
    <!-- events & activities -->
    <div class="container-fluid d-flex justify-content-center">
        <table id="eventListing">
            <thead>
                <tr class="searchBar">
                    <th colspan="5">
                        <div class="alert alert-info" role="alert">
                            <span class="material-symbols-outlined">info</span> Click on the table header to sort the events
                        </div>
                    </th>
                    <th>
                        <span class="material-symbols-outlined input-group-text searchLabel">search</span>                        
                    </th>
                    <th colspan="3">
                        <input type="text" class="form-control" placeholder="search event" id="search" name="search"/>
                    </th>
                </tr>
                <tr class="title">
                    <th onclick="sortTable(0);" class="sort" title="Click here to sort the table view by No"><span class="material-symbols-outlined">numbers</span>No.</th>
                    <th onclick="sortTable(1);" class="sort"><span class="material-symbols-outlined">calendar_month</span>Event ID</th>
                    <th onclick="sortTable(2);" class="sort"><span class="material-symbols-outlined">event</span>Event Name</th>
                    <th onclick="sortTable(3);" class="sort"><span class="material-symbols-outlined">today</span>Event Date</th>
                    <th onclick="sortTable(4);" class="sort"><span class="material-symbols-outlined">schedule</span>Event Time</th>
                    <th onclick="sortTable(5);" class="sort"><span class="material-symbols-outlined">legend_toggle</span>Event Status</th>
                    <th class="viewColumn"><span class="material-symbols-outlined">pageview</span>View</th>
                    <th class="editColumn"><span class="material-symbols-outlined">edit_note</span>Edit</th>
                    <th class="deleteColumn"><span class="material-symbols-outlined">delete</span>DROP / <span class="material-symbols-outlined">add_circle</span>READD</th>
                </tr>
            </thead>
            <tbody class="post_data">
                <?php
                $total = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $eID = $row['EventID'];
                    //check the end data for the event
                    if ($today > $row['EndDate']) {
                        $dropCommand = "UPDATE `event` SET `Status`='NA' WHERE EventID = '$eID' AND AdminID = '$msID'";
                        mysqli_query($dbConnection, $dropCommand);
                    }
                    $total++;
                    echo "<tr class='data'>";
                    echo "<td class='no st'>$total</td>";
                    echo "<td class='st'>$eID</td>";
                    echo "<td class='st'>" . $row["EventName"] . "</td>";
                    echo "<td class='st'>" . $row["StartDate"] . " to " . $row["EndDate"] . "</td>";
                    if ($row["StartTime"] == 0 || $row["EndTime"] == 0) {
                        echo "<td class='st'> - </td>";
                    } else {
                        echo "<td class='st'>" . sprintf("%04d", $row["StartTime"]) . " - " . sprintf("%04d", $row["EndTime"]) . "</td>";
                    }
                    echo "<td class='st'>" . $row["Status"] . "</td>";
                    echo "<td class='st'><a href='admin_event_details.php?eID=" . $row["EventID"] . "' class='button view'><span class='material-symbols-outlined'>pageview</span></a></td>";
                    echo "<td class='st editColumn'><a href='admin_edit_event.php?eID=" . $row["EventID"] . "' class='button edit'><span class='material-symbols-outlined'>edit_note</span></a></td>";
                    $status = $row['Status'];
                    if ($status == "AL") {
                        echo '<td class="st"><a href="includes/admin/event/admin_delete_event.php?eID=' . $eID . ' " class="button delete" onclick="return confirm(\'Proceed to disable the event ' . $eID . '?\')" type="button"><span class="material-symbols-outlined">delete</span></a></td>';
                    } else if ($status == "NA" && $date->format('Y-m-d') < $row['StartDate']) {
                        echo '<td class="st"><a href="includes/admin/event/admin_readd_event.php?eID=' . $eID . ' " class="button readd" onclick="return confirm(\'Proceed to re-active the event ' . $eID . '?\')" type="button"><span class="material-symbols-outlined">add_circle</span></a></td>';
                    } else {
                        echo '<td class="st"><a class="button disabled" type="button" disabled="true"><span class="material-symbols-outlined">block</span></a></td>';
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="total" colspan="5">TOTAL RECORD(S): <?php echo $total ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</article>


