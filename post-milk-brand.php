<?php
require_once('connection.php');

$id = $_POST['id'];
$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];

$sql = 'INSERT INTO milk_brand(id, name, address, email, phoneNumber) VALUES(?, ?, ?, ?, ?)';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($id, $name, $address, $email, $phoneNumber));

    echo json_encode(array('status' => true, 'data' => $dbCon->lastInsertId(), 'message' => 'Thêm dữ liệu vào bảng milk brand thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}