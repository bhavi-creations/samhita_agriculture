<?php
// Include the database connection file
include '../../db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the image path to delete the file from the server
    $sql = "SELECT image FROM staff_image_uploads WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $staff = $result->fetch_assoc();
        $image_path = $staff['image'];

        // Delete the image file from the server
        if (!empty($image_path) && file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete the staff record from the database
        $delete_sql = "DELETE FROM staff_image_uploads WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param('i', $id);
        $delete_stmt->execute();

        if ($delete_stmt->affected_rows > 0) {
            echo "Staff image deleted successfully.";
            header('Location: staff_allimages.php'); // Redirect to the staff image list page
            exit;
        } else {
            echo "Failed to delete staff image.";
        }
    } else {
        echo "Staff record not found.";
    }
} else {
    echo "No staff ID provided.";
}
?>
