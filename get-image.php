<?php
require_once('connection.php');

if (!isset($_GET['fileName'])) {
    die(json_encode(array('status' => false, 'message' => 'Parameters not valid')));
}
$imageFilename = $_GET['fileName'];

// Hàm cung cấp thư mục "imageUpload"
function provideImageDirectory()
{
    $imageDirectoryPath = 'imageUpload';
    $imageDirectory = scandir($imageDirectoryPath);

    $images = [];
    foreach ($imageDirectory as $file) {
        if ($file !== '.' && $file !== '..') {
            $images[] = $file;
        }
    }

    return $images;
}

// Sử dụng hàm
$imagesInDirectory = provideImageDirectory();
echo json_encode($imagesInDirectory);

// Hàm lấy hình ảnh
function getImage($filename)
{
    $imagePath = 'imageUpload/' . $filename;
    if (file_exists($imagePath)) {
        $mime = mime_content_type($imagePath);
        header("Content-Type: $mime");
        readfile($imagePath);
    } else {
        http_response_code(404);
        die('Not Found');
    }
}

// Sử dụng hàm

getImage($imageFilename);