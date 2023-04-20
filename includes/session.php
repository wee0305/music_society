<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//
//   Web System
//    
//   Music Society
//   Author:Leong Kuan Fei
//   Date: 26/8/2022
//   
//   Filename: session.php
//

//session start
session_start();
if(!isset($_SESSION['msId'])){
    echo "<h1>Warning!!</h1>";
    echo "<h2>No permission allowed to access this page!</h2>";
    echo "<a href='index.php'>home</a>";
    exit();
}
