<?php

use function PHPSTORM_META\map;

require_once('connection.php');

$user = $_POST['user'];
$total = $_POST['total'];
$name = $_POST['fullName'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phoneNumber'];
$sql = 'INSERT INTO `order`(user, total, carts, fullName, address, phoneNumber, email) VALUES(?, ?, ?, ?, ?, ?, ?)';

try {
    $sql1 = 'SELECT * FROM cart WHERE user=? AND status=1';
    $stmt1 = $dbCon->prepare($sql1);
    $stmt1->execute(array($user));
    $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $ids = array();
    $ids = array_map(function ($object) {
        return $object['id'];
    }, $results);
    $idsString = implode('-', $ids);


    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($user, $total, $idsString, $name, $address, $phone, $email));

    $sql2 = 'UPDATE cart SET status = 0 WHERE user=?';
    $stmt2 = $dbCon->prepare($sql2);
    $stmt2->execute(array($user));

    echo json_encode(array('status' => true, 'data' => $dbCon->lastInsertId(), 'message' => 'Thêm dữ liệu vào bảng order thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}