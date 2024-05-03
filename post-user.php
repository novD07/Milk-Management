<?php
require_once('connection.php');
if (
    !isset($_POST['name']) ||
    !isset($_POST['sex']) ||
    !isset($_POST['address']) ||
    !isset($_POST['email']) ||
    !isset($_POST['phone'])
) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}
$name = $_POST['name'];
$sex = $_POST['sex'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = 'INSERT INTO user(name, sex, address, email, phone) VALUES(?, ?, ?, ?, ?)';
try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($name, $sex, $address, $email, $phone));

    echo json_encode(array('status' => true, 'data' => $dbCon->lastInsertId(), 'message' => 'Thêm dữ liệu vào bảng User thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}