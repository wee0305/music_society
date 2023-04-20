<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author: Eric Chee Wei Jiat
   Date: 15/8/2022
   
   Filename: list_booking_article.php

-->

<article class="text-center justify-content-center pt-5">

    <!-- Event Name -->
    <div class="e-details">
        <?php
        if (isset($_GET['eID'])) {
            $eID = $_GET['eID'];
            $eventCommand = "SELECT * FROM event WHERE EventID = '$eID'";
            $eventResult = mysqli_query($dbConnection, $eventCommand);

            while ($e = mysqli_fetch_array($eventResult)) {
                echo "<img src='images/event_images/" . $e['EventImg'] . "' alt='" . $e['EventImg'] . "'/>";
                echo "<h1 class='e-name'>" . $e['EventName'] . " <br/>(" . $e['EventID'] . ")</h1>";
            }
        } else {
            echo "<h1>Warning!!</h1>";
            echo "<h2>No permission allowed to access this page!</h2>";
            echo "<a href='index.php'>home</a>";
            exit();
        }
        ?>
    </div>

    <!-- view capacity -->
    <div class="container-fluid d-flex justify-content-center">
        <table id="capacityListing">
            <thead>
                <tr class="title">
                    <th><span class="material-symbols-outlined">numbers</span>No.</th>
                    <th><span class="material-symbols-outlined">calendar_month</span>Registration ID </th>
                    <th><span class="material-symbols-outlined">person</span>Student ID</th>
                    <th class="none"><span class="material-symbols-outlined">badge</span>Student Name</th>
                    <th class="none"><span class="material-symbols-outlined">mail</span>Email</th>
                    <th class="none"><span class="material-symbols-outlined">phone</span>Contact</th>
                    <th><span class="material-symbols-outlined">legend_toggle</span>Registration Status</th>
                    <th><span class="material-symbols-outlined">pageview</span>Details</th>
                    <th colspan="2"><span class="material-symbols-outlined">payments</span>Payment Status</th>
                </tr>
            </thead>
            <tbody class="post_data">
                <?php
                $selectCommand = "SELECT * FROM register R, member M, event E, Payment P, admin A WHERE A.AdminID = '$msID' AND R.StudentID = M.StudentID AND E.EventID = R.EventID AND E.EventID = '$eID' AND P.TransID = R.TransID ORDER BY RegStatus";
                $results = mysqli_query($dbConnection, $selectCommand);
                $total = 0;
                while ($row = mysqli_fetch_array($results)) {
                    $total++;
                    $sID = $row['StudentID'];
                    $tID = $row['TransID'];
                    $lname = $row['LastName'];
                    $fname = $row['FirstName'];
                    echo "<tr class='data'>";
                    echo "<td class='no st'>$total</td>";
                    echo "<td class='st'>" . $row['RegID'] . "</td>";
                    echo "<td class='st'>$sID</td>";
                    echo "<td class='none st'>" . $lname . " " . $fname . "</td>";
                    echo "<td class='none st'>" . $row['StudentEmail'] . "</td>";
                    echo "<td class='none st'>" . $row['Contact'] . "</td>";
                    echo "<td class='none st'>" . $row['RegStatus'] . "</td>";
                    echo "<td class='st'><a href='admin_register_details.php?eID=" . $row['EventID'] . "&sID=" . $sID . "&regId=" . $row['RegID'] . "&tID=" . $tID . "' class='button edit'><span class='material-symbols-outlined'>pageview</span></a></td>";
                    $eType = substr($eID, 0, 2);
                    $eStatus = $row['Status'];
                    if ($eStatus == "AL" && $row['RegStatus'] == "AC" && $eType == "CC") {
                        echo "<td class='st'><button class='button back'><span class='material-symbols-outlined'>paid</span>$tID</button></td>";
                        echo '<td class="st"><button class="button delete" type="button" '
                        . 'onclick="return confirm (\'Proceed to cancel the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_cancel_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                        . '<span class="material-symbols-outlined">close</span></button></td>';
                    } else if ($eStatus == "AL" && ($eType == "CP" || $eType == "WS")) {
                        if ($row['RegStatus'] == "AC") {
                            echo "<td class='st'><button class='button back'><span class='material-symbols-outlined'>paid</span>$tID</button></td>";
                            echo '<td class="st"><button class="button delete" type="button" '
                            . 'onclick="return confirm (\'Proceed to cancel the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_cancel_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                            . '<span class="material-symbols-outlined">close</span></button></td>';
                        } else if ($row['RegStatus'] == "PD" && $eType == "CP") {
                            echo '<td class="st"><button class="button confirm" type="button" '
                            . 'onclick="return confirm (\'Proceed to accept the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_add_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                            . '<span class="material-symbols-outlined">check</span></button></td>';
                            echo '<td class="st"><button class="button delete" type="button" '
                            . 'onclick="return confirm (\'Proceed to reject the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_cancel_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                            . '<span class="material-symbols-outlined">close</span></button></td>';
                        } else if ($row['RegStatus'] == "RJ") {
                            echo '<td class="st" colspan="2"><button class="button readd" type="button" '
                            . 'onclick="return confirm (\'Proceed to accept the registration for student ' . $sID . ' ' . $lname . ' ' . $fname . '?\') ? window.location.href=\'includes/admin/register/admin_add_register.php?sID=' . $sID . '&eID=' . $eID . '\' : \'\' ">'
                            . '<span class="material-symbols-outlined">add_circle</span></button></td>';
                        } else {
                            echo '<td class="st"><a class="button disabled" type="button" disabled="true"><span class="material-symbols-outlined">block</span>CANCEL</a></td>';
                        }
                    } else {
                        echo '<td class="st" colspan="2"><a class="button disabled" type="button" disabled="true"><span class="material-symbols-outlined">block</span>CANCEL</a></td>';
                    }
                    echo "</tr>";
                }

                if ($total == 0) {
                    echo "<tr class='data'>";
                    echo "<td class='st' colspan='9'>No record(s) found.</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="btnGroup">
        <button class="button back" onclick="location.href = 'admin_event_details.php?eID=<?php echo $eID ?>'" type="button"><span class="material-symbols-outlined">undo</span>BACK</button>
        <button class="button backToList" onclick="location.href = 'admin_list_event.php'" type="button"><span class="material-symbols-outlined">arrow_back</span>BACK TO LIST</button>
        <button class="button print" onclick="window.print()" title="Click here to Print" type="button"><span class="material-symbols-outlined">print</span>PRINT</button>
    </div>
</article>

