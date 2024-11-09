<?php
session_start(); // Start the session

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the login page (index.php)
header("Location: index.php");
exit;
?>
