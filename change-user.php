<?php
require_once('connection.php');

if (!isset($_GET['id'])) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}

$id = $_GET['id'];

$sql = 'UPDATE user SET status = !status WHERE id=?';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($id));

    echo json_encode(array('status' => true, 'message' => 'Thay đổi trạng thái dữ liệu trong bảng User thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}