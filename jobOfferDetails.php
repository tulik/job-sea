<?php
session_start();

# security
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}

if ($_SESSION['role'] != 'jobprovider' && $_SESSION['role'] != 'jobseeker') {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <title>Job Offer Details</title>
        <link rel="stylesheet" href="style.css">
        <script src="java.js" defer></script>
    </head>
    <body>
        <div class=" fadeInDown logo">

            <img class="fadeInDown logo" src="images/logo.png" alt="logo" style="float:left;">
            <h2 style="float: right;"><a class="fadeIn first" href="logout.php">Log-out</a></h2>

        </div>

        <div class="JoD">
            <?php
            include_once 'connection.php';

            $title = $_GET['title'];
            $sql = "SELECT * FROM joboffer WHERE title = '$title'";
            $result1 = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result1) > 0)
                $row = mysqli_fetch_assoc($result1);

            $cid = $row['job_category_id'];
            $sql2 = "SELECT * FROM jobcategory WHERE id = '$cid' ";
            $result2 = mysqli_query($connection, $sql2);

            if (mysqli_num_rows($result2) > 0)
                $c = mysqli_fetch_assoc($result2);
            $category = $c['category'];
            ?>

            <div>
                <br/>
                <h2 class="fadeIn second"><?php echo $row['title']; ?></h2>

                <div class="fadeIn third offerbuttons" style=" color: aliceblue;">
                    <button type="button" style="text-decoration:underline" class="buttonS" onclick="go55();">Apply</button>
                    <button type="button" style="text-decoration:underline" class="buttonS" onclick="go44();"> Edit</button>
                </div>

            </div>
            <br/>
            <div>
                <h2 class="fadeIn third">job information</h2>
                <table class="fadeIn fourth">
                    <tr class="UDStat">
                        <th style="background-color: rgb(33, 111, 152);
                    height: 60px;">category
                        </th>
                        <th style="background-color: rgb(33, 111, 152);
                    height: 60px;">title
                        </th>
                        <th style="background-color: rgb(33, 111, 152);
                    height: 60px;">full time/part time
                        </th>
                        <th style="background-color: rgb(33, 111, 152);
                    height: 60px;">salary
                        </th>
                        <th style="background-color: rgb(33, 111, 152);
                    height: 60px;">location
                        </th>
                        <th style="background-color: rgb(33, 111, 152);
                    height: 60px;">description
                        </th>
                        <th style="background-color: rgb(33, 111, 152);
                    height: 60px;">requirements
                        </th>
                    </tr>
                    <tr class="UDStat">
                        <td class="black" style="height: 60px;"><?php echo $category; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $row['title']; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $row['full_time']; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $row['salary']; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $row['location']; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $row['description']; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $row['requirements']; ?></td>
                    </tr>
                </table>
                <?php
                $pid = $row['job_provider_id'];
                $sql3 = "SELECT * FROM jobprovider WHERE id = '$pid' ";
                $result3 = mysqli_query($connection, $sql3);

                if (mysqli_num_rows($result3) > 0)
                    $p = mysqli_fetch_assoc($result3);
                ?>

                <br/>
                <h2 class="fadeIn third">job provider information</h2>
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
                        <td class="black" style="height: 60px;"><?php echo $p['name']; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $p['main_location']; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $p['phone_number']; ?></td>
                        <td class="black" style="height: 60px;"><?php echo $p['email_address']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>