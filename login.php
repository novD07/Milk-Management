<?php
require_once('connection.php');

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}

$email = $_POST['email'];
$password = $_POST['password'];
$sql = 'SELECT * FROM user WHERE email=? AND password=?';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($email, $password));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        die(json_encode(array('status' => false, 'message' => 'Login failed')));
    }

    echo json_encode(array('status' => true, 'data' => $result));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}