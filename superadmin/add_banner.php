<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Banners</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-btn:hover {
            background: #45a049;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-group input[type="file"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .submit-btn {
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background: #45a049;
        }
        .banner-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        .banner-table th, .banner-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .banner-table th {
            background-color: #f2f2f2;
        }
        .banner-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .banner-table tr:hover {
            background-color: #f1f1f1;
        }
        .banner-img {
            max-width: 300px;
            max-height: 100px;
            display: block;
        }
        .delete-btn {
            padding: 6px 12px;
            background: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background: #d32f2f;
        }
        .no-banners {
            text-align: center;
            padding: 20px;
            color: #666;
        }
        .preview-container {
            margin-top: 20px;
        }
        .preview-img {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-btn">← Back</a>
        
        <h2>Add New Banner</h2>
        <form id="bannerForm">
            <div class="form-group">
                <label for="banner_image">Banner Image (Max 2MB, JPG/PNG/GIF)</label>
                <input type="file" name="banner_image" id="banner_image" required accept="image/*">
                <div class="preview-container">
                    <img id="imagePreview" class="preview-img" alt="Image Preview">
                </div>
            </div>
            <button type="button" class="submit-btn" onclick="addBanner()">Upload Banner</button>
        </form>

        <h2>Existing Banners</h2>
        <div id="noBanners" class="no-banners">No banners found. Upload your first banner above.</div>
        
        <table class="banner-table" id="bannersTable" style="display: none;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Preview</th>
                    <th>Image Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="bannersList">
                <!-- Banners will be added here dynamically -->
            </tbody>
        </table>
    </div>

    <script>
        // Sample data for demonstration
        let banners = [
            { id: 1, name: "banner1.jpg", url: "https://via.placeholder.com/800x200" },
            { id: 2, name: "banner2.png", url: "https://via.placeholder.com/800x200/333/fff" }
        ];
        let nextId = 3;

        // Display initial banners
        function displayBanners() {
            const bannersList = document.getElementById('bannersList');
            bannersList.innerHTML = '';
            
            if (banners.length === 0) {
                document.getElementById('noBanners').style.display = 'block';
                document.getElementById('bannersTable').style.display = 'none';
                return;
            }
            
            document.getElementById('noBanners').style.display = 'none';
            document.getElementById('bannersTable').style.display = 'table';
            
            banners.forEach(banner => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${banner.id}</td>
                    <td><img src="${banner.url}" alt="Banner Preview" class="banner-img"></td>
                    <td>${banner.name}</td>
                    <td>
                        <button class="delete-btn" onclick="deleteBanner(${banner.id})">Delete</button>
                    </td>
                `;
                bannersList.appendChild(row);
            });
        }

        // Add new banner
   

        // Delete banner
     

        // Image preview
        document.getElementById('banner_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const preview = document.getElementById('imagePreview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });

        // Initialize
        displayBanners();
    </script>
</body>
</html>