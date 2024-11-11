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

                // check password strength
                if (validatePassword(sanitizeInput($_POST['password']))) {

                    // encrypt password
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                    // add user
                    $register = register($pdo, $username, $first_Name, $last_Name, $password);
                    
                    // user added
                    if ($register['status'] == '200') {
                        echo '<script>
                            alert("User registered. (200)");
                            window.location.href = "../index.php";
                        </script>';

                    // already registered
                    } else {
                        echo '<script>
                            alert("Already registered. (400)");
                            window.location.href = "../register.php";
                        </script>';
                    }
                // weak password
                } else {
                    echo '<script>
                        alert("Password should be more than 8 characters and should contain both uppercase, lowercase, and numbers.");
                        window.location.href = "../register.php";
                    </script>';
                }
            // passwords not the same
            } else { 
                $_SESSION['message'] = "Passwords are not the same";
                $_SESSION['status'] = "400";
                header("Location: ../register.php");
            }
        // missing info
        } else {
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

            // user found in database
            if ($check_User['status'] == '200') {
                $username_FromDB = $check_User['userInfo']['username'];
                $password_FromDB = $check_User['userInfo']['password'];

                if (password_verify($password, $password_FromDB)) {
                    $_SESSION['username'] = $username_FromDB;
                    header('Location: ../index.php');

                // wrong password
                } else {
                    echo '<script>
                        alert("Wrong password. (400)");
                        window.location.href = "../index.php";
                    </script>';
                }
            // wrong username
            } else {
                // "User not found in database"
                $_SESSION['message'] = $check_User['message'];
                // "400"
                $_SESSION['status'] = $check_User['status'];
                
                header("Location: ../login.php");
            }
        // missing info
        } else {
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
        // missing info
        } else {
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
        // missing info
        } else {
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
