<?php
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
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>Seeker Information</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="jobProviderStyle.css">
    <script src="java.js" defer></script>
</head>
<body>
<div class=" fadeInDown logo">
    <img class="logo" src="images/logo.PNG" alt="logo">
</div>

<h2 style="color:aliceblue; " class="fadeIn first marg">Seeker Information : </h2>

<div class="Info">

    <table class="fadeIn second">
        <tr id="frH">
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th colspan="2">Phone Number</th>
        </tr>
        <tr id="infofrH">
            <td>Sara</td>
            <td>Ahmad</td>
            <td>23</td>
            <td colspan="2">99654228973</td>
        </tr>

        <tr id="srH">
            <th colspan="3">Qualifications</th>
            <th colspan="2">Languages</th>
        </tr>
        <tr id="infosrH">
            <td colspan="3">Master</td>
            <td colspan="2">English</td>
        </tr>

        <tr id="thrH">
            <th colspan="2">Email Address</th>
            <th colspan="3">Work Experience</th>
        </tr>
        <tr id="infothrH">
            <td colspan="2">sara123@gmail.com</td>
            <td colspan="3">samba bank 2018-2019</td>
        </tr>
    </table>
</div>

</body>
</html>