<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

<!--
   Web System
    
   Music Society
   Author:Leong Kuan Fei
   Date: 27/7/2022
   
   Filename: login_form.php

-->

<article class="text-center justify-content-center pt-5">
    
    <h1 class="pb-2">LOGIN</h1>
    <!-- login -->
    <div class="container">
        <form class="pb-5" method="post" action="index_login.php">  
            <div class="input-group input-group-lg">
                <span class="material-symbols-outlined input-group-text" id="inputGroup-sizing-default">Person</span>
                <input class="form-control" type="text" name="msId" value="<?php echo $msId ?>" placeholder="id">
            </div>
            <?php
            if (isset($errMsgID)) {
                echo "<div class='error'>" . $errMsgID . "</div>";
            }
            ?>
            <br/>
            <div class="input-group input-group-lg">
                <span class="material-symbols-outlined input-group-text" id="inputGroup-sizing-default">password</span>
                <input class="form-control" type="password" name="psw" placeholder="Password">
            </div>
            <?php
            if (isset($errMsgID)) {
                echo "<div class='error'>" . $errMsgPsw . "</div>";
            }
            ?>
            <br/>
            <p class="fs-4"><a href="index_member.php" class="text-decoration-none link-primary">Sign Up</a> as a member!</p>
            <br/>
            <button class="btn btn-primary login" type="submit" name="login"><span class="material-symbols-outlined">login</span>Login</button>
            <button class="btn btn-danger" type="reset" name="cancel" onclick="location.href = 'index.php'"><span class="material-symbols-outlined">cancel</span>Cancel</button>
        </form>
    </div>
</article>


