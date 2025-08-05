<?php include 'header.php'; ?>




<style>
    .media-tab-buttons button {
        width: 100%;
        padding: 10px;
        background-color: #ddd;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease;
    }



    .media-tab-buttons button.active {
        background-color: #2e7d32;

        /* background-color: #28323c; */
        color: #fff;
    }

    @media (max-width:768px) {
        .media-tab-buttons button.active {
            font-size: 12px !important;
        }
    }

    .media-tab-content {
        display: none;
        padding: 15px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .media-tab-content.active {
        display: block;
    }



    .media-box {
        margin: 10px 0;
    }

    img,
    video {
        max-width: 100%;
        height: auto;
    }

    @media (max-width:768px) {
        .media-tab-content video {
            width: 100% !important;
        }

    }

    /* size  */

    .media-tab-content {
        display: none;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    .media-tab-content.active {
        display: flex;
    }

    .equal-media {
        height: 250px;
        width: auto;
        object-fit: cover;
    }

    .media-tab-btn {
        padding: 20px 26px !important;
        margin: 5px;
        background-color: #ddd;
        border: none;
        cursor: pointer;
    }

    .media-tab-btn.active {
        background-color: #333;
        color: white;
    }

    @media (min-width:992px) and (max-width:1200px) {
        .logo_section {
            font-size: 10px !important;
        }

    }
</style>




<div class="container py-5">


    <div class="row g-2 mb-4 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 media-tab-buttons mx-1">
        <div><button class="media-tab-btn active" onclick="showMediaTab(event, 'all')">All</button></div>

        <div><button class="media-tab-btn text-center" onclick="showMediaTab(event, 'posters')">Posters</button></div>

        <div><button class="media-tab-btn text-center" onclick="showMediaTab(event, 'testimonials')">Testimonials</button> </div>

        <div><button class="media-tab-btn text-center" onclick="showMediaTab(event, 'pamphlets')">Pamphlets</button></div>

    </div>

    <div id="all" class="media-tab-content active">
        <div class="row">
            <?php
            include 'db.connection/db_connection.php';

            // Show only selected media types
            $sql = "SELECT * FROM our_works 
                WHERE media_type IN ('Pamphlets', 'Posters', 'Testimonials') 
                ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file = htmlspecialchars($row['file_path']);
                    $title = htmlspecialchars($row['title']);
                    $link = htmlspecialchars($row['media_link']);
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $path = "admin/public/uploads/staff/" . $file;

                    echo "<div class='col-md-4 mb-4'>
                        <div class='card shadow-sm h-100' style='overflow: hidden;'>
                            <div class='card-body p-2'>";

                    if (!empty($link)) echo "<a href='$link' target='_blank'>";

                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'])) {
                        echo "<div class='d-flex justify-content-center'>
                            <img src='$path' class='img-fluid' style='border-radius: 8px;'>
                            
                          </div>";
                    } elseif (in_array($ext, ['mp4', 'webm', 'mov', 'avi'])) {
                        echo "<video controls class='w-100' style='border-radius: 8px;'>
                            <source src='$path' type='video/$ext'>
                          </video>";
                    } elseif ($ext === 'pdf') {
                        echo "<p class='text-center'><a href='$path' target='_blank' class='btn btn-outline-info btn-sm'>📄 View PDF</a></p>";
                    } else {
                        echo "<p class='text-muted text-center'>Unsupported file format</p>";
                    }

                    if (!empty($link)) echo "</a>";

                    echo "<p class='mt-2 mb-0 text-center'><strong>$title</strong></p>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                echo "<div class='col-12'><p class='text-muted text-center'>No media available.</p></div>";
            }

            $conn->close();
            ?>
        </div>
    </div>


  
 
    <div id="posters" class="media-tab-content">
        <div class="row">
            <?php
            include 'db.connection/db_connection.php';

            $sql = "SELECT * FROM our_works WHERE media_type = 'Posters' ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file = htmlspecialchars($row['file_path']);
                    $title = htmlspecialchars($row['title']);
                    $link = htmlspecialchars($row['media_link']);
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $path = "admin/public/uploads/staff/" . $file;

                    echo "<div class='col-md-4 mb-4'>
                        <div class='card border-0 shadow-sm'>
                            <div class='card-body p-2 text-center'>";

                    if (!empty($link)) echo "<a href='$link' target='_blank'>";

                    // ✅ Display media with original ratio
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'])) {
                        echo "<img src='$path' class='img-fluid' style='border-radius: 8px;'>";
                    } elseif (in_array($ext, ['mp4', 'webm', 'mov', 'avi'])) {
                        echo "<video controls class='w-100' style='border-radius: 8px;'>
                            <source src='$path' type='video/$ext'>
                            Your browser does not support the video tag.
                          </video>";
                    } elseif ($ext === 'pdf') {
                        echo "<p><a href='$path' target='_blank' class='btn btn-outline-info btn-sm'>📄 View PDF</a></p>";
                    } else {
                        echo "<p class='text-muted'>Unsupported file format</p>";
                    }

                    if (!empty($link)) echo "</a>";

                    echo "<p class='mt-2 mb-0'><strong>$title</strong></p>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                echo "<div class='col-12'><p class='text-muted text-center'>No Posters uploaded yet.</p></div>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <div id="testimonials" class="media-tab-content">
        <div class="row">
            <?php
            include 'db.connection/db_connection.php'; // Adjust path if necessary

            $sql = "SELECT * FROM our_works WHERE media_type = 'Testimonials' ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file = htmlspecialchars($row['file_path']);
                    $title = htmlspecialchars($row['title']);
                    $link = htmlspecialchars($row['media_link']);
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $path = "admin/public/uploads/staff/" . $file; // Adjust path if needed

                    echo "<div class='col-md-4 mb-4'>
                    <div class='card'>
                        <div class='card-body p-2'>";

                    if (!empty($link)) echo "<a href='$link' target='_blank'>";

                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'])) {
                        echo "<img src='$path' class='img-fluid' style='border-radius: 8px;'>";
                    } elseif (in_array($ext, ['mp4', 'webm', 'mov', 'avi'])) {
                        echo "<video controls class='img-fluid' style='border-radius: 8px;'>
                        <source src='$path' type='video/$ext'>
                    </video>";
                    } elseif ($ext === 'pdf') {
                        echo "<p class='text-center'><a href='$path' target='_blank' class='btn btn-outline-info btn-sm'>📄 View PDF</a></p>";
                    } else {
                        echo "<p class='text-muted text-center'>Unsupported file format</p>";
                    }

                    if (!empty($link)) echo "</a>";

                    echo "<p class='mt-2 mb-0 text-center'><strong>$title</strong></p>
                        </div>
                    </div>
                </div>";
                }
            } else {
                echo "<div class='col-12'><p class='text-muted text-center'>No testimonials uploaded yet.</p></div>";
            }

            $conn->close();
            ?>
        </div>
    </div>


    <div id="pamphlets" class="media-tab-content">
        <div class="row">
            <?php
            include 'db.connection/db_connection.php'; // Update path if needed

            $sql = "SELECT * FROM our_works WHERE media_type = 'Pamphlets' ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file = htmlspecialchars($row['file_path']);
                    $title = htmlspecialchars($row['title']);
                    $link = htmlspecialchars($row['media_link']);
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $path = "admin/public/uploads/staff/" . $file;

                    echo "<div class='col-md-4 mb-4'>
                    <div class='card'>
                        <div class='card-body p-2'>";

                    if (!empty($link)) echo "<a href='$link' target='_blank'>";

                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'])) {
                        echo "<img src='$path' class='img-fluid' style='border-radius: 8px;'>";
                    } elseif (in_array($ext, ['mp4', 'webm', 'mov', 'avi'])) {
                        echo "<video controls class='img-fluid' style='border-radius: 8px;'>
                        <source src='$path' type='video/$ext'>
                    </video>";
                    } elseif ($ext === 'pdf') {
                        echo "<p class='text-center'><a href='$path' target='_blank' class='btn btn-outline-info btn-sm'>📄 View PDF</a></p>";
                    } else {
                        echo "<p class='text-muted text-center'>Unsupported file format</p>";
                    }

                    if (!empty($link)) echo "</a>";

                    echo "<p class='mt-2 mb-0 text-center'><strong>$title</strong></p>
                        </div>
                    </div>
                </div>";
                }
            } else {
                echo "<div class='col-12'><p class='text-muted text-center'>No pamphlets uploaded yet.</p></div>";
            }

            $conn->close();
            ?>
        </div>
    </div>


</div>


<script>
    function showMediaTab(event, tabName) {
        // Hide all tab contents
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("media-tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.remove("active");
        }

        // Deactivate all tab buttons
        tablinks = document.getElementsByClassName("media-tab-btn");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        // Show the specific tab content
        document.getElementById(tabName).classList.add("active");

        // Activate the button that opened the tab
        event.currentTarget.classList.add("active");

        // Update URL hash
        window.location.hash = tabName;
    }

    // Function to show the correct tab on page load based on URL hash
    function showTabFromHash() {
        let hash = window.location.hash.substring(1); // Remove the '#'
        if (hash) {
            let targetTab = document.getElementById(hash);
            let targetButton = document.querySelector(`.media-tab-btn[onclick*="'${hash}'"]`);

            if (targetTab && targetButton) {
                // Manually trigger the tab display
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("media-tab-content");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].classList.remove("active");
                }
                tablinks = document.getElementsByClassName("media-tab-btn");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].classList.remove("active");
                }

                targetTab.classList.add("active");
                targetButton.classList.add("active");
            } else {
                // If hash doesn't match a valid tab, default to 'all'
                showMediaTab(null, 'all');
            }
        } else {
            // Default to 'all' tab if no hash is present
            showMediaTab(null, 'all');
        }
    }

    // Call showTabFromHash when the page loads
    window.onload = showTabFromHash;

    // Listen for hash changes (e.g., when user uses browser back/forward buttons)
    window.onhashchange = showTabFromHash;
</script>



<?php include 'footer.php'; ?>