<?php
// Include the database connection file
include '../../db.connection/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Samhita soil solutions - Staff Images</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h2 mb-0 text-info mx-2">Our Works Media</h2>
                        <a href="work_images.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-upload fa-sm text-white-50"></i> Upload Work
                        </a>
                    </div>



                    <div class="row row-custom no-gutters">
                        <?php
                        $sql = "SELECT id, media_type, title, file_path, media_link FROM our_works ORDER BY id DESC";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "<p class='mx-3 text-danger'>Error: " . htmlspecialchars($conn->error) . "</p>";
                        } elseif ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $file = htmlspecialchars($row['file_path']);
                                $media_type = htmlspecialchars($row['media_type']);
                                $title = htmlspecialchars($row['title']);
                                $media_link = htmlspecialchars($row['media_link']);
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                $media_path = "uploads/staff/" . $file;

                                echo "<div class='col-12 col-md-4 col-custom mb-4'>
                    <div class='card card-custom shadow'>";

                                // Optional link wrap
                                if ($media_link) echo "<a href='$media_link' target='_blank'>";

                                // Render media
                                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'])) {
                                    echo "<img src='$media_path' class='card-img-top' alt='$title' style='height: 220px; object-fit: cover;'>";
                                } elseif (in_array($ext, ['mp4', 'mov', 'avi', 'webm'])) {
                                    echo "<video controls style='width: 100%; height: 220px; object-fit: cover;'>
                        <source src='$media_path' type='video/$ext'>
                        Your browser does not support the video tag.
                      </video>";
                                } elseif ($ext === 'pdf') {
                                    echo "<embed src='$media_path' type='application/pdf' width='100%' height='220px' />";
                                } else {
                                    echo "<p class='text-center text-muted'>Unsupported file type.</p>";
                                }

                                if ($media_link) echo "</a>";

                                echo "  <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text'>
                            <strong>Media Type:</strong> $media_type
                        </p>
                        <div class='row'>
                            <a href='edit_works.php?id=" . intval($row['id']) . "' class='btn btn-warning col-xl-4 mx-3 my-2'>Edit</a>
                            <a href='delete_works.php?id=" . intval($row['id']) . "' class='btn btn-danger col-xl-4 mx-3 my-2'>Delete</a>
                        </div>
                    </div>
                </div>
              </div>";
                            }
                        } else {
                            echo "<p class='mx-3'>No works uploaded yet.</p>";
                        }

                        $conn->close();
                        ?>
                    </div>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                        <p class="mini_text" style="color:black">©2025 Bhavi Creations. Designed by
                            <a href="https://bhavicreations.com/" style="text-decoration: none; color:black" target="_blank">
                                Bhavi Creations
                            </a>
                        </p>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>