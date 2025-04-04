<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/auth/sessions.php');
require_once(__DIR__ . '/database/conn.php');
require_once(__DIR__ . '/database/queries.php');
require_once(__DIR__ . '/components/functions.php');
require_once(__DIR__ . '/partials/status.php');

// Declaring Variables Start
$formErrors = array();
$oldFormData = $_POST;
// Declaring Variables End
