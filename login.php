<?php
    require_once 'core/handleForms.php';
    require_once 'core/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body class="login">
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
            <h1 class="center_Form">LOGIN</h1>
            
            <form class="center_Form" action="core/handleForms.php" method="POST">
                <p>
                    <label for="inp_uName">Username: </label>
                    <input type="text" id="inp_uName" name="username">
                </p>
                
                <p>
                    <label for="inp_uPass">Password: </label>
                    <input type="password" id="inp_uPass" name="password">
                </p>

                <input type="submit" value="login" id="loginBtn" name="btn_Login">
            </form>

            <i><a href="register.php">Register</a></i>
        </div>
    </body>
</html>