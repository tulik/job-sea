<!DOCTYPE html>
<?php
#task 5
session_start();

//includes
include_once('connection.php');
include_once('functions.php');

$role = "jobprovider";


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
    if (isset($_POST['loginprov']) && $_POST['loginprov'] == 'LogIn')
        $msg = login($connection, $role);
}
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>job provider login</title>
    <link rel="stylesheet" href="style.css">
    <script src="java.js" defer></script>
</head>
<body>
<div class=" fadeInDown " class="logo">
    <img class="logo" src="images/logo.PNG" alt="logo">
</div>
<div class="wrapper fadeInDown jol">
    <div class="formContent">
        <!-- Tabs Titles -->

        <h2 class="h2 active"> Job Provider Log In </h2>
        <div><p style="color:#f36464"><?php echo $msg; ?><p></div>

        <!-- Login Form -->
        <form action="" method="post">
            <input type="text" id="usernameprov" class="fadeIn second" name="username" placeholder="username" required>
            <input type="text" id="passwordprov" class="fadeIn third" name="password" placeholder="password" required>
            <input type="submit" name="loginprov" class="fadeIn fourth" value="LogIn">
        </form>


    </div>
</div>


</body>
</html>
     
   