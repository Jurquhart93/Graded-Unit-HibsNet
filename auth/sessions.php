<?php
// STARTING THE SESSION
session_start();

if (isset($_SESSION['user'])) {
    $memberId = $_SESSION['user'];
}

// Function to Set Status Message Start
function setStatus($message)
{
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['status'] = $message;
}
// Function to Set Status Message End
