<?php

include_once 'connection.php';

session_start();


$ID = $_SESSION["id"];


echo $_GET['title'];
if (isset($_GET['title'])) {
    $job_title = $_GET['title'];
}


$sqlT = "SELECT * FROM joboffer WHERE title = '$job_title'";
$job_offer = mysqli_query($connection, $sqlT);
while ($row = mysqli_fetch_assoc($job_offer)) {
    $jobid = $row['id'];
}


$qurey = "Select * from jobapplication";
$resultID = mysqli_query($connection, $qurey);
$id = mysqli_num_rows($resultID);
$id++;

$qurey1 = "INSERT INTO jobapplication ( id ,job_offer_id ,job_seeker_id ,application_status_id) VALUES ( '$id' , '$jobid', '$ID' , '1') ";
$result1 = mysqli_query($connection, $qurey1);


header("Location:JobSeekerHomePage.php");
