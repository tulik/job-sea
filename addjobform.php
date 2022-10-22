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
        <title>add job form</title>
        <link rel="stylesheet" href="style.css">
        <script src="java.js" defer></script>
    </head>
    <body>
    <div class=" fadeInDown logo">
        <img class="logo" src="images/logo.png" alt="logo">
    </div>
    <div class="wrapper fadeInDown ">
        <div class="formContent">
            <!-- Tabs Titles -->
            <h2 class="h2 active"> job offer Details </h2>

            <!-- Login Form -->
            <form action="JobProviderHomePage.php" type="Post">
                <input type="text" id="title" class="fadeIn third" name="title" placeholder="Title">
                <input type="text" id="salary" class="fadeIn third" name="salary" placeholder="Salary">
                <input type="text" id="location" class="fadeIn third" name="location" placeholder="location">

                <h4 class="fadeIn third lang">Category : </h4>
                <select class="fadeIn third" id="cat" name="qual">
                    <option value="-1">Choose :</option>
                    <option value="CS">CS</option>
                    <option value="HR">HR</option>
                    <option value="Fin">Finance</option>
                </select>

                <br/>

                <h4 class="fadeIn third lang">Work Time : </h4>
                <select class="fadeIn third" id="fullorpart" name="qual">
                    <option value="-1">Choose :</option>
                    <option value="FT">Full-Time</option>
                    <option value="PT">Part-Time</option>
                </select>
                <br/>
                <h4 class="fadeIn third lang">Description : </h4>
                <textarea class="fadeIn third" name="desc" rows="7" cols="40" placeholder="This job is XXXXXXX"></textarea>
                <h4 class="fadeIn third lang">requirements : </h4>
                <br/>
                <input type="checkbox" id="crtic" class="fadeIn third" name="critic">
                <h4 class="fadeIn third">critical thinking</h4>
                <input type="checkbox" id="lead" class="fadeIn third" name="lead">
                <h4 class="fadeIn third">leadership</h4>
                <input type="checkbox" id="creativity" class="fadeIn third" name="creativity">
                <h4 class="fadeIn third">creativity</h4>

                <br/>

                <input type="submit" class="fadeIn fourth" value="submit">
            </form>
        </div>
    </div>
</body>
</html>