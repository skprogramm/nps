<?php
session_start();

// Destroy all session data
session_destroy();

// Clear session cookies
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirect to login page
header('Location: login.php');
exit;
?>
