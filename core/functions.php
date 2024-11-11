<?php

    /* --- INPUT SECURITY --- */
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validatePassword($password) {
        if (strlen($password) > 8) { // longer than 8 char
            $hasLower = false;
            $hasUpper = false;
            $hasNumber = false;

            for ($i = 0; $i < strlen($password); $i++) {
                if (ctype_lower($password[$i])) { // has lower case
                    $hasLower = true; 
                }
                elseif (ctype_upper($password[$i])) { // has upper case
                    $hasUpper = true; 
                }
                elseif (ctype_digit($password[$i])) { // has numbers
                    $hasNumber = true;
                }
                
                if ($hasLower && $hasUpper && $hasNumber) {
                    return true; 
                }
            }
        } else {
            return false; 
        }
    }



    /* --- USER ACCOUNTS --- */
    function check_UserExists($pdo, $username) {
        $response = array();

        $sql = "SELECT * FROM user_credentials WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$username])) {

            $userInfo = $stmt->fetch();

            if ($stmt->rowCount() > 0) { // user already in database
                $response = array(
                    "result" => true,
                    "status" => "200",
                    "userInfo" => $userInfo
                );
            } else { // green light for adding user
                $response = array(
                    "status" => "400",
                    "message" => "User not found in database"
                );
            }
        }

        return $response;
    }

    function register($pdo, $username, $first_Name, $last_Name, $password) {

        $response = array();
        $check_User = check_UserExists($pdo, $username);

        
        if (!$check_User['result']) {

            $sql = "INSERT INTO user_credentials (username, first_Name, last_Name, password) VALUES (?,?,?,?)";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$username, $first_Name, $last_Name, $password])) { // add user to database
                $response = array(
                    "status" => "200",
                    "message" => "User added"
                );
            } else {
                $response = array( // user already registered
                    "status" => "400",
                    "message" => "User already registered"
                );
            }
        }

        return $response;
    }



    /* --- RECORDS --- */
    // FETCH ALL
    function getAll_Records($pdo) {
        
        $sql = "SELECT * FROM applicants ORDER BY last_Name ASC";

        $query = $pdo->prepare($sql);
        $executeQuery = $query->execute();

        if ($executeQuery) {
            return $query->fetchAll();
        }
    }

    // FETCH
    function getSpecific_Record($pdo, $id) {
        
        $sql = "SELECT * FROM applicants WHERE id = ?";

        $query = $pdo->prepare($sql);
        $executeQuery = $query->execute([$id]);

        if ($executeQuery) {
            return $query->fetch();
        }
    }

    // SEARCH
    function searchSpecific_Record($pdo, $searchQuery) {
        
        $sql = "SELECT * FROM applicants WHERE CONCAT(first_Name, last_Name, dob, age, sex, residence, email) COLLATE utf8mb4_bin LIKE ? ";

        $query = $pdo->prepare($sql);
        $executeQuery = $query->execute(["%" . $searchQuery . "%"]);

        if ($executeQuery) {
            return $query->fetchAll();
        }
    }

    // ADD
    function add_Record($pdo, $first_Name, $last_Name, $dob, $age, $sex, $residence, $email) {
        
        $sql = "INSERT INTO applicants (first_Name, last_Name, dob, age, sex, residence, email) VALUES (?,?,?,?,?,?,?)";   

        $query = $pdo->prepare($sql);
        $executeQuery = $query->execute([$first_Name, $last_Name, $dob, $age, $sex, $residence, $email]);

        if ($executeQuery) {
            return true;
        }
    }

    // UPDATE
    function edit_Record($pdo, $first_Name, $last_Name, $dob, $age, $sex, $residence, $email) {
        
        $sql = "UPDATE applicants
                    SET first_Name = ?,
                        last_Name = ?,
                        dob = ?, 
                        age = ?,
                        sex = ?,
                        residence = ?,
                        email = ?
                    WHERE id = ?
                ";   

        $query = $pdo->prepare($sql);
        $executeQuery = $query->execute([$first_Name, $last_Name, $dob, $age, $sex, $residence, $email, $_GET['id']]);

        if ($executeQuery) {
            return true;
        }
    }

    // DELETE
    function delete_Record($pdo, $id) {
        
        $sql = "DELETE FROM applicants WHERE id = ?";

        $query = $pdo->prepare($sql);
        $executeQuery = $query->execute([$id]);

        if ($executeQuery) {
            return true;
        }
    }
?>
