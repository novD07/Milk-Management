<?php
require_once('connection.php');

if (!isset($_GET['id'])) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}




function getCartByUserId()
{
    global $dbCon;

    $id = $_GET['id'];

    $sql = 'SELECT * FROM `order` WHERE user=?';

    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($id));

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

// Sử dụng hàm
$carts = getCartByUserId();
echo json_encode($carts);