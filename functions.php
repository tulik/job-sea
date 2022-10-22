<?php

include_once 'connection.php';

function signIn($connection, $role)
{
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['fn']) && isset($_POST['ln']) && isset($_POST['passsu']) && isset($_POST['em'])
            && isset($_POST['age']) && isset($_POST['phone']) && isset($_POST['qual'])
            && isset($_POST['wp']) && isset($_POST['sd']) && isset($_POST['ed'])) {
            $email = mysqli_real_escape_string($connection, $_POST['em']);
            $select = mysqli_query($connection, "SELECT * FROM jobseeker WHERE email_address = '$email'");

            #already signed?

            if (mysqli_num_rows($select)) {
                return "email is already signed up! try to log in or try diffrent email!";
            } else {
                // email does not exist

                //initialization
                $firstname = mysqli_real_escape_string($connection, $_POST['fn']);
                $lastname = mysqli_real_escape_string($connection, $_POST['ln']);
                $password = mysqli_real_escape_string($connection, $_POST['passsu']);
                $age = mysqli_real_escape_string($connection, $_POST['age']);
                $phone = mysqli_real_escape_string($connection, $_POST['phone']);
                $qual = mysqli_real_escape_string($connection, $_POST['qual']);
                $workp = mysqli_real_escape_string($connection, $_POST['wp']);
                $sd = mysqli_real_escape_string($connection, $_POST['sd']);
                $ed = mysqli_real_escape_string($connection, $_POST['ed']);

                $allwork = $workp . " , From:  " . $sd . " To: " . $ed;


                $lang = "";

                if ((isset($_POST['eng'])) || (isset($_POST['ar'])) || (isset($_POST['ch']))) {
                    $eng = mysqli_real_escape_string($connection, $_POST['eng']);
                    $ar = mysqli_real_escape_string($connection, $_POST['ar']);
                    $ch = mysqli_real_escape_string($connection, $_POST['ch']);

                    if (isset($_POST['eng'])) {
                        $lang .= mysqli_real_escape_string($connection, $_POST['eng']) . " ";
                    }
                    if (isset($_POST['ar'])) {
                        $lang .= mysqli_real_escape_string($connection, $_POST['ar']) . " ";
                    }
                    if (isset($_POST['ch'])) {
                        $lang .= mysqli_real_escape_string($connection, $_POST['ch']) . " ";
                    }
                } else {
                    return "check at least 1 language!";
                }

                while (1) {
                    #create id
                    $id = rand(1, 999999);// generate unique random number

                    $q = "SELECT * FROM jobseeker WHERE id='$id'";  // check if it exists in database
                    $res = mysqli_query($connection, $q);
                    $rowCount = mysqli_num_rows($res);

                    // not found in the db = unique, so insert id into db and break loop
                    if ($rowCount < 1) {
                        #hash password
                        $ph = password_hash($password, PASSWORD_DEFAULT);

                        #save to DB
                        $sql = "INSERT INTO `jobseeker` (`id`, `first_name`, `last_name`, `age`, `qualifications`, `work_experience`,
                        `languages`, `phone_number`, `email_address`, `password`)
                        VALUES($id,'$firstname', '$lastname' ,'$age','$qual','$allwork','$lang','$phone', '$email', '$ph');";

                        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));


                        $query = "SELECT * FROM `jobseeker` WHERE email_address ='$email'";
                        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                        $rows = mysqli_num_rows($result);

                        if ($rows == 1) {
                            $row = mysqli_fetch_assoc($result);
                            $id = $row['id'];
                            $_SESSION['id'] = $id;
                            $_SESSION['role'] = $role;
                            header("Location: JobSeekerHomePage.php");
                        }

                        break;
                    } //id unique
                }//end while
            }// if email not signed in
        }//elements set?
        else {
            return 'missing fields!';
        }
    }//post??
} // end function

function login($connection, $role)
{
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['submit']) || $_POST['loginprov'] == 'LogIn') {
            if ((isset($_POST['em']) && isset($_POST['ps'])) || (isset($_POST['username']) && isset($_POST['password']))) {
                if ($role == 'jobseeker') {
                    $email = $_POST['em'];
                    $password = $_POST['ps'];
                    $query = "SELECT * FROM `jobseeker` WHERE email_address ='$email'";
                }
                if ($role == 'jobprovider') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $query = "SELECT * FROM `jobprovider` WHERE username ='$username'";
                }

                $ph = password_hash($password, PASSWORD_DEFAULT);

                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $rows = mysqli_num_rows($result);

                if ($rows == 1) {
                    $row = mysqli_fetch_assoc($result);
                    if (password_verify($password, $row['password'])) {
                        $id = $row['id'];
                        $_SESSION['id'] = $id;
                        $_SESSION['role'] = $role;

                        echo $_SESSION['id'];
                        echo $_SESSION['role'];

                        if ($role == 'jobseeker') {
                            header("Location: JobSeekerHomePage.php");
                        }

                        if ($role == 'jobprovider') {
                            header("Location: JobProviderHomePage.php");
                        }
                    } else {
                        if ($role == 'jobprovider') {
                            return 'Incorrect username or password!';
                        }
                        if ($role == 'jobseeker') {
                            return 'Incorrect email or password!';
                        }
                    }
                } else {
                    if ($role == 'jobprovider') {
                        return 'Incorrect username or password!';
                    }
                    if ($role == 'jobseeker') {
                        return 'Incorrect email or password!';
                    }
                }
            } else {
                if ($role == 'jobseeker') {
                    return 'email or password is missing!';
                }
                if ($role == 'jobprovider') {
                    return 'username or password is missing!';
                }
            }
        }
    }//isset?
}//end function
