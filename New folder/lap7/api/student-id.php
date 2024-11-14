<?php
require '../db.php';

$sql =  'SELECT stdID FROM std WHERE stdID not in (SELECT username from users)';
$result = $conn->query($sql);
$date = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
http_response_code(200);
echo json_encode($data);
?>

