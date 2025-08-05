<?php
include '../../db.connection/db_connection.php';

if (!isset($_GET['id'])) {
    die("❌ No ID provided.");
}

$id = intval($_GET['id']);

// Fetch existing data
$sql = "SELECT * FROM our_works WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$work = $result->fetch_assoc();

if (!$work) {
    die("❌ Work not found.");
}

// Handle update
if (isset($_POST['update'])) {
    $media_type = $conn->real_escape_string($_POST['media_type']);
    $media_link = $conn->real_escape_string($_POST['media_link'] ?? '');
    $newFileName = $work['file_path']; // default: old file

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // ✅ Supported formats
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg', 'mp4', 'mov', 'avi', 'webm', 'pdf'];
        if (!in_array($ext, $allowedExt)) {
            die("❌ Invalid file type.");
        }

        $uploadDir = 'uploads/staff/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $newFileName = uniqid('work_') . '.' . $ext;
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmp, $uploadPath)) {
            // Delete old file
            $oldPath = $uploadDir . $work['file_path'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        } else {
            die("❌ Upload failed.");
        }
    }

    // Update database
    $updateSql = "UPDATE our_works SET media_type = ?, media_link = ?, file_path = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param('sssi', $media_type, $media_link, $newFileName, $id);

    if ($updateStmt->execute()) {
        echo "<script>alert('✅ Media updated successfully.'); window.location.href='view_works.php';</script>";
    } else {
        echo "❌ Update failed: " . $conn->error;
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
                    <h1 class="h3 mb-4 text-gray-800">Edit Work Media</h1>
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">Update Media</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <!-- Media Type -->
                                        <div class="form-group">
                                            <label for="media_type">Select Media Type</label>
                                            <select name="media_type" class="form-control" required>
                                                <option value="">-- Select Media Type --</option>
                                                <?php
                                                $types = [
                                                    // 'Logo',
                                                    // 'Website',
                                                    'Posters',
                                                    // 'Reels',
                                                    // 'Photo Shoot',
                                                    // 'Videos',
                                                    'Testimonials',
                                                    // 'Animated Videos',
                                                    // 'Visiting Cards',
                                                    'Pamphlets',
                                                    // 'Brochures',
                                                    // 'Hoardings'
                                                ];
                                                foreach ($types as $type) {
                                                    $selected = ($work['media_type'] === $type) ? "selected" : "";
                                                    echo "<option value='$type' $selected>$type</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Current File -->
                                        <div class="form-group">
                                            <label>Current File</label><br>
                                            <?php
                                            $file = htmlspecialchars($work['file_path']);
                                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                            $path = "uploads/staff/" . $file;

                                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'])) {
                                                echo "<img src='$path' style='max-width: 200px; height: auto; border: 1px solid #ccc; padding: 5px;'>";
                                            } elseif (in_array($ext, ['mp4', 'webm', 'mov', 'avi'])) {
                                                echo "<video controls width='200'><source src='$path' type='video/$ext'>Your browser does not support the video tag.</video>";
                                            } elseif ($ext === 'pdf') {
                                                echo "<a href='$path' target='_blank' class='btn btn-outline-info'>View Brochure (PDF)</a>";
                                            } else {
                                                echo "<p class='text-muted'>Unsupported format.</p>";
                                            }
                                            ?><br><br>
                                        </div>

                                        <!-- Optional New File -->
                                        <div class="form-group">
                                            <label for="file">Upload New File (optional)</label>
                                            <input type="file" name="file" class="form-control-file" accept="image/*,video/*,.pdf">
                                        </div>

                                        <!-- Optional Redirect Link -->
                                        <!-- <div class="form-group">
                                            <label for="media_link">Optional Redirect Link (for click)</label>
                                            <input type="url" class="form-control" name="media_link"
                                                value="<?= htmlspecialchars($work['media_link'] ?? '') ?>" placeholder="https://example.com">
                                        </div> -->

                                        <!-- Submit -->
                                        <button type="submit" name="update" class="btn btn-success">Update Work</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="text-center my-auto">
                            <span style="color:black;">©2025 Bhavi Creations. All Rights Reserved. Designed & Developed by
                                <a href="https://bhavicreations.com/" target="_blank" style="color:black; text-decoration:none;">Bhavi Creations</a>
                            </span>
                        </div>
                    </div>
                </footer>

            </div>
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