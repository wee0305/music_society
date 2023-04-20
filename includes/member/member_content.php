<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Chang Ching We
   Date: 09/08/2022
   
   Filename: member_content.php

-->

<article>
    <div class="content ">
        <div class="content_container">
            <h4>Member Quick Access</h4>
            <!-- Flip Card - Access -->
            <div class="flex-container">
                <!--Flip Card - Access -->
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="images/wave_1.png"  alt="Hold to Flip">
                        </div>
                        <div class="flip-card-back access">
                            <table>
                                <th colspan="3">
                                    <h1>View<br/>Details</h1> 
                                    <img src="images/view_detail.png"  class="smilling-face" alt="Smiling Face">
                                </th>                            
                            </table>
                            <button class="button-access" type="button" onclick="location.href = 'member_enrollment_list.php'" title="Click here to access">Click Here</button>
                        </div>   
                    </div>
                </div>

                <!--Flip Card - Access -->
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="images/wave_2.png"  alt="Hold to Flip">
                        </div>
                        <div class="flip-card-back access">
                            <table>
                                <th colspan="3">
                                    <h1>Register<br/>Event/Activities</h1> 
                                    <img src="images/reg_event.png"  class="smilling-face" alt="Smiling Face">
                                </th>                            
                            </table>
                            <button class="button-access" type="button" onclick="location.href = 'member_catalogue.php'" title="Click here to access">Click Here</button>
                        </div>   
                    </div>
                </div>

                <!--Flip Card - Access -->
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="images/wave_3.png"  alt="Hold to Flip">
                        </div>
                        <div class="flip-card-back access">
                            <table>
                                <th colspan="3">
                                    <h1>Cancel<br/>Registration</h1> 
                                    <img src="images/cancel_reg.png"  class="smilling-face" alt="Smiling Face">
                                </th>                            
                            </table>
                            <button class="button-access" type="button" onclick="location.href = 'member_enrollment_list.php'" title="Click here to access">Click Here</button>
                        </div>   
                    </div>
                </div>

                <!--Flip Card - Access -->
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="images/wave_4.png"  alt="Hold to Flip">
                        </div>
                        <div class="flip-card-back access">
                            <table>
                                <th colspan="3">
                                    <h1>Manage<br/>Profile</h1> 
                                    <img src="images/manage_prof.png"  class="smilling-face" alt="Smiling Face">
                                </th>                            
                            </table>
                            <button class="button-access" type="button" onclick="location = 'member_profile.php'" title="Click here to access">Click Here</button>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
