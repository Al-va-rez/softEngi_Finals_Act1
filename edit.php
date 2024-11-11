<?php
    require_once 'core/handleForms.php';
    require_once 'core/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Updating applicant record</title>
        <style>
            body {
                background-color: #0040b6;
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
        <?php $user_Record = getSpecific_Record($pdo, $_GET['id']); ?>
        <div>
            <!-- MESSAGE -->
            <?php if (isset($_SESSION['message'])) { ?>
                <h1 style="color: red;"><?= $_SESSION['message']; ?></h1>
            <?php }
                unset($_SESSION['message']);
            ?>

            <h1>Edit Record</h1>

            <form action="core/handleForms.php?id=<?= $_GET['id']; ?>" method="POST">
                <p>
                    <label for="first_Name">First Name: </label> 
                    <input type="text" name="first_Name" value="<?= $user_Record['first_Name']; ?>">
                </p>

                <p>
                    <label for="last_Name">Last Name: </label> 
                    <input type="text" name="last_Name" value="<?= $user_Record['last_Name']; ?>">
                </p>

                <p>
                    <label for="dob">Date of Birth: </label> 
                    <input type="date" name="dob" value="<?= $user_Record['dob']; ?>">
                </p>

                <p>
                    <label for="age">Age: </label> 
                    <input type="number" name="age" min="18" max="75" value="<?= $user_Record['age']; ?>">
                </p>

                <p>
                    <label for="sex">Sex: </label>

                        
                    <input type="radio" name="sex" id="option1" value="Male" <?php if ($user_Record['sex'] == "Male") {?> checked="checked" <?php } ?>>
                    <label class="radio_button" for="option1">M</label>

                    <input type="radio" name="sex" id="option2" value="Female" <?php if ($user_Record['sex'] == "Female") {?> checked="checked" <?php } ?>>
                    <label class="radio_button" for="option2">F</label>
                </p>

                <p>
                    <label for="residence">Residence: </label> 
                    <input type="text" name="residence" value="<?= $user_Record['residence']; ?>">
                </p>

                <p>
                    <label for="email">Email: </label> 
                    <input type="text" name="email" value="<?= $user_Record['email']; ?>">
                </p>

                <p>
                    <input type="submit" name="btn_Edit">
                </p>
            </form>
        </div>
        
    </body>
</html>