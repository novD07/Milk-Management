<?php
require_once('connection.php');
if (
    !isset($_POST['id']) ||
    !isset($_POST['name']) ||
    !isset($_POST['address']) ||
    !isset($_POST['email']) ||
    !isset($_POST['phoneNumber'])
) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}

$id = $_POST['id'];
$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];


$sql = 'UPDATE milk_brand SET name=?, address=?, email=?, phoneNumber=? WHERE id=?';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($name, $address, $email, $phoneNumber, $id));

    echo json_encode(array('status' => true, 'data' => $id, 'message' => 'Cập nhật dữ liệu trong bảng milk brand thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}