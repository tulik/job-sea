<!DOCTYPE html>
﻿<?php

session_start();

# security

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}


if ($_SESSION['role'] == 'jobseeker') {
    header("Location: JobSeekerHomePage.php");
} else if ($_SESSION['role'] != 'jobprovider')
    header("Location: index.php");


?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>Edit job Offer</title>
    <link rel="stylesheet" href="style.css">
    <script src="java.js" defer></script>
</head>
<body>
<?php

require 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET["id"])) {


    $toEdit = $_GET['EditButton'];
    $qurey = "SELECT * FROM joboffer WHERE id = '$toEdit' ";
    $result = mysqli_query($connect, $qurey);

    while ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row['job_category_id'];
    }


    $qurey1 = "SELECT * FROM jobcategory WHERE id = '$category_id' ";
    $result1 = mysqli_query($connect, $qurey1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $category = $row['category'];
        }
    } else {
        echo '<script> alert("no record found"); </script>';

    }
}
?>
<div class=" fadeInDown logo">
    <img class="logo" src="images/logo.PNG" alt="logo">
</div>

<div class="wrapper fadeInDown ">
    <div class="formContent">
        <!-- Tabs Titles -->
        <h2 class="h2 active"> job offer Details </h2>


        <!-- Login Form -->
        <?php
        $toEdit = $_GET['EditButton'];
        $qurey = "SELECT * FROM joboffer WHERE id = '$toEdit' ";
        $result = mysqli_query($connect, $qurey);
        while ($row = mysqli_fetch_assoc($result)){ ?>
        <form action="JobProviderHomePage.php" type="GET">
            <input type="hidden" value="<?php echo $IDOFFER; ?>">
            <input type="text" id="title" class="fadeIn third" name="title" placeholder="Title"
                   value="<?php echo $row['title']; ?>">

            <input type="text" id="salary" class="fadeIn third" name="salary" placeholder="Salary"
                   value="<?php echo $row['salary'] ?>">

            <input type="text" id="location" class="fadeIn third" name="location" placeholder="location"
                   value="<?php echo $row['location']; ?>">
            <?php } ?>

            <h4 class="fadeIn third lang">Category : </h4>
            <select class="fadeIn third" id="cat" name="qual">
                <option value="CS">CS</option>
                <option value="-1">Choose :</option>
                <option value="HR">HR</option>
                <option value="Fin">Finance</option>


            </select>
            <br/>

            <h4 class="fadeIn third lang">Work Time : </h4>
            <select class="fadeIn third" id="fullorpart" name="qual">
                <option value="FT">Full-Time</option>
                <option value="-1">Choose :</option>
                <option value="PT">Part-Time</option>

            </select>


            <br/>
            <h4 class="fadeIn third lang">Description : </h4>
            <textarea class="fadeIn third" name="desc" rows="7" cols="40" placeholder="This job is XXXXXXX"></textarea>
            <h4 class="fadeIn third lang">requirements : </h4>
            <br/>
            <input type="checkbox" id="crtic" class="fadeIn third" name="critic" checked>
            <h4 class="fadeIn third">critical thinking</h4>
            <input type="checkbox" id="lead" class="fadeIn third" name="lead">
            <h4 class="fadeIn third">leadership</h4>
            <input type="checkbox" id="creativity" class="fadeIn third" name="creativity">
            <h4 class="fadeIn third">creativity</h4>


            <br/>
            <input type="submit" class="fadeIn fourth" value="save" name="update">


        </form>


    </div>
</div>
</body>
</html>