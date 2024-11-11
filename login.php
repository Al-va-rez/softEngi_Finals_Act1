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
        <style>
            body {
                background-color: darkslategray;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
            }
            div {
                background-color: white;
                border: 5px solid;
                width: fit-content;
                padding: 25px 50px;
                margin: auto;
                margin-top: 50px;
            }
            h1 {
                text-align: center;
            }
            form {
                padding: 15px 0px 30px;
            }
        </style>
    </head>
    <body>
        <div>
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
            <h1>LOGIN</h1>
            
            <form action="core/handleForms.php" method="POST">
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