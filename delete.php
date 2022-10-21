<?php
require 'connection.php';


session_start();

# security

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}


if ($_SESSION['role'] == 'jobseeker') {
    header("Location: JobSeekerHomePage.php");
} else if ($_SESSION['role'] != 'jobprovider')
    header("Location: index.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    Deletefunc($id);
}
function Deletefunc($id)
{
    global $connect;
    $qurey = "DELETE FROM joboffer WHERE id =$id";
    $result = mysqli_query($connect, $qurey);
    header("Refresh:0; url='JobProviderHomePage.php'");
}

?>