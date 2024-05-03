<?php

/**
 * Created by PhpStorm.
 * User: mvmanh
 * Date: 8/21/17
 * Time: 3:50 PM
 */

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$host = '127.0.0.1';
$dbName = 'milk_management';
$username = 'root';
$password = '123456';

try {
    $dbCon = new PDO("mysql:host=" . $host . ";dbname=" . $dbName, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => 'Unable to connect: ' . $ex->getMessage())));
}