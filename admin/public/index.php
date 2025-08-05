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

    <title>Samhita soil solutions - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include 'sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include 'navbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="container">
                        <div class="row">

                            <!-- Section for Image Upload -->
                            <!-- <h2 class="h2 mb-0 text-info mx-2">Uploaded Images</h2>

                             <div class="col-12 col-md-6">
                                <form action="upload_image.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="imageTitle">Image Title</label>
                                        <input type="text" class="form-control" id="imageTitle" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="imageFile">Select Image</label>
                                        <input type="file" class="form-control-file" id="imageFile" name="image" accept="image/*" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload Image</button>
                                </form>
                            </div> -->

                            <!-- Section for Displaying Uploaded Images -->
                            <div class="row row-custom no-gutters mt-4">
                                <?php
                                // Fetch image data from database
                                $image_sql = "SELECT id, title, image_path, created_at FROM image_uploads ORDER BY created_at DESC";
                                $image_result = $conn->query($image_sql);

                                if ($image_result->num_rows > 0) {
                                    while ($image_row = $image_result->fetch_assoc()) {
                                        $image_path = $image_row['image_path'];
                                        echo "
                                            <div class='col-12 col-md-4 col-custom'>
                                                <div class='card card-custom'>
                                                    <img src='{$image_path}' class='card-img-top' alt='{$image_row['title']}'>
                                                    <div class='card-body'>
                                                        <h5 class='card-title'>{$image_row['title']}</h5>
                                                        <p class='card-text'>Uploaded on: {$image_row['created_at']}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                                    }
                                } else {
                                    echo "<p>No images found.</p>";
                                }

                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <div class="footer-widget__copyright">
                            <p class="mini_text" style="color:black">©2025 Bhavi Creations. All Rights Reserved. Designed & Developed by <a href="https://bhavicreations.com/" target="_blank" style="text-decoration: none;color:black">Bhavi Creations</a></p>
                        </div>
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
