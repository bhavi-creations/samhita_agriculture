<?php
include '../../db.connection/db_connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $role = $conn->real_escape_string($_POST['role']);
    $staff_type = $conn->real_escape_string($_POST['staff_type']);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'];

        // Validate image
        $imageInfo = getimagesize($fileTmp);
        if ($imageInfo === false) {
            die("❌ File is not a valid image.");
        }

        if (!in_array($ext, $allowedExt)) {
            die("❌ Error: Invalid file type. Allowed types: " . implode(', ', $allowedExt));
        }

        // Ensure upload directory exists
        $uploadDir = 'uploads/staff/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate unique file name and full path
        $newFileName = uniqid('staff_') . '.' . $ext;
        $uploadPath = $uploadDir . $newFileName;

        // Move file to upload folder
        if (move_uploaded_file($fileTmp, $uploadPath)) {
            // ✅ Store only the image name in the DB
            $sql = "INSERT INTO staff_image_uploads (name, role, staff_type, image)
                    VALUES ('$name', '$role', '$staff_type', '$newFileName')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                    alert('✅ Staff image uploaded successfully.');
                    window.location.href = 'staff_allimages.php';
                </script>";
            } else {
                echo "❌ Database Error: " . $conn->error;
            }
        } else {
            echo "❌ Failed to move uploaded file.";
        }
    } else {
        echo "❌ No image uploaded or upload error.";
    }
} else {
    echo "❌ Invalid request method.";
}

$conn->close();
?>
