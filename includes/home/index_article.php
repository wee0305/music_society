<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Leong Kuan Fei
   Date: 27/7/2022
   
   Filename: index_article.php

-->

<article class="text-center justify-content-center pt-5">
    <!-- events & activities -->
    <div class="pb-5" style="margin-left: 5%; margin-right: 5%;">
        <div class="card-group pt-0">
            <h1 class="pb-0 text-white" style="text-shadow: 0 0 10px rgba(105, 200, 248, 0.8); width: 100%;">Events & Activities Highlights</h1>
            <?php
            //check the end date of the event
            $eTypeArr = array('CC', 'CP', 'WS');

            date_default_timezone_set('Asia/Kuala_Lumpur');
            $date = NEW DateTime('now');
            $cDate = $date->format('Y-m-d');
            for ($e = 0; $e < count($eTypeArr); $e++) {
                $eventCommand = "SELECT * FROM event WHERE Status = 'AL' AND StartDate >= '$cDate' HAVING EventID LIKE '$eTypeArr[$e]%' ORDER BY StartDate LIMIT 1;";
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

                    echo "<a class = 'card' href = 'index_login.php' style = 'margin: 0px 10px 10px 10px;'>";
                    echo "<img src = 'images/event_images/$eImg' class = 'card-img opacity-50' style = 'height: 500px;' alt = 'music society $eName'>";
                    echo "<div class = 'card-img-overlay'>";
                    echo "<h1 class = 'card-title text-dark position-absolute top-50 start-50 translate-middle'>";
                    echo "<b>$eName</b><br/>";
                    echo "<button type = 'button' onclick = \"location.href = 'index_login.php'\" class = 'card-text btn btn-warning'>Join Us</button></h1>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            ?>
        </div>
    </div>

    <!-- music philosophy -->
    <div class="accor" data-bs-spy="scroll" data-bs-target="#musicPhilosophy" data-bs-offset="0" tabindex="0">
        <div class="container pt-5"  id="musicPhilosophy">
            <h1 class="text-dark pt-5" style="text-shadow: 0 0 10px white;"><b>Our Music Philosophy</b></h1>
            <div class="accordion pt-5">

                <!-- first accordion -->
                <div class="accordion-item">
                    <div class="accordion-header" id="bandMusic">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#band" aria-expanded="false" aria-controls="band">
                            Band Music
                        </button>
                    </div>
                    <div id="band" class="accordion-collapse collapse" aria-labelledby="bandMusic" data-bs-parent="#musicPhilosophy">
                        <div class="accordion-body">
                            The overarching goal of our music education curriculum for bands is to assist each and every one of our students realise his or her own unique musical and intellectual potential. It is through both solo and ensemble performance that the student develops an appreciation for a variety of musical genres. Our band programme also hopes to engage as many kids as possible. The ultimate aim of the programme is to inspire students to continue their involvement with music, whether it is via formal study, informal participation, or pure enjoyment.
                        </div>
                    </div>
                </div>

                <!-- second accordion -->
                <div class="accordion-item">
                    <div class="accordion-header" id="guitar">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#Guitar" aria-expanded="false" aria-controls="Guitar">
                            Guitar
                        </button>
                    </div>
                    <div id="Guitar" class="accordion-collapse collapse" aria-labelledby="guitar" data-bs-parent="#musicPhilosophy">
                        <div class="accordion-body">
                            Enlightenment is not a matter of seeing something new. It is finally seeing what you have been looking at all the time………..Jamie Andreas. For the benefit of all of our students, we drill into their heads not just how but also what they should be paying attention to. Paying close attention while strumming a guitar is quite different than paying close attention while reading or watching TV. It's not hard to pay attention when watching a movie since the experience is so passive and just involves your mind and emotions.  
                        </div>
                    </div>
                </div>

                <!-- third accordion -->
                <div class="accordion-item">
                    <div class="accordion-header" id="piano">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#Piano" aria-expanded="false" aria-controls="Piano">
                            Piano
                        </button>
                    </div>
                    <div id="Piano" class="accordion-collapse collapse" aria-labelledby="piano" data-bs-parent="#musicPhilosophy">
                        <div class="accordion-body">
                            We believe that teaching someone to play the piano should be done primarily to inspire a lifelong appreciation of music. We believe that in order to foster and develop a genuine appreciation for music, any kind of music, not only piano, students must first develop into musicians in their own right.
                        </div>
                    </div>
                </div>

                <!-- fourth accordion -->
                <div class="accordion-item">
                    <div class="accordion-header" id="violin">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#Violin" aria-expanded="false" aria-controls="Violin">
                            Violin
                        </button>
                    </div>
                    <div id="Violin" class="accordion-collapse collapse" aria-labelledby="violin" data-bs-parent="#musicPhilosophy">
                        <div class="accordion-body">
                            Violin shouldn't give you distress, it should be fun! If it is not fun, then there is no point in doing it. The process of learning an instrument may be uncomfortable and downright distressing at times. Having a teacher who can put you at ease and encourages your growth as a learner is invaluable. We believe it's never too late to pick up the violin, no matter how old you are.
                        </div>
                    </div>
                </div>

                <!-- fifth accordion -->
                <div class="accordion-item">
                    <div class="accordion-header" id="composition">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#musicComposition" aria-expanded="false" aria-controls="musicComposition">
                            Music Composition
                        </button>
                    </div>
                    <div id="musicComposition" class="accordion-collapse collapse" aria-labelledby="composition" data-bs-parent="#musicPhilosophy">
                        <div class="accordion-body">
                            The two main components of music composition are technique and creativity. Today's methods of teaching composition in higher education often place a greater emphasis on imagination than on technique, which is typically left to courses in music theory. We think that rather than concentrating only on music theory, a musician can only aspire to be their best by expressing their own originality and musical taste. 
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</article>


