<?php
session_start();
ob_start();
$school_id = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="style.css">
    <!-- this should go after your </body> -->
    <script src="//code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
    <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">
    <!-- Cropper.js CSS -->
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

        .form-group {
            flex: 1 1 calc(25% - 10px);
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group input[type="file"] {
            padding: 3px;
        }

        .form-group img {
            margin-top: 10px;
            width: 50px;
            height: 50px;
        }

        .form-actions {
            flex: 1 1 100%;
            text-align: center;
            margin-top: 20px;
        }

        .form-actions button {
            padding: 10px 20px;
            border: none;
            background-color: #004d40;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .form-actions button:hover {
            background-color: #00796b;
        }
    </style>
</head>

<body>

    <?php
    include('DB.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['name'])) {
            echo "
                <script>
                    alert('Name is required');
                </script>
            ";
        }  else {
            $uid = mysqli_real_escape_string($conn, $_POST['uid']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);
            $section = mysqli_real_escape_string($conn, $_POST['section']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $dob = mysqli_real_escape_string($conn, $_POST['dob']);
            $roll_number = mysqli_real_escape_string($conn, $_POST['roll_number']);
            $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
            $father_contact = mysqli_real_escape_string($conn, $_POST['father_contact']);
            $mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);
            $mother_contact = mysqli_real_escape_string($conn, $_POST['mother_contact']);
            $blood_grp = mysqli_real_escape_string($conn, $_POST['blood_grp']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $rf_id = mysqli_real_escape_string($conn, $_POST['rf_id']);
            $sms = mysqli_real_escape_string($conn, $_POST['sms']);
            $android_password = mysqli_real_escape_string($conn, $_POST['android_password']);
            $remark = mysqli_real_escape_string($conn, $_POST['remark']);

            // Photo upload handling
            if (empty($_FILES['photo']['name'])) {
                $fileName = mysqli_real_escape_string($conn, $_POST['old_img']);
            } else {
                $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension; // Unique file name
                $file_Tmp_Name = $_FILES['photo']['tmp_name'];
                move_uploaded_file($file_Tmp_Name, "Students_photo/$fileName");
            }

            // Update Query
            $sql = "UPDATE students SET 
                name='$name',
                class='$class',
                section='$section',
                category='$category',
                gender='$gender',
                dob='$dob',
                roll_number='$roll_number',
                father_name='$father_name',
                father_contact='$father_contact',
                mother_name='$mother_name',
                mother_contact='$mother_contact',
                blood_grp='$blood_grp',
                city='$city',
                address='$address',
                photo='$fileName',
                rf_id='$rf_id',
                sms='$sms',
                android_password='$android_password',
                remark='$remark'
            WHERE id='$uid'";

            if (mysqli_query($conn, $sql)) {
                echo "
                    <script>
                        alert('Student Updated Successfully');
                        window.location.href='view-student.php';
                    </script>
                ";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }


    // fetch data based on the id
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM students WHERE id=$id";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            $rec = mysqli_fetch_assoc($data);
        }
    }

    ?>

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
            <h2>Update Student</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $rec['id'] ?>" name="uid">
                <input type="hidden" value="<?= $rec['photo'] ?>" name="old_img">
                <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" id="studentName" name="name" value="<?= $rec['name'] ?>" placeholder="Enter Student Name">
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <select id="class" name="class">
                        <option value="">Select Class</option>
                        <?php
                        $fetchClass = "SELECT * FROM addclass WHERE school_id='$school_id'";
                        $classData = mysqli_query($conn, $fetchClass);
                        while ($classRes = mysqli_fetch_assoc($classData)) {


                        ?>
                            <option value="<?= $classRes['class'] ?>" <?= $rec['class'] == $classRes['class'] ? 'selected' : '' ?>><?= $classRes['class'] ?></option>
                        <?php

                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select id="class" name="section">
                        <option value="">Select section</option>
                        <?php
                        $fetchClass = "SELECT * FROM addsection WHERE school_id='$school_id'";
                        $classData = mysqli_query($conn, $fetchClass);
                        while ($classRes = mysqli_fetch_assoc($classData)) {


                        ?>
                            <option value="<?= $classRes['section'] ?>" <?= $rec['section'] == $classRes['section'] ? 'selected' : '' ?>><?= $classRes['section'] ?></option>
                        <?php

                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="studentCategory">Student Category</label>
                    <select id="studentCategory" name="category">
                        <option class="">Select</option>
                        <option value="General" <?= $rec['category'] == 'General' ? 'selected' : '' ?>>General</option>
                        <option value="OBC" <?= $rec['category'] == 'OBC' ? 'selected' : '' ?>>OBC</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male" <?= $rec['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $rec['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="myDate">Student DOB</label>
                    <input type="text" value="<?= $rec['dob'] ?>" name="dob" id="myDate" class="bod-picker" placeholder="Select Date of Birth">
                </div>
                <script>
                    const dateInput = document.getElementById("myDate");

                    dateInput.addEventListener("input", function(e) {
                        let value = this.value.replace(/[^0-9]/g, ""); // Remove non-numeric
                        if (value.length > 4) {
                            value = value.slice(0, 4) + "-" + value.slice(4);
                        }
                        if (value.length > 7) {
                            value = value.slice(0, 7) + "-" + value.slice(7, 10);
                        }
                        this.value = value;
                    });
                </script>

                <div class="form-group">
                    <label for="rollNumber">Student Roll Number</label>
                    <input type="text" name="roll_number" value="<?= $rec['roll_number'] ?>" id="rollNumber" placeholder="Enter Roll Number">
                </div>
                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" id="fatherName" name="father_name" value="<?= $rec['father_name'] ?>" placeholder="Enter Father's Name">
                </div>
                <div class="form-group">
                    <label for="fatherContact">Father Contact</label>
                    <input type="text" name="father_contact" id="fatherContact" value="<?= $rec['father_contact'] ?>" placeholder="Enter Contact">
                </div>
                <div class="form-group">
                    <label for="motherName">Mother Name</label>
                    <input type="text" name="mother_name" id="motherName" value="<?= $rec['mother_name'] ?>" placeholder="Enter Mother's Name">
                </div>
                <div class="form-group">
                    <label for="motherContact">Mother Contact</label>
                    <input type="text" name="mother_contact" value="<?= $rec['mother_contact'] ?>" id="motherContact" placeholder="Enter Contact">
                </div>
                <div class="form-group">
                    <label for="bloodGroup">Blood Group</label>
                    <input type="text" name="blood_grp" value="<?= $rec['blood_grp'] ?>" id="bloodGroup" placeholder="Enter Blood Group">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" value="<?= $rec['city'] ?>" placeholder="Enter City">
                </div>
                <div class="form-group">
                    <label for="address">Student Address</label>
                    <textarea id="address" name="address" rows="2" placeholder="Enter Address"><?= $rec['address'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Student Photo</label>
                    <input type="file" id="photo" name="photo">
                    <img src="Students_photo/<?= $rec['photo'] ?>" alt="student photo">
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
                    // Initialize cropper
                    let cropper;
                    const photoInput = document.getElementById('photo');
                    const cropModal = document.getElementById('cropModal');
                    const cropImage = document.getElementById('cropImage');
                    const cropButton = document.getElementById('cropButton');
                    const cancelCrop = document.getElementById('cancelCrop');

                    photoInput.addEventListener('change', function(e) {
                        if (e.target.files.length) {
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                cropImage.src = event.target.result;
                                cropModal.style.display = 'block';

                                // Initialize cropper
                                cropper = new Cropper(cropImage, {
                                    aspectRatio: 1, // Square aspect ratio
                                    viewMode: 1,
                                    autoCropArea: 0.8
                                });
                            };
                            reader.readAsDataURL(e.target.files[0]);
                        }
                    });

                    cropButton.addEventListener('click', function(e) {
                        e.preventDefault(); // Prevent form submission

                        // Get the cropped canvas
                        const canvas = cropper.getCroppedCanvas({
                            width: 300, // Desired width
                            height: 300, // Desired height
                            minWidth: 256,
                            minHeight: 256,
                            maxWidth: 4096,
                            maxHeight: 4096,
                            fillColor: '#fff',
                            imageSmoothingEnabled: true,
                            imageSmoothingQuality: 'high'
                        });

                        // Convert canvas to blob
                        canvas.toBlob(function(blob) {
                            // Create a new File from the blob
                            const file = new File([blob], photoInput.files[0].name, {
                                type: 'image/jpeg',
                                lastModified: Date.now()
                            });

                            // Create a new DataTransfer and add the file
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);

                            // Assign the DataTransfer files list to the file input
                            photoInput.files = dataTransfer.files;

                            // Hide the modal
                            cropModal.style.display = 'none';

                            // Destroy the cropper
                            cropper.destroy();
                        }, 'image/jpeg', 0.9); // 0.9 is the quality (0 to 1)
                    });

                    cancelCrop.addEventListener('click', function(e) {
                        e.preventDefault(); // Prevent form submission

                        // Clear the file input
                        photoInput.value = '';

                        // Hide the modal
                        cropModal.style.display = 'none';

                        // Destroy the cropper if it exists
                        if (cropper) {
                            cropper.destroy();
                        }
                    });
                </script>
                <div class="form-group">
                    <label for="rfId">Add RF ID Number</label>
                    <input type="text" name="rf_id" id="rfId" value="<?= $rec['rf_id'] ?>" placeholder="Enter RF ID Number">
                </div>
                <div class="form-group">
                    <label for="webSms">Web SMS</label>
                    <select id="webSms" name="sms">
                        <option value="Yes" <?= $rec['sms'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                        <option value="No" <?= $rec['sms'] == 'No' ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Android Password</label>
                    <input type="password" name="android_password" value="<?= $rec['android_password'] ?>" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <textarea id="remark" rows="2" name="remark" placeholder="Enter Remark"><?= $rec['remark'] ?></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>