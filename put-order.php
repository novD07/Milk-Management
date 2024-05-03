<?php
require_once('connection.php');
if (
    !isset($_GET['id']) ||
    !isset($_GET['status'])
) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}

$id = $_GET['id'];
$status = $_GET['status'];




$sql = 'UPDATE `order` SET status=? WHERE id=?';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($status, $id));

    echo json_encode(array('status' => true, 'data' => $id, 'message' => 'Cập nhật dữ liệu trong bảng order thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}