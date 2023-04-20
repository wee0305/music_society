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
   
   Filename: add_event_article.php

-->

<article class="text-center d-flex justify-content-center pt-5">

    <!-- events & activities -->
    <div class="container-fluid d-flex justify-content-center">
        <form method="POST" action="admin_add_event.php" id="submitEvent" enctype="multipart/form-data">
            <table class="mb-2" style="width: 100%;">
                <!-- add event function and check the input error -->
                <?php
                include './includes/admin/event/admin_event_validate.php';
                if (isset($_POST['addEvent'])) {
                    $eImg = $_FILES['eventImg']['error'];
                    $eImgName = $_FILES['eventImg']['name'];
                    $eType = isset($_POST['eTypeID']) ? trim($_POST['eTypeID']) : null;
                    $eID = isset($_POST['eventID']) ? trim($_POST['eventID']) : null;
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

                    $errMsgImg = validateImg($eImg, $eImgName);
                    $errMsgID = validateEventId($eID);
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

                    $finalErrMsg = array_merge(array_merge(array_merge(array_merge(array_merge(array_merge(array_merge($errMsgID, $errMsgName), $errMsgSDate), $errMsgEDate), $errMsgTime), $errMsgCapacity), $errMsgStatus), $errMsgImg);

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
                        
                        $image = pathinfo($eImgName);
                        $ext = $image['extension'];
                        $eImgName = $eID . "." . $ext;
                        
                        if (move_uploaded_file($_FILES['eventImg']['tmp_name'], "images/event_images/{$eImgName}")) {
                            $img = $eImgName;

                            if ($eType == "CC" || $eType == "WS") {
                                $addEvent = "INSERT INTO `event` (`EventID`, `EventName`, `StartDate`, `EndDate`, `StartTime`, `EndTime`, `Duration`, `Capacity`, `Venue`, `Fees`, `Status`, `EventImg`, `AdminID`) VALUES ('$eID', '$eName', '$sDate', '$eDate', '$sTime', '$eTime', '$duration', '$capacity', '$venue', '$price', '$status', '$img', '$msID');";
                                $result = mysqli_query($dbConnection, $addEvent);
                            } else if ($eType == "CP") {
                                $addEvent = "INSERT INTO `event` (`EventID`, `EventName`, `StartDate`, `EndDate`, `StartTime`, `EndTime`, `Duration`, `Capacity`, `Venue`, `Fees`, `Status`, `EventImg`, `AdminID`) VALUES ('$eID', '$eName', '$sDate', '$eDate', NULL, NULL, NULL, NULL, '$venue', '$price', '$status', '$img', '$msID');";
                                $result = mysqli_query($dbConnection, $addEvent);
                            } else {
                                echo "Error! Please contact to the author of the program!";
                                exit();
                            }

                            echo "<script>alert('event adding successfully!')</script>";
                            echo "<script type='text/javascript'>window.location.replace('admin_list_event.php') </script>";
                        } else {
                            echo "<script>alert('Please upload the event image!')</script>";
                        }
                    }
                }
                ?>

                <!-- Event Images-->
                <tr>
                    <td class="mb-3">
                        <label for="eventImg" class="form-control text-center eImg">
                            <span class="material-symbols-outlined">imagesmode</span><br/>
                            <p style="margin-bottom: 0px;" id="word">Upload Event Image</p>
                            <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" name="eventImg" value="" style="display: none;" id="eventImg"  onchange="loadFile(event)"/>
                            <img id="output" style="width: 400px; height: 400px; display: none; margin-left: auto; margin-right: auto; border-radius: 5px;"/>
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
                        <select class="form-select" name="eTypeID" id="eTypeID" onchange="eType();">
                            <option selected="true">Select event type</option>
                            <option value="CC">CC - <?php echo eventTypeName("CC"); ?></option>
                            <option value="CP">CP - <?php echo eventTypeName("CP"); ?></option>
                            <option value="WS">WS - <?php echo eventTypeName("WS"); ?></option>
                        </select>
                        <input class="form-control" type="text" id="eventID"  value="" name="eventID" readonly="true"/>
                    </td>
                </tr>

                <!-- Event Name-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="eventName" class="input-group-text">
                            <span class="material-symbols-outlined">event</span>
                            Event Name
                        </label>
                        <input class="form-control" type="text" name="eventName" id="eventName" required="true" value="<?php echo isset($_POST['eventName']) ? $_POST['eventName'] : "" ?>"/>
                    </td>
                </tr>

                <!-- Event Start Date-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="startDate" class="input-group-text">
                            <span class="material-symbols-outlined">today</span>
                            Start Date
                        </label>
                        <input class="form-control" type="date" name="startDate" id="startDate" value="<?php echo isset($_POST['startDate']) ? $_POST['startDate'] : "" ?>"/>
                    </td>
                </tr>

                <!-- Event End Date-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="endDate" class="input-group-text">
                            <span class="material-symbols-outlined">today</span>
                            End Date
                        </label>
                        <input class="form-control" type="date" name="endDate" id="endDate" value="<?php echo isset($_POST['endDate']) ? $_POST['endDate'] : "" ?>"/>
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
                        <select class="form-select" name="startTime" id="startTime" onchange="time();">
                            <option selected="true">Start Time</option>
                            <option value="0900">0900</option>
                            <option value="1000">1000</option>
                            <option value="1100">1100</option>
                            <option value="1200">1200</option>
                            <option value="1300">1300</option>
                            <option value="1400">1400</option>
                            <option value="1500">1500</option>
                            <option value="1600">1600</option>
                            <option value="1700">1700</option>
                            <option value="1800">1800</option>
                            <option value="1900">1900</option>
                            <option value="2000">2000</option>
                            <option value="2100">2100</option>
                        </select>
                        <input type="hidden" name="startTime" value="" id="dSTime" disabled="true"/>
                        <div class="input-group-text">To</div>
                        <!-- Event End Time-->
                        <select class="form-select" name="endTime" id="endTime" onchange="time();">
                            <option selected="true">End Time</option>
                            <option value="1000">1000</option>
                            <option value="1100">1100</option>
                            <option value="1200">1200</option>
                            <option value="1300">1300</option>
                            <option value="1400">1400</option>
                            <option value="1500">1500</option>
                            <option value="1600">1600</option>
                            <option value="1700">1700</option>
                            <option value="1800">1800</option>
                            <option value="1900">1900</option>
                            <option value="2000">2000</option>
                            <option value="2100">2100</option>
                            <option value="2200">2200</option>
                        </select>
                        <input type="hidden" name="startTime" value="" id="dETime" disabled="true"/>
                    </td>
                </tr>

                <!-- Event Duration -->
                <tr>
                    <td class="input-group mb-3">
                        <label for="duration" class="input-group-text">
                            <span class="material-symbols-outlined">timer</span>
                            Duration per Day
                        </label>
                        <input class="form-control" id="duration" type="text" value="" disabled="true"/>
                    </td>
                </tr>

                <!-- Event Capacity-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="capacity" class="input-group-text">
                            <span class="material-symbols-outlined">groups</span>
                            Capacity
                        </label>
                        <select class="form-select" name="capacity" id="capacity" required="true">
                            <option id="defaultSelect" selected="true">Select Event Capacity</option>
                            <option value="15">15</option>
                            <option value="150">150</option>
                        </select>
                        <input type="hidden" name="capacity" value="NULL" id="dCP" disabled="true"/>
                    </td>
                </tr>

                <!-- Event Venue-->
                <tr>
                    <td class="input-group mb-3">
                        <label for="capacity" class="input-group-text">
                            <span class="material-symbols-outlined">location_on</span>
                            Venue
                        </label>
                        <input class="form-control" type="text" name="venue" id="venue" value="<?php echo isset($_POST['venue']) ? $_POST['venue'] : "" ?>"/>
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
                            <option value="AL">AL - <?php echo statusFullName("AL"); ?></option>
                            <option value="NA">NA - <?php echo statusFullName("NA"); ?></option>
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
                        <input class="form-control" type="text" name="price" id="price" disabled="true"/>
                        <input type="hidden" name="price" id="fees"/>
                        <label fot="fees" class="input-group-text">.00</label>
                    </td>
                </tr>

                <!-- Form submit and reset -->
                <tr>
                    <td>
                        <button class="button add" style="width: 30%;" type="submit" name="addEvent"><span class="material-symbols-outlined">library_add</span>ADD</button>
                        <button class="button reset" style="width: 30%;" type="reset"><span class="material-symbols-outlined">restart_alt</span>RESET</button>
                        <button class="button back" onclick="location.reload(); history.back();" style="width: 30%;" type="button"><span class="material-symbols-outlined">cancel</span>CANCEL</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</article>


