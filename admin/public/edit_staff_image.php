<?php
// Include the database connection file
include '../../db.connection/db_connection.php';

if (!isset($_GET['id'])) {
    echo "No staff ID provided.";
    exit;
}

$id = intval($_GET['id']); // Sanitize ID

// Fetch staff details
$sql = "SELECT id, name, role, staff_type, image FROM staff_image_uploads WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Staff record not found.";
    exit;
}

$staff = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);
    $staff_type = trim($_POST['staff_type']);
    $image_name = $staff['image']; // keep existing filename by default

    // Handle new image upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/staff/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $unique_name = uniqid('staff_', true) . '.' . $ext;
        $target_file = $target_dir . $unique_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Delete old image
            if (!empty($staff['image']) && file_exists($target_dir . $staff['image'])) {
                unlink($target_dir . $staff['image']);
            }
            $image_name = $unique_name; // Store only the filename
        } else {
            echo "<p class='text-danger mx-3'>❌ Failed to upload new image.</p>";
        }
    }

    // Update staff record
    $update_sql = "UPDATE staff_image_uploads SET name = ?, role = ?, staff_type = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('ssssi', $name, $role, $staff_type, $image_name, $id);

    if ($stmt->execute()) {
        header('Location: staff_allimages.php?update=success');
        exit;
    } else {
        echo "<p class='text-danger mx-3'>❌ Failed to update staff record: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff - Samhita soil solutions Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">

<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'navbar.php'; ?>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Edit Staff Details</h1>

                <div class="row">
                    <div class="col-xl-10">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success">Update Staff Info</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($staff['name']); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <input type="text" name="role" class="form-control" required value="<?= htmlspecialchars($staff['role']); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="staff_type">Staff Type</label>
                                        <input type="text" name="staff_type" class="form-control" value="<?= htmlspecialchars($staff['staff_type']); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Current Image</label><br>
                                        <img src="uploads/staff/<?= htmlspecialchars($staff['image']); ?>" alt="Current Image" style="max-width: 200px; max-height: 150px; border: 1px solid #ccc; padding: 5px;"><br><br>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Upload New Image (optional)</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>

                                    <button type="submit" class="btn btn-success">Update Staff</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="text-center my-auto">
                    <span style="color:black;">©2025 Bhavi Creations. All Rights Reserved. Designed & Developed by 
                        <a href="https://bhavicreations.com/" target="_blank" style="color:black; text-decoration:none;">Bhavi Creations</a>
                    </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>
