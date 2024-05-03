<?php
require_once('connection.php');
if (
    !isset($_POST['id']) ||
    !isset($_POST['name']) ||
    !isset($_POST['sex']) ||
    !isset($_POST['address']) ||
    !isset($_POST['email']) ||
    !isset($_POST['phone']) ||
    !isset($_POST['password'])
) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}

$id = $_POST['id'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$sql = 'UPDATE user SET name=?, sex=?, address=?, email=?, password=?, phone=? WHERE id=?';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($name, $sex, $address, $email, $password, $phone, $id));

    echo json_encode(array('status' => true, 'data' => $id, 'message' => 'Cập nhật dữ liệu trong bảng Profile thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}