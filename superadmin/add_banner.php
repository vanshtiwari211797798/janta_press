<?php
include("config/db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_FILES['image']['name'])) {
        echo "<script>alert('Image is required');</script>";
    } else {
        $image = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($imageTmp, "banner/$image");
        $sql = "INSERT INTO banners (image) VALUES ('$image')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Image Uploaded successfully');</script>";
            // Refresh the page to show the new banner
            echo "<script>window.location.href = window.location.href;</script>";
        }
    }
}

// Handle delete if ID is provided
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM banners WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Banner deleted successfully');</script>";
        // Refresh the page
        echo "<script>window.location.href = 'add_banner.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Banners</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --danger-color: #f72585;
            --success-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1.2rem;
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #d1145a;
            transform: translateY(-2px);
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .back-btn {
            margin-bottom: 1.5rem;
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .file-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px dashed #ccc;
            border-radius: var(--border-radius);
            background-color: var(--light-color);
            transition: var(--transition);
        }

        .file-input:hover {
            border-color: var(--primary-color);
        }

        .preview-container {
            margin-top: 1rem;
            text-align: center;
        }

        .preview-img {
            max-width: 100%;
            max-height: 200px;
            border-radius: var(--border-radius);
            display: none;
            margin: 1rem auto;
            box-shadow: var(--box-shadow);
        }

        .table-container {
            overflow-x: auto;
        }

        .banner-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        .banner-table th,
        .banner-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .banner-table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .banner-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .banner-table tr:hover {
            background-color: #e9ecef;
        }

        .banner-img {
            max-width: 300px;
            max-height: 150px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .banner-img:hover {
            transform: scale(1.05);
        }

        .action-btns {
            display: flex;
            gap: 0.5rem;
        }

        .no-banners {
            text-align: center;
            padding: 2rem;
            color: var(--gray-color);
        }

        .no-banners i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ddd;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                padding: 0 0.5rem;
            }

            .card {
                padding: 1rem;
            }

            .banner-table th,
            .banner-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
            }

            .banner-img {
                max-width: 150px;
                max-height: 100px;
            }

            .action-btns {
                flex-direction: column;
            }

            .btn {
                padding: 0.5rem;
                font-size: 0.8rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Toast notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem;
            background-color: var(--success-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            display: none;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="index.php" class="btn btn-primary back-btn">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>

        <div class="card">
            <h2><i class="fas fa-plus-circle"></i> Add New Banner</h2>
            <form id="bannerForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image"><i class="fas fa-image"></i> Banner Image (Max 2MB, JPG/PNG/GIF)</label>
                    <input type="file" name="image" id="image" class="file-input" required accept="image/*">
                    <div class="preview-container">
                        <img id="imagePreview" class="preview-img" alt="Image Preview">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload Banner
                </button>
            </form>
        </div>

        <div class="card">
            <h2><i class="fas fa-images"></i> Existing Banners</h2>
            <div class="table-container">
                <?php
                $fetchBanner = "SELECT * FROM banners ORDER BY id DESC";
                $data = mysqli_query($conn, $fetchBanner);
                if (mysqli_num_rows($data) > 0) {
                ?>
                    <table class="banner-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image Preview</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sr = 1; while ($res = mysqli_fetch_assoc($data)) { ?>
                                <tr>
                                    <td><?= $sr++ ?></td>
                                    <td>
                                        <img src="banner/<?= $res['image'] ?>" alt="Banner Image" class="banner-img">
                                    </td>
                                    <td class="action-btns">
                                        <a href="?delete_id=<?= $res['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this banner?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="no-banners">
                        <i class="fas fa-image"></i>
                        <h3>No Banners Found</h3>
                        <p>Upload your first banner using the form above.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Show toast notification
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.style.display = 'block';
            toast.style.backgroundColor = type === 'success' ? '#4cc9f0' : '#f72585';
            
            setTimeout(() => {
                toast.style.display = 'none';
            }, 3000);
        }

        // Check for success/error messages in URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                showToast(urlParams.get('success'));
            } else if (urlParams.has('error')) {
                showToast(urlParams.get('error'), 'error');
            }
        };
    </script>
</body>

</html>