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
<?php
require 'connection.php';
session_start();
$id = 1;

$sql1 = "SELECT * FROM jobprovider WHERE id=$id ";

$result1 = mysqli_query($connect, $sql1);

$error = mysqli_connect_error();

if ($error != null) {
    echo "<p> Could not connect to the database. $error</p>";
    exit();
}

$row1 = mysqli_fetch_assoc($result1);

$sql2 =//"SELECT * FROM jobapplication INNER JOIN joboffer ON jobapplication.job_offer_id = joboffer.id INNER JOIN jobprovider ON joboffer.job_provider_id = jobprovider.id INNER JOIN applicationstatus ON jobapplication.application_status_id = applicationstatus.id WHERE jobapplication.job_seeker_id=$id" ;
    //"SELECT * FROM jobapplication INNER JOIN joboffer ON jobapplication.job_offer_id = joboffer.id INNER JOIN jobprovider ON jobapplication.job_seeker_id = jobseeker.id INNER JOIN applicationstatus ON jobapplication.application_status_id = applicationstatus.id WHERE joboffer.job_provider_id=$id" ;
    "SELECT joboffer.title, jobseeker.first_name ,jobseeker.last_name,applicationstatus.status FROM jobseeker INNER JOIN jobapplication  ON jobapplication.job_seeker_id =jobseeker.id INNER JOIN joboffer ON jobapplication.job_offer_id=joboffer.id INNER JOIN applicationstatus ON jobapplication.application_status_id=applicationstatus.id  WHERE joboffer.job_provider_id=$id ";
$result2 = mysqli_query($connect, $sql2);

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>job seeker login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="fadeInDown class="logo">
        <img class="logo" src="images/logo.PNG" alt="logo">
    </div>
    <br/>
    <h1 class="child fadeIn first" id="welcom">welcome,<?php echo $row1['name'] ?> </h1>
    <h2 class="fadeIn first" style="text-align: right" id="logOut"><a href="index.php">Log-out</a></h2>
    <br/>

    <br/>
    <table class="fadeIn fourth">
        <tr class="UDStat">
            <th style="background-color: rgb(33, 111, 152);
            height: 60px;">name
            </th>
            <th style="background-color: rgb(33, 111, 152);
            height: 60px;">main location
            </th>
            <th style="background-color: rgb(33, 111, 152);
            height: 60px;">phone number
            </th>
            <th style="background-color: rgb(33, 111, 152);
            height: 60px;">email address
            </th>

        </tr>

        <tr class="UDStat">

            <td class="black" style="height: 60px;"><?php echo $row1["name"]; ?></td>
            <td class="black" style="height: 60px;"><?php echo $row1["main_location"]; ?></td>
            <td class="black" style="height: 60px;"><?php echo $row1["phone_number"]; ?></td>
            <td class="black" style="height: 60px;"><?php echo $row1["email_address"]; ?></td>

        </tr>
    </table>

    <h2 class="fadeIn third marg">Received Applications</h2>
    <table class="fadeIn fourth">
        <tr class="UDStat">
            <th>Job Title</th>
            <th>Applicants</th>
            <th>Status</th>
            <th>Update Status</th>
        </tr>
        <tr class="UDStat">

            <?php
            //if(($row2=mysqli_fetch_assoc($result2) >0){
            while ($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                <td><a href="jobOfferDetails.php"> <?php echo $row2["title"]; ?></a></td>

                <td><a href="seekinfo.php"><?php echo $row2["first_name"] . " " . $row2["last_name"]; ?></a></td>

                <td <?php /* header("refresh: 3; url =http://localhost/test1m/JobProviderHomePage.php");*/ ?>> <?php echo $row2["status"]; ?></td>
                <select class="fadeIn third" id="status" name="status">

                    <option value="-1">Choose :</option>
                    <option value="acc">accepted</option>
                    <option value="rej">rejected</option>
                    <option value="underc">under consideration</option>
                    <option value="req">request for interview</option>

                    <option value="<?php //php// echo $row3['id'];
                    ?>"><?php //echo $row3['status'];
                        ?></option>

                </select>

                <button class="buttonS" name="insert">Update Status</button>
            <?php } ?>
            <td>
                <div>

                    <?php
                    //$result3 ="SELECT * FROM applicationstatus WHERE id=$id";
                    //while($row3= mysqli_fetch_array($result3)){
?>
                    <?php

                    //if(($row2=mysqli_fetch_assoc($result2) >0){
                    //while($row2=mysqli_fetch_assoc($result2)){
?>

                    <?php //}?>
                </div>
            </td>
        </tr>
    </table>
    <br/>

    <h2 id="oferdjob" class="child fadeIn third marg">Offered Jobs </h2>

    <h4 style="text-decoration:underline" id="Addjob" class="child fadeIn third"><a href="addjobform.php">Add new Job
            Offer</a></h4>

    <table class="fadeIn fourth">
        <tr>
            <th id="jt">
                Job Title
            </th>

        </tr>
        <tr>
            <?php
            // if(isset($_POST['edit'])){
            //  $row['title']=$_POST['title'];
            //}
            $sql5 = "SELECT id,title FROM joboffer WHERE job_provider_id='$id' ";
$result5 = mysqli_query($connect, $sql5);

while ($row5 = mysqli_fetch_assoc($result5)) {
    ?>

                <td><a href="jobOfferDetails.php"><?php echo $row5['title']; ?></a></td>

                <form action="jobedit.php" method="GET">
                    <input type="hidden" name="id" value="<?php echo $row5['id'] ?>">
                    <td class="tdEdit">
                        <button class="buttonS" onclick="go44();" name="" herf="jobedite.php?id=<?php $row5['id'] ?>">
                            edit
                        </button>
                    </td>
                </form>

                <form action="delete.php" method="GET">
                    <input type="hidden" name="id" value="<?php echo $row5['id'] ?>">
                    <td>
                        <button class="buttonSD" name="id" value="<?php echo $row5['id'] ?>">delete</button>
                    </td>
                </form>
                <?php /*S
    //DELETE FROM table_name WHERE some_column=some_value;
    if($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['DeleteButton']))
        {
            $toDelet = $_GET['DeleteButton'];
            Deletefunc($toDelet);
        }
        function Deletefunc($toDelet)
        {
            global $connect;
            $qurey = "DELETE FROM joboffer WHERE id =$toDelet" ;
            $result = mysqli_query($connect, $qurey) ;
        }*/
    ?>

            <?php } ?>
        </tr>
    </table>
</body>
</html>
