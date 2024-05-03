<?php
require_once('connection.php');

function getMilkBrands()
{
    global $dbCon;
    $query = 'SELECT * FROM milk_brand';
    $stmt = $dbCon->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

// Sử dụng hàm
$milkBrands = getMilkBrands();
echo json_encode($milkBrands);