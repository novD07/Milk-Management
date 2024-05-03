<?php
require_once('connection.php');

$sql = 'SELECT * FROM user';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}