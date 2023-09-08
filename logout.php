<?php
session_start(); // Start a new session or resume the existing session

// Destroy the session to log the user out
session_destroy();

header("Location: login.php"); // Redirect to the login page
exit();
?>
