<?php
session_start();
if (isset($_GET['index']) && isset($_SESSION['student_data'][$_GET['index']])) {
    unset($_SESSION['student_data'][$_GET['index']]);
    // Re-index the array to avoid gaps in the array keys
    $_SESSION['student_data'] = array_values($_SESSION['student_data']);
}
header("Location: register.php");
exit;
?>
