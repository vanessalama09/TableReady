<?php
    // this code stops the current session and redirects the user to the homepage
    include '../backend/dbConnection.php';
    session_start();
    session_destroy();
    session_abort();
    header("location: ../frontend/homepage.html");
    exit();
?>