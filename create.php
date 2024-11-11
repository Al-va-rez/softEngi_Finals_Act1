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
        <link rel="stylesheet" href="styles.css">
    </head>
    <body class="add_Record">
        <div class="center_Form">
            <!-- MESSAGE -->
            <?php if (isset($_SESSION['message'])) { ?>
                <h1 style="color: red;"><?= $_SESSION['message']; ?></h1>
            <?php }
                unset($_SESSION['message']);
            ?>

            <h1 class="center_Form">Add record</h1>

            <form class="center_Form" action="core/handleForms.php" method="POST">
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