<?php
require_once('connection.php');

if (!isset($_GET['id'])) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}


$id = $_GET['id'];

$sql = 'SELECT * FROM cart WHERE user=? AND status = 1';

$stmt = $dbCon->prepare($sql);
$stmt->execute(array($id));

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);