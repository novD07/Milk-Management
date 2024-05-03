<?php
require_once('connection.php');
if (
    !isset($_POST['id']) ||
    !isset($_POST['user']) ||
    !isset($_POST['milk']) ||
    !isset($_POST['quantity'])
) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}

$id = $_POST['id'];
$user = $_POST['user'];
$milk = $_POST['milk'];
$quantity = $_POST['quantity'];



$sql = 'UPDATE cart SET user=?, milk=?, quantity=? WHERE id=?';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($name, $address, $email, $phoneNumber, $id));

    echo json_encode(array('status' => true, 'data' => $id, 'message' => 'Cập nhật dữ liệu trong bảng cart thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}