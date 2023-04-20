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
if (isset($_GET['eID'])) {
    include './includes/admin/event/admin_event_validate.php';
    $eventId = trim($_GET['eID']);

    $editCommand = "SELECT * FROM event WHERE EventID = '$eventId' AND AdminID = '$msID'";

    $result = mysqli_query($dbConnection, $editCommand);

    $eType = substr($eventId, 0, 2);

    if ($result->num_rows == 1) {
        $event = mysqli_fetch_object($result);

        $imgE = $event->EventImg;
        $eventID = $event->EventID;
        $eventName = $event->EventName;
        $sDate = $event->StartDate;
        $eDate = $event->EndDate;
        $sTime = $event->StartTime;
        $eTime = $event->EndTime;
        $duration = $event->Duration;
        $capacity = $event->Capacity;
        $venue = $event->Venue;
        $fees = $event->Fees;
        $status = $event->Status;
    }
}
?>

<article class="text-center d-flex justify-content-center pt-5">

    <!-- events & activities -->
    <div class="container-fluid d-flex justify-content-center">
        <form method="POST" action="" id="submitEvent" enctype="multipart/form-data">
            <table class="mb-2">
                <?php
                if (isset($_POST['editEvent'])) {

                    global $imgE;

                    $eID = isset($_POST['eventID']) ? trim($_POST['eventID']) : null;
                    $eType = substr($eID, 0, 2);
                    $eImg = $_FILES['eventImg']['error'];
                    $eImgName = $_FILES['eventImg']['name'];
                    $eName = isset($_POST['eventName']) ? trim($_POST['eventName']) : null;
                    $sDate = isset($_POST['startDate']) ? trim($_POST['startDate']) : null;
                    $eDate = isset($_POST['endDate']) ? trim($_POST['endDate']) : null;
                    $sTime = isset($_POST['startTime']) ? intval($_POST['startTime']) : null;
                    $eTime = isset($_POST['endTime']) ? intval($_POST['endTime']) : null;
                    if ($eType == "CC" || $eType == "WS") {
                        $duration = ($eTime - $sTime) / 100;
                    } else {
                        $duration = "";
                    }
                    $capacity = isset($_POST['capacity']) ? intval($_POST['capacity']) : null;
                    $venue = isset($_POST['venue']) ? trim($_POST['venue']) : null;
                    $status = isset($_POST['status']) ? trim($_POST['status']) : null;
                    $price = isset($_POST['price']) ? trim($_POST['price']) : null;

                    if ($eImg > 0) {
                        $errMsgImg = array();
                    } else {
                        $errMsgImg = validateImg($eImg, $eImgName);
                    }
                    $errMsgName = validateEventName($eName);
                    $errMsgSDate = validateSDate($sDate);
                    $errMsgEDate = validateEDate($sDate, $eDate);
                    if ($eType == "CC" || $eType == "WS") {
                        $errMsgTime = validateTime($sTime, $eTime);
                    } else {
                        $errMsgTime = array();
                    }
                    $errMsgCapacity = validateCapacity($capacity);
                    $errMsgStatus = validateStatus($status);

                    $finalErrMsg = array_merge(array_merge(array_merge(array_merge(array_merge(array_merge($errMsgName, $errMsgSDate), $errMsgEDate), $errMsgTime), $errMsgCapacity), $errMsgStatus), $errMsgImg);

                    //error message
                    if (count($finalErrMsg) > 0) {
                        echo "<div class='alert'>";
                        echo "<span class='closebtn'>&times;</span>";
                        echo "<strong>Warning!</strong>";
                        echo "<ul class='list-group list-group-flush list-group-numbered'>";
                        foreach ($finalErrMsg as $message) {
                            echo "<li class='list-group-item error' style='background-color: #f44336; color: white;'>$message</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    } else {

                        if ($eImg == 0) {

                            //delete old image
                            $oldEImg = "images/event_images/$imgE";

                            if (file_exists($oldEImg)) {
                                unlink($oldEImg);
                            }

                            $image = pathinfo($eImgName);
                            $ext = $image['extension'];
                            $eImgName = $eID . "." . $ext;

                            if (move_uploaded_file($_FILES['eventImg']['tmp_name'], "images/event_images/{$eImgName}")) { //if change image
                                $img = $eImgName;

                                if ($eType == "CC" || $eType == "WS") {
                                    $editEvent = "UPDATE `event` SET `EventName`='$eName',`StartDate`='$sDate',`EndDate`='$eDate',`StartTime`='$sTime',`EndTime`='$eTime',`Duration`='$duration',`Capacity`='$capacity',`Venue`='$venue',`Fees`='$price',`Status`='$status', `EventImg`='$img' WHERE EventID = '$eID' AND AdminID = '$msID'";
                                    $result = mysqli_query($dbConnection, $editEvent);
                                } else if ($eType == "CP") {
                                    $editEvent = "UPDATE `event` SET `EventName`='$eName',`StartDate`='$sDate',`EndDate`='$eDate',`StartTime`=NULL,`EndTime`=NULL,`Duration`=NULL,`Capacity`=NULL,`Venue`='$venue',`Fees`='$price',`Status`='$status', `EventImg`='$img' WHERE EventID = '$eID' AND AdminID = '$msID'";
                                    $result = mysqli_query($dbConnection, $editEvent);
                                } else {
                                    echo "Error! Please contact to the author of the program!";
                                    exit();
                                }

                                echo "<script>alert('Event $eventID details successfully ammended.')</script>";
                                echo "<script type='text/javascript'>window.location.replace('admin_list_event.php') </script>";
                            }
                        } else { //if no change image 
                            if ($eType == "CC" || $eType == "WS") {
                                $editEvent = "UPDATE `event` SET `EventName`='$eName',`StartDate`='$sDate',`EndDate`='$eDate',`StartTime`='$sTime',`EndTime`='$eTime',`Duration`='$duration',`Capacity`='$capacity',`Venue`='$venue',`Fees`='$price',`Status`='$status' WHERE EventID = '$eID' AND AdminID = '$msID'";
                                $result = mysqli_query($dbConnection, $editEvent);
                            } else if ($eType == "CP") {
                                $editEvent = "UPDATE `event` SET `EventName`='$eName',`StartDate`='$sDate',`EndDate`='$eDate',`StartTime`=NULL,`EndTime`=NULL,`Duration`=NULL,`Capacity`=NULL,`Venue`='$venue',`Fees`='$price',`Status`='$status' WHERE EventID = '$eID' AND AdminID = '$msID'";
                                $result = mysqli_query($dbConnection, $editEvent);
                            } else {
                                echo "Error! Please contact to the author of the program!";
                                exit();
                            }

                            echo "<script>alert('Event $eventID details successfully ammended.')</script>";
                            echo "<script type='text/javascript'>window.location.replace('admin_list_event.php') </script>";
                        }
                    }
                }
                ?>
                <!-- Event Images-->
                <tr>
                    <td class="mb-3">
                        <label for="eventImg" class="form-control text-center eImg">
                            <span class="material-symbols-outlined">imagesmode</span><br/>
                            <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" name="eventImg" style="display: none;" id="eventImg"  onchange="loadFile(event)"/>
                            <img id="output" style="width: 400px; height: 400px; margin-left: auto; margin-right: auto; border-radius: 5px;" src="images/event_images/<?php echo $imgE; ?>"/>
                        </label>
                    </td>
                </tr>

                <!-- Event ID-->
                <tr>
                    <td class="input-group mt-3 mb-3">
                        <label for="eventID" class="input-group-text">
                            <span class="material-symbols-outlined">calendar_month</span>
                            Event ID
                        </label>
                        <input class="form-control" type="text" name="eventID" id="eventID" value="<?php echo $eventID; ?>" disabled="true"/>
                        <input type="hidden" name="eventID" value="<?php echo $eventID; ?>"/>
                    </td>
                </tr>

                <!-- Event Name-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="eventName" class="input-group-text">
                            <span class="material-symbols-outlined">event</span>
                            Event Name
                        </label>
                        <input class="form-control" type="text" name="eventName" id="eventName" value="<?php echo $eventName; ?>"/>
                    </td>
                </tr>


                <!-- Event Start Date-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="startDate" class="input-group-text">
                            <span class="material-symbols-outlined">today</span>
                            Start Date
                        </label>
                        <input class="form-control" type="date" name="startDate" id="startDate" value="<?php echo $sDate; ?>"/>
                    </td>
                </tr>

                <!-- Event End Date-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="endDate" class="input-group-text">
                            <span class="material-symbols-outlined">today</span>
                            End Date
                        </label>
                        <input class="form-control" type="date" name="endDate" id="endDate" value="<?php echo $eDate; ?>"/>
                    </td>
                </tr>

                <!-- Event Time-->
                <tr>
                    <td class="input-group mb-3">
                        <!-- Event Start Time -->
                        <label class="input-group-text">
                            <span class="material-symbols-outlined">schedule</span>
                            Time
                        </label>
                        <select class="form-select" name="startTime" id="startTime" onchange="time();" <?php echo ($eType == "CP") ? "disabled='true'" : ""; ?>>
                            <option selected="true">Start Time</option>
                            <option value="0900" <?php echo ($sTime == 900) ? "selected" : ""; ?>>0900</option>
                            <option value="1000" <?php echo ($sTime == 1000) ? "selected" : ""; ?>>1000</option>
                            <option value="1100" <?php echo ($sTime == 1100) ? "selected" : ""; ?>>1100</option>
                            <option value="1200" <?php echo ($sTime == 1200) ? "selected" : ""; ?>>1200</option>
                            <option value="1300" <?php echo ($sTime == 1300) ? "selected" : ""; ?>>1300</option>
                            <option value="1400" <?php echo ($sTime == 1400) ? "selected" : ""; ?>>1400</option>
                            <option value="1500" <?php echo ($sTime == 1500) ? "selected" : ""; ?>>1500</option>
                            <option value="1600" <?php echo ($sTime == 1600) ? "selected" : ""; ?>>1600</option>
                            <option value="1700" <?php echo ($sTime == 1700) ? "selected" : ""; ?>>1700</option>
                            <option value="1800" <?php echo ($sTime == 1800) ? "selected" : ""; ?>>1800</option>
                            <option value="1900" <?php echo ($sTime == 1900) ? "selected" : ""; ?>>1900</option>
                            <option value="2000" <?php echo ($sTime == 2000) ? "selected" : ""; ?>>2000</option>
                            <option value="2100" <?php echo ($sTime == 2100) ? "selected" : ""; ?>>2100</option>
                        </select>
                        <input type="hidden" name="startTime" value="<?php echo $sTime; ?>" id="dSTime"/>
                        <div class="input-group-text">To</div>
                        <!-- Event End Time-->
                        <select class="form-select" name="endTime" id="endTime" onchange="time();" <?php echo ($eType == "CP") ? "disabled='true'" : ""; ?>>
                            <option selected="true">End Time</option>
                            <option value="1000" <?php echo ($eTime == 1000) ? "selected" : ""; ?>>1000</option>
                            <option value="1100" <?php echo ($eTime == 1100) ? "selected" : ""; ?>>1100</option>
                            <option value="1200" <?php echo ($eTime == 1200) ? "selected" : ""; ?>>1200</option>
                            <option value="1300" <?php echo ($eTime == 1300) ? "selected" : ""; ?>>1300</option>
                            <option value="1400" <?php echo ($eTime == 1400) ? "selected" : ""; ?>>1400</option>
                            <option value="1500" <?php echo ($eTime == 1500) ? "selected" : ""; ?>>1500</option>
                            <option value="1600" <?php echo ($eTime == 1600) ? "selected" : ""; ?>>1600</option>
                            <option value="1700" <?php echo ($eTime == 1700) ? "selected" : ""; ?>>1700</option>
                            <option value="1800" <?php echo ($eTime == 1800) ? "selected" : ""; ?>>1800</option>
                            <option value="1900" <?php echo ($eTime == 1900) ? "selected" : ""; ?>>1900</option>
                            <option value="2000" <?php echo ($eTime == 2000) ? "selected" : ""; ?>>2000</option>
                            <option value="2100" <?php echo ($eTime == 2100) ? "selected" : ""; ?>>2100</option>
                            <option value="2200" <?php echo ($eTime == 2200) ? "selected" : ""; ?>>2200</option>
                        </select>
                        <input type="hidden" name="startTime" value="<?php echo $eTime; ?>" id="dETime" disabled="true"/>
                    </td>
                </tr>

                <!-- Event Duration -->
                <tr>
                    <td class="input-group mb-3">
                        <label for="duration" class="input-group-text">
                            <span class="material-symbols-outlined">timer</span>
                            Duration per Day
                        </label>
                        <input class="form-control" id="duration" type="text" value="<?php echo ($duration == 0) ? "" : $duration; ?>" name="duration" disabled="true"/>
                    </td>
                </tr>

                <!-- Event Capacity-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="capacity" class="input-group-text">
                            <span class="material-symbols-outlined">groups</span>
                            Capacity
                        </label>
                        <input class="form-control" type="number" name="capacity" id="capacity" max="150" step="10" value="<?php echo ($capacity == 0) ? "" : $capacity; ?>" <?php echo ($eType == "CP") ? "disabled='true'" : ""; ?>/>
                        <input type="hidden" name="capacity" value="<?php echo $capacity; ?>" id="dCP" disabled="true"/>
                    </td>
                </tr>

                <!-- Event Venue-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="capacity" class="input-group-text">
                            <span class="material-symbols-outlined">location_on</span>
                            Venue
                        </label>
                        <input class="form-control" type="text" name="venue" id="venue" value="<?php echo $venue ?>"/>
                    </td>
                </tr>

                <!-- Event Status-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="capacity" class="input-group-text">
                            <span class="material-symbols-outlined">legend_toggle</span>
                            Status
                        </label>
                        <select class="form-select" name="status" id="status" required="true">
                            <option selected="true">Select Event Status</option>
                            <option value="AL" <?php echo ($status == "AL") ? "selected" : ""; ?>>AL - <?php echo statusFullName("AL"); ?></option>
                            <option value="NA" <?php echo ($status == "NA") ? "selected" : ""; ?>>NA - <?php echo statusFullName("NA"); ?></option>
                        </select>
                    </td>
                </tr>

                <!-- Event Price-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="price" class="input-group-text">
                            <span class="material-symbols-outlined">payments</span>
                            Fees $
                        </label>
                        <input class="form-control" type="text" name="price" id="price" disabled="true" value="<?php echo $fees; ?>"/>
                        <input type="hidden" name="price" id="price" value="<?php echo $fees; ?>"/>
                        <label fot="price" class="input-group-text">.00</label>
                    </td>
                </tr>

                <!-- Form submit and reset -->
                <tr>
                    <td>
                        <button class="button edit" style="width: 40%;" type="submit" name="editEvent" onclick="return confirm('Are you sure to edit the Event <?php echo $eventID; ?>?')"><span class="material-symbols-outlined">edit_note</span>EDIT</button>
                        <button class="button back" onclick="location.reload(); history.back();" style="width: 40%;"><span class="material-symbols-outlined">cancel</span>CANCEL</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</article>


