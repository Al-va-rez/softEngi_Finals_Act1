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
        <link rel="stylesheet" href="styles.css">
    </head>
    <body class="edit_Record">
        <?php $user_Record = getSpecific_Record($pdo, $_GET['id']); ?>
        <div class="center_Form">
            <!-- MESSAGE -->
            <?php if (isset($_SESSION['message'])) { ?>
                <h1 style="color: red;"><?= $_SESSION['message']; ?></h1>
            <?php }
                unset($_SESSION['message']);
            ?>

            <h1 class="center_Form">Edit Record</h1>

            <form class="center_Form" action="core/handleForms.php?id=<?= $_GET['id']; ?>" method="POST">
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