<?php
require 'db.php';

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน
    try {
    $sql = "SELECT stdID FROM std WHERE stdID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)"; // สร้าง prepared statement
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password); // ผูกข้อมูลกับ statement
            $stmt->execute();
            echo 'Success';
        }
        else {
            echo 'std ID not found.';
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>