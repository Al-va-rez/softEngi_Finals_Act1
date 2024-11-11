<?php
    require_once 'dbConfig.php';
    require_once 'functions.php';


    /* --- USERS --- */
    // REGISTER
    if (isset($_POST['btn_Register'])) {

        if (!empty($_POST['username']) && !empty($_POST['first_Name']) && !empty($_POST['last_Name']) && !empty($_POST['password'])) {

            $username = sanitizeInput($_POST['username']);
            $first_Name = sanitizeInput($_POST['first_Name']);
            $last_Name = sanitizeInput($_POST['last_Name']);

            if ($_POST['password'] == $_POST['password_conf']) {

                if (validatePassword(sanitizeInput($_POST['password']))) { // check password strength

                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // encrypt password
                    $register = register($pdo, $username, $first_Name, $last_Name, $password); // add user

                    if ($register['status'] == '200') { // user added
                        echo '<script>
                            alert("User registered. (200)");
                            window.location.href = "../index.php";
                        </script>';

                    } else { // already registered
                        echo '<script>
                            alert("Already registered. (400)");
                            window.location.href = "../register.php";
                        </script>';
                    }
                } else { // weak password
                    echo '<script>
                        alert("Password should be more than 8 characters and should contain both uppercase, lowercase, and numbers.");
                        window.location.href = "../register.php";
                    </script>';
                }
            } else { // passwords not the same
                $_SESSION['message'] = "Passwords are not the same";
                $_SESSION['status'] = "400";
                header("Location: ../register.php");
            }
        } else { // missing info
            $_SESSION['message'] = "Missing info";
            $_SESSION['status'] = "400";
            header("Location: ../register.php");
        }
    }

    // LOGIN
    if (isset($_POST['btn_Login'])) {

        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);

        if (!empty($username) && !empty($password)) {

            $check_User = check_UserExists($pdo, $username); 

            if ($check_User['status'] == '200') { // user found in database
                $username_FromDB = $check_User['userInfo']['username'];
                $password_FromDB = $check_User['userInfo']['password'];

                if (password_verify($password, $password_FromDB)) {
                    $_SESSION['username'] = $username_FromDB;
                    header('Location: ../index.php');
                    
                } else { // wrong password
                    echo '<script>
                        alert("Wrong password. (400)");
                        window.location.href = "../index.php";
                    </script>';
                }
            } else { // wrong username
                $_SESSION['message'] = $check_User['message']; // "User not found in database"
                $_SESSION['status'] = $check_User['status']; // "400"
                header("Location: ../login.php");
            }
        } else { // missing info
            $_SESSION['message'] = "Missing info";
            $_SESSION['status'] = "400";
            header("Location: ../login.php");
        }
    }

    // LOGOUT
    if (isset($_GET['btn_Logout'])) {
        unset($_SESSION['username']);
        header('Location: ../index.php');
    }



    /* --- RECORDS --- */
    // ADD
    if (isset($_POST['btn_Add'])) {
        $first_Name = sanitizeInput($_POST['first_Name']);
        $last_Name = sanitizeInput($_POST['last_Name']);
        $dob = sanitizeInput($_POST['dob']);
        $age = sanitizeInput($_POST['age']);
        $sex = sanitizeInput($_POST['sex']);
        $residence = sanitizeInput($_POST['residence']);
        $email = sanitizeInput($_POST['email']);

        if (!empty($first_Name) && !empty($last_Name) && !empty($dob) && !empty($age) && !empty($sex) && !empty($residence) && !empty($email)) {

            if (add_Record($pdo, $first_Name, $last_Name, $dob, $age, $sex, $residence, $email)) {
                
                $_SESSION['message'] = "Record created.";
                header("Location: ../index.php");
                
            } else {
                echo "AAAAAAAAAAAAAAAA";
            }
        } else { // missing info
            $_SESSION['message'] = "Missing info";
            $_SESSION['status'] = "400";
            header("Location: ../create.php");
        }
    }

    // UPDATE
    if (isset($_POST['btn_Edit'])) {
        $first_Name = sanitizeInput($_POST['first_Name']);
        $last_Name = sanitizeInput($_POST['last_Name']);
        $dob = sanitizeInput($_POST['dob']);
        $age = sanitizeInput($_POST['age']);
        $sex = sanitizeInput($_POST['sex']);
        $residence = sanitizeInput($_POST['residence']);
        $email = sanitizeInput($_POST['email']);

        if (!empty($first_Name) && !empty($last_Name) && !empty($dob) && !empty($age) && !empty($sex) && !empty($residence) && !empty($email)) {

            if (edit_Record($pdo, $first_Name, $last_Name, $dob, $age, $sex, $residence, $email)) {
                
                $_SESSION['message'] = "Record updated.";
                header("Location: ../index.php");
                
            } else {
                echo "AAAAAAAAAAAAAAAA";
            }
        } else { // missing info
            $_SESSION['message'] = "Missing info";
            $_SESSION['status'] = "400";
            header("Location: ../edit.php");
        }
    }

    // DELETE
    if (isset($_POST['btn_Delete'])) {
        $query1 = delete_Record($pdo, $_GET['id']);

        if (delete_Record($pdo, $_GET['id'])) {
            
            $_SESSION['message'] = "Record deleted.";
            header("Location: ../index.php");
            
        } else {
            echo "AAAAAAAAAAAA";
        }
    }
?>
