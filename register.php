<?php
    require_once 'core/handleForms.php';
    require_once 'core/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body class="register">
        <div class="center_Form">
            <?php
                if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

                    if ($_SESSION['status'] == "200") {

                        echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";

                    } else {
                        echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";
                    }
                }
                unset($_SESSION['message']);
                unset($_SESSION['status']);
            ?>
            
            <h1 class="center_Form">REGISTER</h1>
            
            <form class="center_Form" action="core/handleForms.php" method="POST">
                <p>
                    <label for="inp_uName">Username: </label>
                    <input type="text" id="inp_uName" name="username">
                </p>

                <p>
                    <label for="inp_fName">First Name: </label>
                    <input type="text" id="inp_fName" name="first_Name">
                </p>

                <p>
                    <label for="inp_lName">Last Name: </label>
                    <input type="text" id="inp_lName" name="last_Name">
                </p>
                
                <p>
                    <label for="inp_Pass">Password: </label>
                    <input type="password" id="inp_Pass" name="password">
                </p>

                <p>
                    <label for="inp_Pass_Confirm">Confirm Password: </label>
                    <input type="password" id="inp_Pass_Confirm" name="password_conf">
                </p>

                <input type="submit" value="Register" id="register_Btn" name="btn_Register">
            </form>

            <i><a href="login.php">Back to login</a></i>
        </div>
    </body>
</html>