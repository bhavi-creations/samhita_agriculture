<?php
include '../../db.connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $title = $_POST['title'];
    $image = $_FILES['image'];

    // Image upload folder
    $targetDir = "uploads/images/";

    // Get the file extension
    $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    // Generate a unique file name
    $targetFile = $targetDir . uniqid() . '.' . $imageFileType;

    // Check if the image file is a valid image (optional)
    $check = getimagesize($image['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        // Insert into the database
        $sql = "INSERT INTO image_uploads (title, image_path) VALUES ('$title', '$targetFile')";
        if ($conn->query($sql) === TRUE) {
            echo "Image uploaded successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
