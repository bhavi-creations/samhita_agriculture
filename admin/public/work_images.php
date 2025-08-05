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

                    <form id="mediaUploadForm" action="upload_works.php" method="POST" $_FILES['media_file'] enctype="multipart/form-data" style="color:black;">
                        <!-- 🔹 Select Media Type -->
                        <div class="mb-3">
                            <label for="mediaType" class="form-label text-primary">Select Media Type</label>
                            <select class="form-control" name="media_type" id="mediaType" required>
                                <option value="">-- Select Media Type --</option>
                                <!-- <option value="Logo">Logo</option>
                                <option value="Website">Website</option> -->
                                <option value="Posters">Posters</option>
                                <!-- <option value="Reels">Reels</option>
                                <option value="Photo Shoot">Photo Shoot</option>
                                <option value="Videos">Videos</option> -->
                                <option value="Testimonials">Testimonials</option>
                                <!-- <option value="Animated Videos">Animated Videos</option>
                                <option value="Visiting Cards">Visiting Cards</option> -->
                                <option value="Pamphlets">Pamphlets</option>
                                <!-- <option value="Brochures">Brochures</option>
                                <option value="Hoardings">Hoardings</option> -->
                            </select>
                        </div>



                        
                        <!-- 🔹 Optional Link -->
                        <!-- <div class="mb-3">
                            <label for="mediaLink" class="form-label text-primary">Optional Redirect Link</label>
                            <input type="url" class="form-control" name="media_link" id="mediaLink" placeholder="https://example.com">
                        </div> -->

                        <!-- 🔹 Upload File -->
                        <div class="mb-3">
                            <label for="mediaFile" class="form-label text-primary">Upload File (Image, Video, or PDF)</label>
                            <input type="file" class="form-control" name="media_file" accept="image/*,video/*,.pdf" required />
                        </div>


                        <!-- 🔹 Buttons -->
                        <div class="row p-3">
                            <div class="col-xl-7 col-sm-2"></div>
                            <button type="reset" class="btn btn-danger mx-1 my-2 col-xl-2">Clear</button>
                            <button type="submit" class="btn btn-success mx-1 my-2 col-xl-2">Upload</button>
                        </div>
                    </form>





                    <script>
                        function toggleMediaFields() {
                            const selectedType = document.getElementById("mediaType").value;
                            const fields = document.getElementById("mediaFields");
                            const fileInput = document.getElementById("mediaFile");

                            if (selectedType !== "") {
                                fields.style.display = "block";
                                fileInput.required = true;
                            } else {
                                fields.style.display = "none";
                                fileInput.required = false;
                            }
                        }
                    </script>


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