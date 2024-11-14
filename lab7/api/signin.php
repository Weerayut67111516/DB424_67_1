<?php
session_start();
require '../db.php';

if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
    $sql = 'SELECT * 
            FROM users JOIN student 
            ON username=studentID
            WHERE username=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
      if (password_verify($password, $row['password'])) {
        $_SESSION['user'] = [
            'studentID'=> $row['studentID'],
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
        ];
        http_response_code(200);
        echo 'Success';
    }
    else {
        http_response_code(401);
        echo 'Password ไม่ถูกต้อง';
    }
    }
    else {
        http_response_code(401);
        echo 'Username ไม่ถูกต้อง';
    }
 }
    catch (Exception) {
        http_response_code(500);
        echo 'Server error.';
}
}
    else{
        http_response_code(401);
        echo "Unauthorized.";
    }
?>