<!DOCTYPE html>

<?php

session_start();

//includes
include_once('connection.php');
include_once('functions.php');

$role = "jobseeker";


#security
if (isset($_SESSION['id'])) {
    if ($_SESSION['role'] == 'jobseeker')
        header('Location:JobSeekerHomePage.php');
    else if ($_SESSION['role'] == 'jobprovider')
        header('Location:JobProviderHomePage.php');
    else
        header('Location:index.php');
}

$sign_error_msg = "";

#sign in process
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit']))
        $sign_error_msg = signIn($connection, $role);
}
?>


<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>job seeker signup</title>
    <link rel="stylesheet" href="style.css">
    <script src="java.js" defer></script>
</head>
<body>


<div class=" fadeInDown " class="logo">
    <img class="logo" src="images/logo.PNG" alt="logo">
</div>

<div class="wrapper fadeInDown ">
    <div class="formContent">

        <h2 class="h2 active"> Job Seeker Sign Up </h2>
        <div><p style="color:#f36464"><?php echo $sign_error_msg; ?><p></div>


        <form action="" method="post">
            <input type="text" id="fn" class="fadeIn third" name='fn' placeholder="First Name" pattern="[A-Za-z]{3,30}"
                   title="name should be at least 3 letters" required>

            <input type="text" id="ln" class="fadeIn third" name="ln" placeholder="Last Name" pattern="[A-Za-z]{3,30}"
                   title="name should be at least 3 letters" required>

            <input type="password" id="password" class="fadeIn third" name="passsu" placeholder="password"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters"
                   required>

            <input type="email" id="em" class="fadeIn third" name="em" placeholder="E-mail" required>

            <input type="number" id="age" class="fadeIn third" name="age" placeholder="Age" required pattern="[0-9]{2}"
            >

            <input type="text" id="phone" class="fadeIn third" name="phone" placeholder="Phone Number"
                   pattern="[0]{1}[5]{1}[0-9]{8}"
                   title='phone number should start with 05 and contain 10 numbers in total as 05********' required>
            <br>
            <h4 class="fadeIn third lang">languages : </h4>
            <input type="checkbox" id="eng" class="fadeIn third" name="eng" value="English">
            <h4 class="fadeIn third">English</h4>
            <input type="checkbox" id="ar" class="fadeIn third" name="ar" value="Arabic">
            <h4 class="fadeIn third">Arabic</h4>
            <input type="checkbox" id="chn" class="fadeIn third" name="ch" value="Chinese">
            <h4 class="fadeIn third">Chinese</h4>


            <h4 class="fadeIn third lang">Qualification : </h4>
            <select class="fadeIn third" id="qual" name="qual" required>
                <option value="-1">Choose :</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Master">Master</option>
                <option value="PHD">PHD</option>

            </select>
            <br>
            <h4 class="fadeIn third lang">Work experince: </h4>


            <input type="text" id="wp" class="fadeIn third" name="wp" placeholder="Work place" pattern="[A-Za-z0-9]{3,}"
                   title="should be at least 3 letters" required>
            <br>
            <br>

            <lable class="fadeIn third">Start date :
                <input type="date" id="sd" class="fadeIn third" name="sd" required>
            </lable>
            <lable class="fadeIn third">End date :
                <input type="date" id="ed" class="fadeIn third" name="ed" required>
            </lable>
            <br>
            <br>
            <input type="submit" class="fadeIn fourth" name='submit' value="signup">


        </form>


    </div>
</div>
</body>
</html>

