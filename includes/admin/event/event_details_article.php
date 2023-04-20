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
   
   Filename: edit_event_article.php

-->
<?php
include './includes/admin/event/admin_event_validate.php';

if (isset($_GET['eID'])) {
    $eID = $_GET['eID'];
    $eventList = "SELECT * FROM event WHERE EventID = '$eID' AND AdminID = '$msID'";
    $result = mysqli_query($dbConnection, $eventList);

    if ($result->num_rows == 1) {
        $event = mysqli_fetch_object($result);
        $eventId = $eID;
        $eventName = $event->EventName;
        $startDate = $event->StartDate;
        $endDate = $event->EndDate;
        $startTime = $event->StartTime;
        $endTime = $event->EndTime;
        $duration = $event->Duration;
        $capacity = $event->Capacity;
        $venue = $event->Venue;
        $fees = $event->Fees;
        $status = $event->Status;
        $eventImg = $event->EventImg;
    }
    $eType = substr($eventId, 0, 2);
}
?>
<article class="text-center justify-content-center pt-5">

    <!-- events & activities -->
    <div class="container-fluid d-flex justify-content-center mb-5">

        <!-- Event Images-->
        <div class="eventImg">
            <img src="images/event_images/<?php echo $eventImg ?>" class="imgEvent" alt="<?php echo $eventImg; ?>"/>     
        </div>

        <table class="mb-2">

            <!-- Event ID-->
            <tr>
                <td>
                    <!-- Event Images-->
                    <img src="images/event_images/<?php echo $eventImg ?>" class="pEventImg" alt="<?php echo $eventImg; ?>"/>  
                </td>
            </tr>
            <tr>
                <td class="input-group mt-3 mb-3">
                    <label for="eventID" class="input-group-text">
                        <span class="material-symbols-outlined">calendar_month</span>
                        Event ID
                    </label>
                    <input class="form-control" type="text" name="eventID" id="eventID" value="<?php echo $eventId . " - " . eventTypeName($eType); ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event Name-->
            <tr>
                <td class="input-group mb-3">
                    <label for="eventName" class="input-group-text">
                        <span class="material-symbols-outlined">event</span>
                        Event Name
                    </label>
                    <input class="form-control" type="text" name="eventName" id="eventName" value="<?php echo $eventName ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event Start Date-->
            <tr>
                <td class="input-group mb-3">
                    <label for="startDate" class="input-group-text">
                        <span class="material-symbols-outlined">today</span>
                        Start Date
                    </label>
                    <input class="form-control" type="text" name="startDate" id="startDate" value="<?php echo $startDate ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event End Date-->
            <tr>
                <td class="input-group mb-3">
                    <label for="endDate" class="input-group-text">
                        <span class="material-symbols-outlined">today</span>
                        End Date
                    </label>
                    <input class="form-control" type="text" name="endDate" id="endDate" value="<?php echo $endDate ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event Start Time-->
            <tr>
                <td class="input-group mb-3">
                    <label for="startTime" class="input-group-text">
                        <span class="material-symbols-outlined">schedule</span>
                        Start Time
                    </label>
                    <input class="form-control" type="text" name="startTime" id="startTime" value="<?php echo ($startTime == null) ? "----" : sprintf("%04d", $startTime) ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event End Time-->
            <tr>
                <td class="input-group mb-3">
                    <label for="endTime" class="input-group-text">
                        <span class="material-symbols-outlined">schedule</span>
                        End Time
                    </label>
                    <input class="form-control" type="text" name="endTime" id="endTime" value="<?php echo ($endTime == null) ? "----" : sprintf("%04d", $endTime) ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event Duration -->
            <tr>
                <td class="input-group mb-3">
                    <label for="duration" class="input-group-text">
                        <span class="material-symbols-outlined">timer</span>
                        Duration per Day
                    </label>
                    <input class="form-control" id="duration" type="text" value="<?php echo ($duration == null) ? "----" : $duration . "hrs" ?>" name="duration" disabled="true"/>
                </td>
            </tr>

            <!-- Event Capacity-->
            <tr>
                <td class="input-group mb-3">
                    <label for="capacity" class="input-group-text">
                        <span class="material-symbols-outlined">groups</span>
                        Capacity
                    </label>
                    <input class="form-control" type="text" name="capacity" id="capacity" value="<?php echo ($capacity == null) ? "----" : $capacity ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event Venue-->
            <tr>
                <td class="input-group mb-3">
                    <label for="capacity" class="input-group-text">
                        <span class="material-symbols-outlined">location_on</span>
                        Venue
                    </label>
                    <input class="form-control" type="text" name="venue" id="venue" value="<?php echo $venue ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event Status-->
            <tr>
                <td class="input-group mb-3">
                    <label for="capacity" class="input-group-text">
                        <span class="material-symbols-outlined">legend_toggle</span>
                        Status
                    </label>
                    <input class="form-control" type="text" name="status" id="status" value="<?php echo $status . " - " . statusFullName($status) ?>" disabled="true"/>
                </td>
            </tr>

            <!-- Event Price-->
            <tr>
                <td class="input-group mb-3">
                    <label for="price" class="input-group-text">
                        <span class="material-symbols-outlined">payments</span>
                        Fees $
                    </label>
                    <input class="form-control" type="text" name="price" id="price" value="<?php echo "RM" . $fees . ".00" ?>" disabled="true"/>
                </td>
            </tr>
        </table>
    </div>
    <div class="btnGroup">
        <button class="button edit" onclick="window.location.href = 'admin_edit_event.php?eID=<?php echo $eID ?>'" type="button"><span class="material-symbols-outlined">edit_note</span>EDIT</button>
        <button class="button back" onclick="location.href = 'admin_list_event.php'" type="button"><span class="material-symbols-outlined">undo</span>BACK</button>
        <button class="button capacity" onclick="window.location.href = 'admin_list_register.php?eID=<?php echo $eID ?>';" type="button"><span class="material-symbols-outlined">groups</span>CAPACITY</button>
        <?php
        global $startDate, $status;
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $date = NEW DateTime('now');
        if ($status == "AL") {
            echo '<td class="st"><a href="includes/admin/event/admin_delete_event.php?eID=' . $eID . ' " class="button delete" onclick="return confirm(\'Proceed to disable the event ' . $eID . '?\')" type="button"><span class="material-symbols-outlined">delete</span>DROP</a></td>';
        } else if ($status == "NA" && $date->format('Y-m-d') < $startDate) {
            echo '<td class="st"><a href="includes/admin/event/admin_readd_event.php?eID=' . $eID . ' " class="button readd" onclick="return confirm(\'Proceed to re-active the event ' . $eID . '?\')" type="button"><span class="material-symbols-outlined">add_circle</span>READD</a></td>';
        }
        ?>
        <button class="button print" onclick="window.print()" title="Click here to Print" type="button"><span class="material-symbols-outlined">print</span>PRINT</button>
    </div>
</article>


