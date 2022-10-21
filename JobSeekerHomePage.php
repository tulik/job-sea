<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}


if ($_SESSION['role'] == 'jobprovider') {
    header("Location: JobProviderHomePage.php");
} else if ($_SESSION['role'] != 'jobseeker')
    header("Location: index.php");


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="jobProviderStyle.css">
    <script src="java.js" defer></script>
</head>

<body>
<div class=" fadeInDown " class="logo">
    <img class="logo" src="images/logo.PNG" alt="logo">
</div>

<?php


$host = "localhost";
$database = "jobseadb";
$user = "root";
$pass = "";

$connection = mysqli_connect($host, $user, $pass, $database);

$error = mysqli_connect_error();

if ($error != null) {

    $output = "<p>Unable to connect </p>" . $error;

    exit($output);
}

//a

if (!isset($_SESSION["id"])) {

    $id = 1111;
} else {

    $id = $_SESSION["id"];
}

$sql = "SELECT * FROM jobseeker WHERE id='$id'";
$result = mysqli_query($connection, $sql);

//retrieve jobSeeker name

$sqlN = "SELECT * FROM jobseeker WHERE jobseeker.id = '$id'";
$result1 = mysqli_query($connection, $sqlN);
$n = mysqli_fetch_assoc($result1);


?>

<h2 style="text-align: right" id="logOut"><a href="logout.php">Log-out</a></h2>
<h1 class="child fadein first"> welcome <?php echo $n['first_name'];
    ?></h1>

<br/>
<div class="Info">
    <h2>Information</h2>
    <table>
        <tr id="frH">
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th colspan="2">Phone Number</th>
        </tr>

        <tr id="infofrH">
            <?php

            while ($row = mysqli_fetch_assoc($result))
            {

            ?>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td colspan="2"><?php echo $row['phone_number']; ?></td>


        </tr>

        <?php
        }

        ?>


        <tr id="srH">
            <th colspan="3">Qualifications</th>
            <th colspan="2">Languages</th>
        </tr>

        <tr id="infosrH">
            <?php

            $result3 = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($result3))
            {

            ?>
            <td colspan="3"><?php echo $row['qualifications']; ?></td>
            <td colspan="2"><?php echo $row['languages']; ?></td>


        </tr>

    <?php
    }

    ?>


        <tr id="thrH">
            <th colspan="2">Email Address</th>
            <th colspan="3">Work Experience</th>
        </tr>

        <tr id="infothrH">
            <?php

            $result2 = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($result2))
            {

            ?>
            <td colspan="2"><?php echo $row['email_address']; ?></td>
            <td colspan="3"><?php echo $row['work_experience']; ?></td>

        </tr>

    <?php
    }

    ?>

    </table>
</div>

<br>


<?php
//b
$sql2 = "SELECT * FROM jobapplication INNER JOIN joboffer ON jobapplication.job_offer_id = joboffer.id INNER JOIN jobprovider ON joboffer.job_provider_id = jobprovider.id INNER JOIN applicationstatus ON jobapplication.application_status_id = applicationstatus.id WHERE jobapplication.job_seeker_id='$id'";

$result4 = mysqli_query($connection, $sql2);

?>

<div class="JApp">
    <h2>Jop Applications</h2>
    <table>
        <tr id="JAppH">
            <th colspan="2">Job Title</th>
            <th colspan="2">Job Provider</th>
            <th colspan="2">Status</th>
            <!--“under consideration”, “request for interview”, “declined”, or “accepted”.-->
        </tr>

        <tr id="infothrH">
            <?php

            while ($row = mysqli_fetch_assoc($result4))
            {

            ?>
            <td colspan="2"><a href="jobOfferDetails.php"><?php echo $row['title']; ?> </a></td>
            <td colspan="2"><?php echo $row['name']; ?></td>
            <td colspan="2"><?php echo $row['status']; ?></td>

        </tr>

        <?php
        }

        ?>


    </table>
</div>


<br>

<?php
//c


//d
$sqlD = "SELECT * FROM jobcategory";  //make sure for all queries
$resultD = mysqli_query($connection, $sqlD);
?>

<div class="AJOff">
    <h2>Available Jop Offers</h2>
    <form action="" method="POST" style="float: right;">
        <label style="color:white; font-size:19px;" for="lang">Jobs Category : </label>
        <select name="JobsCategory" id="lang">
            <option name='Cat' value="-1"> choose :</option>
            <?php
            while ($row = mysqli_fetch_array($resultD)) {
                ?>
                <option name='Cat'
                        value="<?php echo $row['id']; ?>"> <?php echo $row['category']; ?> </option>  <!-- here -->

                <?php
            }
            ?>
        </select>

    </form>

    <table>
        <tr id="AJOffH">
            <th>Job Category</th>
            <th>Job Title</th>
            <th>Job Provider</th>
            <th>Salary</th>
        </tr>

        <tr>
            <?php

            $sql3 = "SELECT * FROM joboffer INNER JOIN jobcategory ON joboffer.job_category_id = jobcategory.id INNER JOIN jobprovider ON joboffer.job_provider_id = jobprovider.id INNER JOIN jobapplication ON jobapplication.job_seeker_id='$id' WHERE joboffer.id NOT IN (SELECT job_offer_id FROM jobapplication)  ";


            if (isset($_GET['JobsCategory']) && $_GET['JobsCategory'] != "-1") {
                $cat = $_GET['JobsCategory'];

            }
            $result6 = mysqli_query($connection, $sql3);
            while ($row = mysqli_fetch_assoc($result6))
            {
            //  $title = $row['title'];
            print_r($row);
            ?>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['salary']; ?></td>
            <form action='jobseekerApplyButton.php' method='GET'>
                <td><a href=" jobOfferDetails.php?title=<?php echo $row['title']; ?>"> Details </a></td>
                <td name="" value=""><a href="jobseekerApplyButton.php?title=<?php echo $row['title']; ?>">
                        Apply </a></button>  </td>  <!-- here -->
            </form>
        </tr>

        <?php
        }

        ?>

        <?php
        //c
        /*
        if(isset($GET["apply"]))
        {

            $sqlIns = "INSERT INTO jobapplication(job_offer_id , job_seeker_id , application_status_id)VALUES( ,$id ,'under condideration')";
            if(mysqli_query($connection, $sqlIns))
            {
                //new record created successfully
            }
            else{

                echo "Error: " . $sqlIns . "<br>" . mysqli_error($connection);

            }
        }
        */
        mysqli_close($connection);
        ?>

    </table>
</div>
</body>
</html>
