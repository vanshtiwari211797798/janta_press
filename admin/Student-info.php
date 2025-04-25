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
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
    <!-- this should go after your </body> -->
    <script src="//code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
    <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">
    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'ne',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                },
                'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script type="text/javascript">
        function setNepaliLanguage() {
            var select = document.querySelector("select.goog-te-combo");
            if (select) {
                select.value = "ne";
                select.dispatchEvent(new Event("change"));
            } else {
                setTimeout(setNepaliLanguage, 1000);
            }
        }
        setTimeout(setNepaliLanguage, 3000);
    </script>
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
        if (empty($_POST['school_id'])) {
            echo "
            <script>
                alert('School Id is required');
            </script>
        ";
        } elseif (empty($_POST['name'])) {
            echo "
                <script>
                    alert('Name is required');
                </script>
            ";
        } elseif (empty($_POST['class'])) {
            echo "
            <script>
                alert('class is required');
            </script>
        ";
        } elseif (empty($_POST['gender'])) {
            echo "
            <script>
                alert('Gender is required');
            </script>
        ";
        } elseif (empty($_POST['father_name'])) {
            echo "
            <script>
                alert('Father name is required');
            </script>
        ";
        } else {
            $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $class = $_POST['class'];
            $section = $_POST['section'];
            $category = $_POST['category'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];

            $roll_number = $_POST['roll_number'];
            $father_name = $_POST['father_name'];
            $father_contact = $_POST['father_contact'];
            $mother_name = $_POST['mother_name'];
            $mother_contact = $_POST['mother_contact'];
            $blood_grp = $_POST['blood_grp'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $photoName = $_FILES['photo']['name'];
            $photo_tmp_name = $_FILES['photo']['tmp_name'];
            $rf_id = $_POST['rf_id'];
            $sms = $_POST['sms'];
            $android_password = $_POST['android_password'];
            $remark = $_POST['remark'];
            $data = "SELECT * FROM students WHERE school_id='$school_id' AND roll_number='$roll_number' AND class='$class' AND section='$section'";
            $res = mysqli_query($conn, $data);
            if (mysqli_num_rows($res) > 0) {
                echo "
                <script>
                    alert('Student allready exist');
                </script>
            ";
            } else {
                move_uploaded_file($photo_tmp_name, "Students_photo/$photoName");
                $sql = "INSERT INTO students (school_id,name,class,section,category,gender,dob,roll_number,father_name,father_contact,mother_name,mother_contact,blood_grp,city,address,photo,rf_id,sms,android_password,remark) VALUES ('$school_id','$name','$class','$section','$category','$gender','$dob','$roll_number','$father_name','$father_contact','$mother_name','$mother_contact','$blood_grp','$city','$address','$photoName','$rf_id','$sms','$android_password','$remark')";
                if (mysqli_query($conn, $sql)) {
                    echo "
                    <script>
                        alert('Student Created Successfully');
                    </script>
                ";
                }
            }
        }
    }
    ?>
    <div id="google_translate_element"></div>
    <div id="nav">
        <a href='Dashboard.php'><img id="logo" src="janta_logo.jpeg" alt=""></a>
        <a href="logout.php">
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
            </div>


        </div>


        <div class="main" style="padding: 20px;">
            <h2>Add Student</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="school_id">School Id</label>
                    <input type="text" id="school_id" name="school_id" placeholder="Enter School Id" value="<?= $school_id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" id="studentName" name="name" placeholder="Enter Student Name">
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <select id="class" name="class">
                        <option value="">Select Class</option>
                        <?php
                        $fetchClass = "SELECT * FROM addclass WHERE school_id='$school_id'";
                        $classData = mysqli_query($conn, $fetchClass);
                        if (mysqli_num_rows($classData) > 0) {
                            while ($resClass = mysqli_fetch_assoc($classData)) {


                        ?>
                                <option value="<?= $resClass['class'] ?>"><?= $resClass['class'] ?></option>

                        <?php

                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select id="class" name="section">
                        <option value="">Select Section</option>
                        <?php
                        $fetchClass = "SELECT * FROM addsection WHERE school_id='$school_id'";
                        $classData = mysqli_query($conn, $fetchClass);
                        if (mysqli_num_rows($classData) > 0) {
                            while ($resClass = mysqli_fetch_assoc($classData)) {


                        ?>
                                <option value="<?= $resClass['section'] ?>"><?= $resClass['section'] ?></option>

                        <?php

                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="studentCategory">Student Category</label>
                    <select id="studentCategory" name="category">
                        <option value="">Select</option>
                        <option value="General">General</option>
                        <option value="OBC">OBC</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Student DOB</label>
                    <input type="text" id="myDate" name="dob" placeholder="YYYY-MM-DD" maxlength="10" />
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
                    <input type="text" name="roll_number" id="rollNumber" placeholder="Enter Roll Number">
                </div>
                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" id="fatherName" name="father_name" placeholder="Enter Father's Name">
                </div>
                <div class="form-group">
                    <label for="fatherContact">Father Contact</label>
                    <input type="text" name="father_contact" id="fatherContact" placeholder="Enter Contact">
                </div>
                <div class="form-group">
                    <label for="motherName">Mother Name</label>
                    <input type="text" name="mother_name" id="motherName" placeholder="Enter Mother's Name">
                </div>
                <div class="form-group">
                    <label for="motherContact">Mother Contact</label>
                    <input type="text" name="mother_contact" id="motherContact" placeholder="Enter Contact">
                </div>
                <div class="form-group">
                    <label for="bloodGroup">Blood Group</label>
                    <input type="text" name="blood_grp" id="bloodGroup" placeholder="Enter Blood Group">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" placeholder="Enter City">
                </div>
                <div class="form-group">
                    <label for="address">Student Address</label>
                    <textarea id="address" name="address" rows="2" placeholder="Enter Address"></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Student Photo</label>
                    <input type="file" id="photo" name="photo">
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
                    <input type="text" name="rf_id" id="rfId" placeholder="Enter RF ID Number">
                </div>
                <div class="form-group">
                    <label for="webSms">Web SMS</label>
                    <select id="webSms" name="sms">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Android Password</label>
                    <input type="password" name="android_password" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <textarea id="remark" rows="2" name="remark" placeholder="Enter Remark"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <!-- <script>
        $(".bod-picker").nepaliDatePicker({
            dateFormat: "%d %M, %y",
            closeOnDateSelect: true
        });

        $("#clear-bth").on("click", function(event) {
            $(".bod-picker").val('');
        });
    </script> -->
</body>

</html>