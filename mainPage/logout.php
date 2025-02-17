<?php
// Start the session
session_start();

session_destroy();
session_unset();

// Redirect to another page (e.g., home page)
header("Location: ../auth-login.php"); // Change index.php to the desired page
exit();
