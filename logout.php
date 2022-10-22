<?php

session_start();

// Destroying All Sessions
if ($_SESSION['role'] == "jobseeker" || $_SESSION['role'] == "jobprovider") {
    if (session_destroy()) {
        // Redirecting To Home Page
        header("Location: index.php");
    }
}
