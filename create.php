<?php
    require_once 'core/handleForms.php';
    require_once 'core/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adding applicant</title>
        <style>
            body {
                background-color: #d9ae70;
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
            input[type="radio"] {
                display: inline;
            }
            .radio_button {
                margin-right: 7px;
            }
        </style>
    </head>
    <body>
        <div>
            <!-- MESSAGE -->
            <?php if (isset($_SESSION['message'])) { ?>
                <h1 style="color: red;"><?= $_SESSION['message']; ?></h1>
            <?php }
                unset($_SESSION['message']);
            ?>

            <h1>Add record</h1>

            <form action="core/handleForms.php" method="POST">
                <p>
                    <label for="first_Name">First Name: </label> 
                    <input type="text" name="first_Name">
                </p>

                <p>
                    <label for="last_Name">Last Name: </label> 
                    <input type="text" name="last_Name">
                </p>

                <p>
                    <label for="dob">Date of Birth: </label> 
                    <input type="date" name="dob">
                </p>

                <p>
                    <label for="age">Age:</label>
                    <input type="number" name="age" min="18" max="75">
                </p>

                <p>
                    <label for="sex">Sex: </label>

                    
                    <input type="radio" name="sex" id="option1" value="Male">
                    <label class="radio_button" for="option1">M</label>

                    <input type="radio" name="sex" id="option2" value="Female">
                    <label class="radio_button" for="option2">F</label>
                </p>

                <p>
                    <label for="residence">Residence: </label> 
                    <input type="text" name="residence">
                </p>

                <p>
                    <label for="email">Email: </label> 
                    <input type="email" name="email">
                </p>

                <p>
                    <input type="submit" name="btn_Add">
                </p>
            </form>
        </div>
        
    </body>
</html>