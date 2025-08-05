<?php
// Include the database connection file
include '../../db.connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the image title and file
    $title = $_POST['title'];
    $image = $_FILES['image'];

    // Generate a unique filename to prevent overwriting
    $target_dir = "uploads/images/";
    $target_file = $target_dir . basename($image["name"]);
    
    // Check if the file is an actual image
    if (getimagesize($image["tmp_name"])) {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            // Insert image data into the database
            $stmt = $conn->prepare("INSERT INTO image_uploads (title, image_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $target_file);

            if ($stmt->execute()) {
                // Redirect to index.php after successful upload
                header("Location: index.php");
                exit(); // Make sure to call exit() after the header to stop further script execution
            } else {
                echo "Error uploading image.";
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>
