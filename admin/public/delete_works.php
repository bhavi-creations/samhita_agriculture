<?php
include '../../db.connection/db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch file path
    $sql = "SELECT file_path FROM our_works WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = 'uploads/staff/' . $row['file_path'];

        // Delete the file from the server
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete the record from DB
        $delete_sql = "DELETE FROM our_works WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param('i', $id);
        $delete_stmt->execute();

        if ($delete_stmt->affected_rows > 0) {
            echo "<script>alert('✅ Work deleted successfully.'); window.location.href = 'view_works.php';</script>";
        } else {
            echo "❌ Failed to delete the record.";
        }
    } else {
        echo "❌ Record not found.";
    }
} else {
    echo "❌ No ID provided.";
}
?>
