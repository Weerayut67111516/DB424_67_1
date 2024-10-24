<?php
session_start();
require 'db.php';

    if (isset($_POST['signin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = 'SELECT * FROM users U JOIN std s ON U.username-s.stdID
        WHERE username=?'; #เข้าไฟล์/ตำแหน่ง
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute(); 
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) { 
                $_SESSION['user'] = [
                    'stdID'=>$row["stdID"],
                    'firstNAME'=>$row["firstNAME"],
                    'lastNAME'=>$row["lastNAME"],
                ];
                // $_SESSION['stdID'] = $row['stdID'];
                // $_SESSION['firstNAME'] = $row['firstNAME'];
                // $_SESSION['lastNAME'] = $row['lastNAME'];
                header('location: index.php');
                exit();
            }
            else {
                echo 'password ไม่ถูกต้อง';
            }
        }
        else {
            echo 'username ไม่ถูกต้อง';
        }
    }
?>
