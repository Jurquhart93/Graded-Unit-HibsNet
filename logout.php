<?php
// Inlcuding Session and DB Files Start
include_once(__DIR__ . '/includes.php');
// Inlcuding Session and DB Files End

// Clearing the Sessions Array of Variables/ Active Sessions
$_SESSION = array();

// Destroying the Session
session_destroy();

setStatus("Successfully Logged Out!");

// Redirecting to the Home Page
header("Location:" . $baseUrl . "/");

// Exeting the Script
exit();
