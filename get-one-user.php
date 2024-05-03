<?php
require_once('connection.php');

if (!isset($_GET['id'])) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}

$id = $_GET['id'];

$sql = 'SELECT * FROM user WHERE id=?';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($id));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        die(json_encode(array('status' => false, 'message' => 'User not found')));
    }

    echo json_encode($result);
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}