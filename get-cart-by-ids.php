<?php
require_once('connection.php');

if (!isset($_GET['ids'])) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}


$ids = $_GET['ids'];

$sql = 'SELECT * FROM cart WHERE id IN (?)';

$stmt = $dbCon->prepare($sql);
$stmt->execute(array($ids));

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);