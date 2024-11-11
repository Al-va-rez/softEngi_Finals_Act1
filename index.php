<?php
    require_once 'core/dbConfig.php';
    require_once 'core/functions.php';

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Searching Records</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <!-- OPERATIONS MESSAGE -->
        <?php if (isset($_SESSION['message'])) { ?>
            <h1 style="color: green;"><?= $_SESSION['message']; ?></h1>
        <?php }
            unset($_SESSION['message']);
        ?>


        <!-- WELCOME MESSAGE -->
        <div>
            <h1>Welcome, <?= $_SESSION['username'] ?></h1>
            <i><a href="core/handleForms.php?btn_Logout=1">Logout</a></i>
        </div>

        <!-- CLEAR SEARCH BOX -->
        <p><a href="index.php">Clear Search Query</a></p>
        <!-- ADD APPLICANT -->
        <p><a href="create.php">Add applicant</a></p>

        
        <!-- SEARCH BOX -->
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
            <input type="text" name="inp_Search" placeholder="search here...">
            <input type="submit" name="btn_Search">
        </form>

        
        <!-- SEARCH RESULTS -->
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Residence</th>
                <th>Email</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
            <?php if (!isset($_GET['btn_Search'])) { ?> <!-- DISPLAY ALL RECORDS -->
                <?php $getAllRecords = getAll_Records($pdo); ?>
                
                <?php foreach ($getAllRecords as $row) { ?>
                    <tr>
                        <td><?= $row['first_Name'] ?></td>
                        <td><?= $row['last_Name'] ?></td>
                        <td><?= $row['dob'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['sex'] ?></td>
                        <td><?= $row['residence'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['date_Added'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>  <!-- DISPLAY SEARCHED RECORD/S -->
                <?php $getRecord = searchSpecific_Record($pdo, $_GET['inp_Search']); ?>
                
                <?php foreach ($getRecord as $row) { ?>
                    <tr>
                        <td><?= $row['first_Name'] ?></td>
                        <td><?= $row['last_Name'] ?></td>
                        <td><?= $row['dob'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['sex'] ?></td>
                        <td><?= $row['residence'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['date_Added'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </body>
</html>
