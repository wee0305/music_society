<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Wong Jia He
   Date: 10/08/2022
   
   Filename: member_faqs_content.php

-->

<!--FAQ-->
<div class="backgroundfaq">
    <div class="container-faq">
        <h2>Frequently Asked Questions (FAQs)</h2>
        <!-- FAQ no.1 -->
        <div class="accordion">
            <div class="icon"></div>
            <img src="./images/arrow-down.png">
            <h3>How to register event or activity?</h3>
        </div>
        <div class="panel">
            <p>If you want to register for an event, 
                you can click on the "Events & Activities" displayed from the navigation bar above 
                to view the events currently open for registration. 
                There is a register button on the far right of each displayed event. 
                Click to register for the event.</p>
        </div>
        <!-- FAQ no.2 -->
        <div class="accordion">
            <div class="icon"></div>
            <img src="./images/arrow-down.png">
            <h3>How to cancel the registered events?</h3>
        </div>
        <div class="panel">
            <p>If you want to cancel the registered events, you can click "My Enrollment" 
                displayed from the upper navigation bar to view the currently registered events. 
                There is a cancel button on the far right of each displayed event. 
                Click to cancel the registered event.</p>
        </div>
        <!-- FAQ no.3 -->
        <div class="accordion">
            <div class="icon"></div>
            <img src="./images/arrow-down.png">
            <h3>What payment method can I use for register event?</h3>
        </div>
        <div class="panel">
            <p>We accept online payment method by Visa/Master Debit Card or Credit Card only.</p>
        </div>
        <!-- FAQ no.4 -->
        <div class="accordion">
            <div class="icon"></div>
            <img src="./images/arrow-down.png">
            <h3>How do I get my money back from my previous registration if I don't want to attend the event?</h3>
        </div>
        <div class="panel">
            <p>You will need to cancel your event registration through "My Enrollment", 
                then please send an email attached with the cancellation screen's photo/screenshot to mstaruc@tarc.edu.my for further assistance. 
                The refund may take up to 3 - 5 working days for processing and it depends on the vary of the bank procedures.</p>
        </div>
        <!-- FAQ no.5 -->
        <div class="accordion">
            <div class="icon"></div>
            <img src="./images/arrow-down.png">
            <h3>Where to find the upcoming event details?</h3>
        </div>
        <div class="panel">
            <p>You can click "Events & Activities" from the upper navigation bar to view upcoming events details.</p>
        </div>
    </div>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            })
        }
    </script>
</div>


