<?php
require_once('connection.php');

$user = $_POST['user'];
$milk = $_POST['milk'];
$quantity = $_POST['quantity'];

$sql = 'INSERT INTO cart( user, milk, quantity) VALUES(?, ?, ?)';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($user, $milk, $quantity));
    echo json_encode(
        array(
            'status' => true,
            'data' => array('id' => $dbCon->lastInsertId(), 'user' => $user, 'milk' => $milk, 'quantity' => $quantity),
            'message' => 'Thêm dữ liệu vào bảng cart thành công'
        )
    );
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}