<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Leong Kuan Fei
   Date: 18/8/2022
   
   Filename: member_seat_selection_article.php

-->

<?php
global $regId, $eID, $eName, $eType;
$capacitySQL = "SELECT * FROM event WHERE EventID = '$eID'";
$cp = mysqli_query($dbConnection, $capacitySQL);
while ($row = mysqli_fetch_array($cp)) {
    $pax = $row['Capacity'];
}

$regPax = 0;
$countPax = "SELECT * FROM event E, register R WHERE R.RegStatus = 'AC' AND E.EventID = R.EventID AND E.EventID = '$eID'";
$cpax = mysqli_query($dbConnection, $countPax);
while ($row = mysqli_fetch_array($cpax)) {
    $regPax++;
}

if ($regPax >= $pax) {
    echo "<script>alert('Sorry, this event has been fully register.')</script>";
    echo "<script>window.location.href='member_catalogue.php'</script>";
}
?>
<article class="text-center justify-content-center pt-5">

    <!-- seat -->
    <form action="member_payment.php" method="POST">

        <div class="over">
            <div class="hall">
                <!-- seat -->
                <?php
                if ($eType == "CC") {
                    $yseat = array('L', 'C', 'R');
                    $xseat = array('A', 'B', 'C', 'D', 'E');
                } else {
                    echo "Error! Please contact to the admin!";
                    exit();
                }
                echo "<div class='rowSeat'>";

                for ($y = 0; $y < count($yseat); $y++) {
                    echo "<div class='columnSeat'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<p class='text-white'>" . getYseat($yseat[$y]) . "</p>";

                    echo "</tr>";

                    $xs = 0;

                    for ($x = 0; $x < count($xseat); $x++) {
                        echo"<tr>";
                        $s = 1;
                        for ($i = 0; $i < 10; $i++) {
                            echo "<td>";
                            $seatX = sprintf("%02d", $s);
                            $seatNo = $yseat[$y] . $xseat[$xs] . $seatX;

                            $seatCNO = $seatNA = $seatColor = $seatNum = "";
                            $seatButton = "seatButton";

                            $checkSeat = "SELECT * FROM register WHERE EventID = '$eID' AND SeatNo = '$seatNo'";
                            $seatResult = mysqli_query($dbConnection, $checkSeat);
                            while ($sNo = mysqli_fetch_array($seatResult)) {
                                $seatCNO = $sNo['SeatNo'];
                            }

                            if ($seatCNO == $seatNo) {
                                $seatNA = "disabled = 'true'";
                                $seatColor = "style='background-color: red;border: none;color: white;padding: 10px 15px;text-align: center;text-decoration: none;display: inline-block;border-radius: 5px;'";
                                $seatButton = "";
                            } else {
                                $seatNum = "onclick='setSeatNo(this.value)'";
                            }

                            echo "<input type='radio' value='$seatNo' name='seatNo' id='$seatNo' $seatNA $seatNum/>";
                            echo "<label for='$seatNo' class='$seatButton' $seatColor>";
                            echo "<span class='material-symbols-outlined'>chair_alt</span>";
                            echo "</label>";
                            echo "$seatNo";
                            echo "</td>";
                            $s++;
                        }
                        $xs++;
                        echo "</tr>";
                    }

                    echo "</table>";
                    echo "</div>";
                }
                echo "</div>";

                function getYseat($yseat) {
                    switch ($yseat) {
                        case 'L':
                            echo "<p class = 'colseat'>LEFT</p>";
                            break;

                        case 'C':
                            echo "<p class = 'colseat'>CENTER</p>";
                            break;

                        case 'R':
                            echo "<p class = 'colseat'>RIGHT</p>";
                            break;

                        default:
                            echo "<p class = 'colseat'>There are something wrong!</p>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="dSeat">
            <input type="hidden" value="<?php echo $eID ?>" name="eid"/>
            <input type="hidden" value="<?php echo $regId ?>" name="rgid"/>
            <h3>Event  : <?php echo $eName; ?> </h3>
            <h3 id="seat">Seat No: </h3>
        </div>

        <table class="note pt-3">
            <tr>
                <th colspan="2" class="text-dark">Notes: </th>
            </tr>
            <tr>
                <td class="ava"><span class="material-symbols-outlined">chair_alt</span></td>
                <td>Available Seat</td>

            </tr>
            <tr>
                <td class="nonava"><span class="material-symbols-outlined">chair_alt</span></td>
                <td>Non-available Seat</td>
            </tr>
        </table>

        <div class="container pt-2 pb-2">
            <button type="submit" class="button confirm" name="btnConfirm"><span class="material-symbols-outlined">check</span> CONFIRM</button>
        </div>

    </form>

</article>