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
//   Filename: admin_search_event.php

include './../../msDBConnect.php';
include '../../../css/admin_table.css';
include '../../session.php';
$msID = $_SESSION['msId'];
//get today date
date_default_timezone_set('Asia/Kuala_Lumpur');
$date = NEW DateTime('now');
$today = $date->format('Y-m-d');

if (isset($_REQUEST["term"])) {
    global $msID;
    $searchQuery = "SELECT * FROM event WHERE (AdminID  = '$msID') AND (EventID LIKE ? OR EventName LIKE ? OR StartDate LIKE ? OR EndDate LIKE ? OR StartTime LIKE ? OR EndTime LIKE ? OR Status LIKE ?) ORDER BY StartDate < '$today', Status";
    $stmt = mysqli_prepare($dbConnection, $searchQuery);
    if ($stmt) {

        //set parameters
        $eid = '%' . $_REQUEST["term"] . '%';
        $ename = '%' . $_REQUEST["term"] . '%';
        $sdt = '%' . $_REQUEST["term"] . '%';
        $edt = '%' . $_REQUEST["term"] . '%';
        $est = '%' . $_REQUEST["term"] . '%';
        $eet = '%' . $_REQUEST["term"] . '%';
        $estatus = '%' . $_REQUEST["term"] . '%';

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $eid, $ename, $sdt, $etd, $est, $eet, $estatus);

        //attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            //check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                $total = 0;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $eID = $row['EventID'];
                    //check the end date of the event
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
                        echo '<td class="st"><a href="includes/admin/event/admin_delete_event.php?eID=' . $eID . ' " class="button delete" onclick="return confirm(\'Are you sure want to drop the event ' . $eID . '?\')" type="button"><span class="material-symbols-outlined">delete</span></a></td>';
                    } else if ($status == "NA" && $date->format('Y-m-d') < $row['StartDate']) {
                        echo '<td class="st"><a href="includes/admin/event/admin_readd_event.php?eID=' . $eID . ' " class="button readd" onclick="return confirm(\'Are you sure want to readd the event ' . $eID . '?\')" type="button"><span class="material-symbols-outlined">add_circle</span></a></td>';
                    } else {
                        echo '<td class="st"><a class="button disabled" type="button" disabled="true"><span class="material-symbols-outlined">block</span></a></td>';
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td colspan='9' style='height: 100px;'>No matches found</td>";
                echo "</tr>";
            }
        }
    }
    mysqli_stmt_close($stmt);
}

