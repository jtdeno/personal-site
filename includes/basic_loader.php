<?php
chdir($_SERVER['DOCUMENT_ROOT']);
error_reporting(E_ALL);
session_start();
include('constants.php');

ini_set('display_errors', DISPLAY_ERRORS);
ini_set('error_log', ERROR_LOG_PATH);

include(INCLUDE_DIR . 'db_constants.php');
include(INCLUDE_DIR . 'basic_helper.php');

$user = new User();

if ($user->isLoggedIn()) {
    $user->createFromSession();
}