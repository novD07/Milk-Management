<?php
require_once('connection.php');

function uploadImage($file)
{
    $targetDir = 'imageUpload/';
    $milliseconds = round(microtime(true) * 1000);
    $targetFile = $targetDir . basename($file['name'], '.' . pathinfo($file['name'], PATHINFO_EXTENSION)) . '-' . $milliseconds . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có phải là hình ảnh thật sự hay không
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        $uploadOk = 0;
    }

    // Kiểm tra nếu tệp đã tồn tại
    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    // Kiểm tra kích thước tệp
    if ($file['size'] > 500000) {
        $uploadOk = 0;
    }

    // Cho phép chỉ định các định dạng tệp hình ảnh
    $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowedFormats)) {
        $uploadOk = 0;
    }

    // Kiểm tra biến $uploadOk để đảm bảo không có lỗi xảy ra
    if ($uploadOk == 0) {
        die(json_encode(array('status' => false, 'message' => 'File upload failed.')));
    } else {
        // Nếu mọi thứ đều ổn, di chuyển tệp lên thư mục mong muốn
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return str_replace("imageUpload/", "", $targetFile);
        } else {
            die(json_encode(array('status' => false, 'message' => 'File upload failed.')));
        }
    }
}

if (
    !isset($_POST['name']) ||
    !isset($_POST['brand']) ||
    !isset($_POST['type']) ||
    !isset($_POST['weight']) ||
    !isset($_POST['price']) ||
    !isset($_POST['nutritionalIngredients']) ||
    !isset($_POST['benefit'])
) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}

$id = $_POST['id'];
$name = $_POST['name'];
$brand = $_POST['brand'];
$type = $_POST['type'];
$weight = $_POST['weight'];
$price = $_POST['price'];
$nutritionalIngredients = $_POST['nutritionalIngredients'];
$benefit = $_POST['benefit'];

// Xử lý upload hình ảnh và nhận đường dẫn của nó
$image = (isset($_FILES['image']) && !empty($_FILES['image']['name'])) ? uploadImage($_FILES['image']) : "default.jpg";

$sql = 'INSERT INTO milk(id, name, brand, type, weight, price, nutritionalIngredients, benefit, image) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($id, $name, $brand, $type, $weight, $price, $nutritionalIngredients, $benefit, $image));

    echo json_encode(array('status' => true, 'data' => $dbCon->lastInsertId(), 'message' => 'Thêm dữ liệu vào bảng milk thành công'));
} catch (PDOException $ex) {
    die(json_encode(array('status' => false, 'message' => $ex->getMessage())));
}