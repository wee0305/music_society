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
//   Filename: logout.php
//

//session start
include './session.php';
if (!isset($_SESSION['msId'])) {
        echo "<h1>Warning</h1>";
        echo "<h2>No permission allowed to access this page</h2>";
	exit(); // Quit the script.

} else { // Cancel the session.

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.
        echo "<script type='text/javascript'>window.location.href='../index.php'; </script>";
}