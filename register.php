<?php
require_once('connection.php');
if (
    !isset($_POST['name']) ||
    !isset($_POST['sex']) ||
    !isset($_POST['address']) ||
    !isset($_POST['email']) ||
    !isset($_POST['phone']) ||
    !isset($_POST['password'])
) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}
$name = $_POST['name'];
$sex = $_POST['sex'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$sql1 = 'SELECT * FROM user WHERE role = 1';

try {
    $stmt1 = $dbCon->prepare($sql1);
    $stmt1->execute();
    $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    if (count($results) > 0) {
        $sql = 'INSERT INTO user(name, sex, address, email, password, phone) VALUES(?, ?, ?, ?, ?, ?)';
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($name, $sex, $address, $email, $password, $phone));
    } else {
        $sql = 'INSERT INTO user(name, sex, address, email, password, phone, role) VALUES(?, ?, ?, ?, ?, ?, ?)';
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($name, $sex, $address, $email, $password, $phone, 1));
    }
    echo json_encode(array('status' => true, 'data' => $dbCon->lastInsertId(), 'message' => 'Register Success'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}