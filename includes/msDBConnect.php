<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

/*
  Web System

  Music Society
  Author:Leong Kuan Fei
  Date: 21/8/2022

  Filename: msDBConnect.php

 */

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "music_society");

$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}
