<?php

require 'connection.php';

session_start();

# security

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}

if ($_SESSION['role'] == 'jobseeker') {
    header("Location: JobSeekerHomePage.php");
} elseif ($_SESSION['role'] != 'jobprovider') {
    header("Location: index.php");
}

if (isset($_GET['insert'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];


    $query1 = "SELECT id FROM applicationstatus WHERE status = '$status' ";

    $result1 = mysqli_query($connect, $qurey1);

    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $idAPS = $row['id'];
        }
    }

    $qurey2 = "UPDATE jobapplication SET application_status_id = '$idAPS' WHERE id = '$Id'";

    $result2 = mysqli_query($connect, $qurey2);

    header("Refresh:0; url='JobProviderHomePage.php' ");
}
