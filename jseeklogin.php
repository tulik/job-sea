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

#log in
$msg = "";
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit']) && $_POST['submit'] == 'LogIn')
        $msg = login($connection, $role);
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>job seeker login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="fadeInDown logo">
        <a href='index.php'><img class="logo" src="images/logo.png" alt="logo"></a>
    </div>

    <div class="wrapper fadeInDown jol">
        <div class="formContent">
            <!-- Tabs Titles -->
            <h2 class="h2 active"> Job Seeker Log In </h2>
            <div><p style="color:#f36464"><?php echo $msg;
                ?><p></div>

            <!-- Login Form -->
            <form action="" method="post">
                <input type="text" id="email" class="fadeIn second" name="em" placeholder="E-mail" required>
                <input type="text" id="password" class="fadeIn third" name="ps" placeholder="password" required>
                <input type="submit" name='submit' class="fadeIn fourth" value="LogIn">
            </form>

        </div>
    </div>
</body>
</html>