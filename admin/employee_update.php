<?php
session_start();
include("DB.php");
$id = isset($_GET['id']) ? $_GET['id'] : '';

$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Basic field validations (photo validation hata diya gaya hai)
    if (empty($_POST['emp_name'])) {
        echo "<script>alert('Employee name is required');</script>";
    }
    // ... (baaki validations same as before, without photo)
    else {
        // All form data
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
        $emp_name = mysqli_real_escape_string($conn, $_POST['emp_name']);
        $emp_n_name = mysqli_real_escape_string($conn, $_POST['emp_n_name']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $gender_n = mysqli_real_escape_string($conn, $_POST['gender_n']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $dob_n = mysqli_real_escape_string($conn, $_POST['dob_n']);
        $husband_or_father = mysqli_real_escape_string($conn, $_POST['husband_or_father']);
        $husbend_father_n = mysqli_real_escape_string($conn, $_POST['husbend_father_n']);
        $mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);
        $mother_name_n = mysqli_real_escape_string($conn, $_POST['mother_name_n']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $contact_n = mysqli_real_escape_string($conn, $_POST['contact_n']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $address_n = mysqli_real_escape_string($conn, $_POST['address_n']);
        $rfid = mysqli_real_escape_string($conn, $_POST['rfid']);
        $designation = mysqli_real_escape_string($conn, $_POST['designation']);
        $desiginition_n = mysqli_real_escape_string($conn, $_POST['desiginition_n']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $remark = mysqli_real_escape_string($conn, $_POST['remark']);
        $blood_grp = mysqli_real_escape_string($conn, $_POST['blood_grp']);
        $blood_grp_n = mysqli_real_escape_string($conn, $_POST['blood_grp_n']);
        $citizenship_number = mysqli_real_escape_string($conn, $_POST['citizenship_number']);
        $citizenship_number_n = mysqli_real_escape_string($conn, $_POST['citizenship_number_n']);
        $shaatrall_number = mysqli_real_escape_string($conn, $_POST['shaatrall_number']);
        $shaatrall_number_n = mysqli_real_escape_string($conn, $_POST['shaatrall_number_n']);
        $pan_number = mysqli_real_escape_string($conn, $_POST['pan_number']);
        $pan_number_n = mysqli_real_escape_string($conn, $_POST['pan_number_n']);
        $fileName = mysqli_real_escape_string($conn, $_POST['old_img']);
        $SignatureName = mysqli_real_escape_string($conn, $_POST['old_signature']);

        // $fileName = $_FILES['photo']['name'];


        if (!empty($_FILES['photo']['name'])) {
            $fileName = $_FILES['photo']['name'];
            $file_tmp_name = $_FILES['photo']['tmp_name'];
            move_uploaded_file($file_tmp_name, "employee_photo/$fileName");
        }
        if (!empty($_FILES['signature']['name'])) {
            $SignatureName = $_FILES['signature']['name'];
            $file_tmp_sign_name = $_FILES['signature']['tmp_name'];
            move_uploaded_file($file_tmp_sign_name, "signature/$SignatureName");
        }
        $update = "UPDATE employee SET 
                school_id='$school_id',
                emp_name='$emp_name',
                emp_n_name='$emp_n_name',
                gender='$gender',
                gender_n='$gender_n',
                dob='$dob',
                dob_n='$dob_n',
                husband_or_father='$husband_or_father',
                husbend_father_n='$husbend_father_n',
                mother_name='$mother_name',
                mother_name_n='$mother_name_n',
                contact='$contact',
                contact_n='$contact_n',
                address='$address',
                address_n='$address_n',
                rfid='$rfid',
                designation='$designation',
                desiginition_n='$desiginition_n',
                category='$category',
                remark='$remark',
                blood_grp='$blood_grp',
                blood_grp_n='$blood_grp_n',
                citizenship_number='$citizenship_number',
                citizenship_number_n='$citizenship_number_n',
                shaatrall_number='$shaatrall_number',
                shaatrall_number_n='$shaatrall_number_n',
                pan_number='$pan_number',
                pan_number_n='$pan_number_n',
                photo='$fileName',
                signature='$SignatureName'        
            WHERE id='$uid'";

        if (mysqli_query($conn, $update)) {
            echo "<script>alert('Employee updated successfully'); window.location.href='Id-Generate.php'</script>";
        } else {
            echo "<script>alert('Update failed'); window.location.href='Id-Generate.php'</script>";
        }
    }
}




// get the student by his id
$fetchEmp = "SELECT * FROM employee WHERE id=$id";
$empData = mysqli_query($conn, $fetchEmp);
if (mysqli_num_rows($empData) > 0) {
    $res = mysqli_fetch_assoc($empData);
    // print_r($res);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee Update</title>
        <link rel="stylesheet" href="style.css">
        <!-- this should go after your </body> -->
        <script src="//code.jquery.com/jquery-3.7.1.slim.min.js"></script>
        <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
        <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
        <style>
            .container {
                max-width: 1200px;
                margin: auto;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .container h2 {
                font-size: 1.5rem;
                margin-bottom: 20px;
                color: #004d40;
            }

            form {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
            }

            .form-container {
                max-width: 1000px;
                margin: auto;
                border: 1px solid #ccc;
                padding: 20px;
                border-radius: 8px;
                background-color: #f9f9f9;
            }

            .form-container h1 {
                text-align: center;
                margin-bottom: 20px;
            }

            .form-row {
                display: flex;
                flex-wrap: wrap;
                margin-bottom: 15px;
                gap: 15px;
            }

            .form-group {
                flex: 1;
                min-width: 200px;
                margin: 10px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                /* font-weight: bold; */
                font-size: 15px;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .form-group input[type="file"] {
                padding: 3px;
            }

            .form-group img {
                display: block;
                width: 50px;
                margin-top: 5px;
            }

            .submit-button {
                text-align: center;
                margin-top: 30px;
            }

            .submit-button button {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            .submit-button button:hover {
                background-color: #45a049;
            }
        </style>
    </head>

    <body>

        <div id="nav">
            <a href='Dashboard.php'><img id="logo" src="janta_logo.jpeg" alt=""></a>
            <a href="index.php">
                <h2 id="logout">Logout</h2>
            </a>
        </div>

        <div id="main">
            <div id="left-slider">
                <div class="sidebar">
                    <h2>Menu</h2>
                    <a href="Dashboard.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Dashboard')">Dashboard</a>
                    <a href="student-Management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Student')">Student</a>
                    <a href="Employee-Management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Staff')">Staff</a>
                    <a href="Holiday-Management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Holiday')">Holiday</a>
                    <a href="Leave-management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Leave')">Leave</a>
                    <a href="Attendance-management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Attendance</a>
                    <a href="add_inventry.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'AddInventry')">Add Inverntry</a>
                    <a href="inventry.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'ViewInventry')">View Inventry</a>
                    <a href="tc_management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'TC')">TC</a>
                    <a href="marksheet_management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Marksheet</a>
                    <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Admit Cart</a>
                    <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Expences</a>
                    <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Transport</a>
                    <a href="student-sms.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'SMS')">SMS</a>
                    <a href="school-general-info.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'SchoolInfo')">School Info</a>
                    <!-- <a href="Dashboard.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'CreditDetail')">Log Out</a> -->
                </div>


            </div>


            <div class="main" style="padding: 20px;">
                <h2>Employee Management</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <input type="hidden" value="<?= $res['id'] ?>" name="uid">
                        <input type="hidden" name="old_img" value="<?= $res['photo'] ?>">
                        <!-- for storing the old signature of the employee -->
                        <input type="hidden" name="old_signature" value="<?= $res['signature'] ?>">
                        <div class="form-group">
                            <label for="school_id">School Id</label>
                            <input type="text" id="school_id" name="school_id" value="<?= $res['school_id'] ?? '' ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="emp_name">Employee Name</label>
                            <input type="text" id="emp_name" name="emp_name" value="<?= $res['emp_name'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="emp_n_name">Employee Name (Nepali)</label>
                            <input type="text" id="emp_n_name" name="emp_n_name" value="<?= $res['emp_n_name'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" <?= ($res['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= ($res['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender_n">Gender (Nepali)</label>
                            <input type="text" id="gender_n" name="gender_n" value="<?= $res['gender_n'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="dob">DOB</label>
                            <input type="text" id="dob" name="dob" value="<?= $res['dob'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="dob_n">DOB (Nepali)</label>
                            <input type="text" id="dob_n" name="dob_n" value="<?= $res['dob_n'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="husband_or_father">Husband/Father Name</label>
                            <input type="text" id="husband_or_father" name="husband_or_father" value="<?= $res['husband_or_father'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="husbend_father_n">Husband/Father Name (Nepali)</label>
                            <input type="text" id="husbend_father_n" name="husbend_father_n" value="<?= $res['husbend_father_n'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_name">Mother Name</label>
                            <input type="text" id="mother_name" name="mother_name" value="<?= $res['mother_name'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_name_n">Mother Name (Nepali)</label>
                            <input type="text" id="mother_name_n" name="mother_name_n" value="<?= $res['mother_name_n'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?= $res['email'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="email_n">Email (Nepali)</label>
                            <input type="text" id="email_n" name="email_n" value="<?= $res['email_n'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact No</label>
                            <input type="text" id="contact" name="contact" value="<?= $res['contact'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="contact_n">Contact No (Nepali)</label>
                            <input type="text" id="contact_n" name="contact_n" value="<?= $res['contact_n'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="<?= $res['address'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="address_n">Address (Nepali)</label>
                            <input type="text" id="address_n" name="address_n" value="<?= $res['address_n'] ?? '' ?>">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group">
                            <label for="rfid">RFID</label>
                            <input type="text" id="rfid" name="rfid" value="<?= $res['rfid'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <select id="designation" name="designation">
                                <option value="">Select</option>
                                <option value="Teaching" <?= ($res['designation'] ?? '') == 'Teaching' ? 'selected' : '' ?>>Teaching</option>
                                <option value="nonTeaching" <?= ($res['designation'] ?? '') == 'nonTeaching' ? 'selected' : '' ?>>Non-Teaching</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="desiginition_n">Designation (Nepali)</label>
                            <input type="text" id="desiginition_n" name="desiginition_n" value="<?= $res['desiginition_n'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" id="category" name="category" value="<?= $res['category'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <input type="text" id="remark" name="remark" value="<?= $res['remark'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="blood_grp">Blood Group</label>
                            <input type="text" id="blood_grp" name="blood_grp" value="<?= $res['blood_grp'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="blood_grp_n">Blood Group (Nepali)</label>
                            <input type="text" id="blood_grp_n" name="blood_grp_n" value="<?= $res['blood_grp_n'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="citizenship_number">Citizenship Number</label>
                            <input type="text" id="citizenship_number" name="citizenship_number" value="<?= $res['citizenship_number'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="citizenship_number_n">Citizenship Number (Nepali)</label>
                            <input type="text" id="citizenship_number_n" name="citizenship_number_n" value="<?= $res['citizenship_number_n'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="shaatrall_number">Shaatrall Number</label>
                            <input type="text" id="shaatrall_number" name="shaatrall_number" value="<?= $res['shaatrall_number'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="shaatrall_number_n">Shaatrall Number (Nepali)</label>
                            <input type="text" id="shaatrall_number_n" name="shaatrall_number_n" value="<?= $res['shaatrall_number_n'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="pan_number">PAN Number</label>
                            <input type="text" id="pan_number" name="pan_number" value="<?= $res['pan_number'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="pan_number_n">PAN Number (Nepali)</label>
                            <input type="text" id="pan_number_n" name="pan_number_n" value="<?= $res['pan_number_n'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="photo">Employee Photo</label>
                            <input type="file" id="photo" name="photo">
                            <?php if (!empty($res['photo'])): ?>
                                <img src="employee_photo/<?= $res['photo'] ?>" width="100" alt="photo">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="cropModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:9999;">
                        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; padding:20px;">
                            <div style="width:500px; height:400px;">
                                <img id="cropImage" src="" style="max-width:100%;">
                            </div>
                            <div style="margin-top:20px; text-align:center;">
                                <button id="cropButton" style="padding:5px 15px; background:#4CAF50; color:white; border:none; cursor:pointer;">Crop</button>
                                <button id="cancelCrop" style="padding:5px 15px; background:#f44336; color:white; border:none; cursor:pointer;">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

                    <script>
                        // Initialize cropper with quality preservation
                        let cropper;
                        const photoInput = document.getElementById('photo');
                        const cropModal = document.getElementById('cropModal');
                        const cropImage = document.getElementById('cropImage');
                        const cropButton = document.getElementById('cropButton');
                        const cancelCrop = document.getElementById('cancelCrop');

                        // Higher DPI conversion (300 DPI for better quality)
                        const mmToPx = 300 / 25.4;
                        const targetWidthPx = 25 * mmToPx; // 25mm in pixels
                        const targetHeightPx = 30 * mmToPx; // 30mm in pixels

                        photoInput.addEventListener('change', function(e) {
                            if (e.target.files.length) {
                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    cropImage.src = event.target.result;
                                    cropModal.style.display = 'block';

                                    // Destroy previous cropper if exists
                                    if (cropper) {
                                        cropper.destroy();
                                    }

                                    // Initialize cropper with quality settings
                                    cropper = new Cropper(cropImage, {
                                        aspectRatio: 25 / 30,
                                        viewMode: 1,
                                        autoCropArea: 0.8,
                                        responsive: true,
                                        restore: false,
                                        checkCrossOrigin: false,
                                        checkOrientation: true,
                                        background: false,
                                        ready: function() {
                                            this.cropper.crop();
                                        }
                                    });
                                };
                                reader.onerror = function() {
                                    alert('Error loading image');
                                    photoInput.value = '';
                                };
                                reader.readAsDataURL(e.target.files[0]);
                            }
                        });

                        cropButton.addEventListener('click', function(e) {
                            e.preventDefault();

                            if (!cropper) return;

                            // Create canvas at higher resolution (2x)
                            const canvas = cropper.getCroppedCanvas({
                                width: targetWidthPx * 2,
                                height: targetHeightPx * 2,
                                fillColor: '#fff',
                                imageSmoothingEnabled: true,
                                imageSmoothingQuality: 'high'
                            });

                            // Create final canvas for optimal quality
                            const finalCanvas = document.createElement('canvas');
                            finalCanvas.width = targetWidthPx;
                            finalCanvas.height = targetHeightPx;
                            const ctx = finalCanvas.getContext('2d');

                            // High quality downscaling
                            ctx.imageSmoothingEnabled = true;
                            ctx.imageSmoothingQuality = 'high';
                            ctx.drawImage(canvas, 0, 0, targetWidthPx, targetHeightPx);

                            // Determine best format based on original
                            const fileName = photoInput.files[0].name;
                            const isPNG = fileName.toLowerCase().endsWith('.png');
                            const mimeType = isPNG ? 'image/png' : 'image/jpeg';

                            // Convert to blob with best quality
                            finalCanvas.toBlob(function(blob) {
                                const file = new File([blob], fileName, {
                                    type: mimeType,
                                    lastModified: Date.now()
                                });

                                // Update file input
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                photoInput.files = dataTransfer.files;

                                // Clean up
                                cropModal.style.display = 'none';
                                cropper.destroy();
                            }, mimeType, isPNG ? undefined : 0.95); // 0.95 quality for JPEG
                        });

                        cancelCrop.addEventListener('click', function(e) {
                            e.preventDefault();
                            photoInput.value = '';
                            cropModal.style.display = 'none';
                            if (cropper) {
                                cropper.destroy();
                            }
                        });
                    </script>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="signature">Employee signature</label>
                            <input type="file" id="signatureInput" name="signature" class="signature-file">
                            <?php if (!empty($res['signature'])): ?>
                                <img src="signature/<?= $res['signature'] ?>" width="100" alt="signature" class="signature-preview">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Signature Crop Modal -->
                    <!-- <div id="signatureCropModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:9999;">
                        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); background:#fff; padding:20px; border-radius:8px;">
                            <div style="width:600px; height:300px;">
                                <img id="signatureCropImage" src="" style="max-width:100%;">
                            </div>
                            <div style="margin-top:20px; text-align:center;">
                                <button id="signatureCropButton" style="padding:8px 20px; background:#4CAF50; color:white; border:none; border-radius:4px; cursor:pointer; margin-right:10px;">Crop Signature</button>
                                <button id="signatureCancelCrop" style="padding:8px 20px; background:#f44336; color:white; border:none; border-radius:4px; cursor:pointer;">Cancel</button>
                            </div>
                        </div>
                    </div> -->
<!-- 
                    <script>
                        // Signature Cropper (all variables prefixed with 'sig' to avoid duplication)
                        let sigCropper;
                        const sigInput = document.getElementById('signatureInput');
                        const sigCropModal = document.getElementById('signatureCropModal');
                        const sigCropImg = document.getElementById('signatureCropImage');
                        const sigCropBtn = document.getElementById('signatureCropButton');
                        const sigCancelBtn = document.getElementById('signatureCancelCrop');
                        const sigPreview = document.querySelector('.signature-preview');

                        // Convert mm to pixels (assuming 96 DPI)
                        const mmToPxh = 96 / 25.4;
                        const sigTargetWidth = 25 * mmToPxh; // 25mm in pixels
                        const sigTargetHeight = 30 * mmToPxh; // 30mm in pixels

                        sigInput.addEventListener('change', function(e) {
                            if (e.target.files && e.target.files.length) {
                                const file = e.target.files[0];

                                // Check if file is an image
                                if (!file.type.match('image.*')) {
                                    alert('Please select an image file for signature');
                                    sigInput.value = '';
                                    return;
                                }

                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    sigCropImg.src = event.target.result;
                                    sigCropModal.style.display = 'block';

                                    // Initialize cropper with 25:30 aspect ratio
                                    if (sigCropper) {
                                        sigCropper.destroy();
                                    }

                                    sigCropper = new Cropper(sigCropImg, {
                                        aspectRatio: 25 / 30, // 25mm width / 30mm height
                                        viewMode: 1,
                                        autoCropArea: 0.7,
                                        responsive: true,
                                        restore: false,
                                        guides: true,
                                        center: true,
                                        highlight: true,
                                        cropBoxMovable: true,
                                        cropBoxResizable: true,
                                        toggleDragModeOnDblclick: false,
                                        ready: function() {
                                            this.cropper.crop(); // Auto-crop on initialization
                                        }
                                    });
                                };
                                reader.onerror = function() {
                                    alert('Failed to load signature image');
                                    sigInput.value = '';
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        sigCropBtn.addEventListener('click', function(e) {
                            e.preventDefault();

                            if (!sigCropper) {
                                sigCropModal.style.display = 'none';
                                return;
                            }

                            // Get cropped canvas with exact dimensions (25mm × 30mm in pixels)
                            const sigCanvas = sigCropper.getCroppedCanvas({
                                width: sigTargetWidth,
                                height: sigTargetHeight,
                                minWidth: sigTargetWidth,
                                minHeight: sigTargetHeight,
                                maxWidth: sigTargetWidth,
                                maxHeight: sigTargetHeight,
                                fillColor: '#fff',
                                imageSmoothingEnabled: true,
                                imageSmoothingQuality: 'high'
                            });

                            if (!sigCanvas) {
                                alert('Signature cropping failed. Please try again.');
                                return;
                            }

                            // Convert canvas to blob
                            sigCanvas.toBlob(function(blob) {
                                if (!blob) {
                                    alert('Failed to create cropped signature');
                                    return;
                                }

                                // Create a new File from the blob
                                const fileName = sigInput.files[0].name;
                                const fileExt = fileName.split('.').pop().toLowerCase();
                                const mimeType = fileExt === 'png' ? 'image/png' : 'image/jpeg';

                                const file = new File([blob], fileName, {
                                    type: mimeType,
                                    lastModified: Date.now()
                                });

                                // Update file input
                                const sigDataTransfer = new DataTransfer();
                                sigDataTransfer.items.add(file);
                                sigInput.files = sigDataTransfer.files;

                                // Update preview
                                if (sigPreview) {
                                    sigPreview.src = URL.createObjectURL(blob);
                                }

                                // Clean up
                                sigCropModal.style.display = 'none';
                                sigCropper.destroy();
                                sigCropper = null;

                            }, 'image/jpeg', 0.9);
                        });

                        sigCancelBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            sigInput.value = '';
                            sigCropModal.style.display = 'none';
                            if (sigCropper) {
                                sigCropper.destroy();
                                sigCropper = null;
                            }
                        });
                    </script> -->
                    <div class="submit-button">
                        <button type="submit">Update</button>
                    </div>
                </form>


            </div>
        </div>

        <script src="script.js"></script>
        <script>
            $(".bod-picker").nepaliDatePicker({
                dateFormat: "%d %M, %y",
                closeOnDateSelect: true
            });

            $("#clear-bth").on("click", function(event) {
                $(".bod-picker").val('');
            });
        </script>
    </body>

    </html>
<?php

}
?>