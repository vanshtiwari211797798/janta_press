<?php
session_start();
include("DB.php");

$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['emp_name'])) {
        echo "
                <script>
                    alert('Employee name is required');
                </script>
            ";
    } elseif (empty($_POST['gender'])) {
        echo "
                <script>
                    alert('Gender is required');
                </script>
            ";
    } elseif (empty($_POST['dob'])) {
        echo "
                <script>
                    alert('DOB is required');
                </script>
            ";
    } elseif (empty($_POST['husband_or_father'])) {
        echo "
                <script>
                    alert('Husbend/Wife is required');
                </script>
            ";
    } elseif (empty($_POST['mother_name'])) {
        echo "
                <script>
                    alert('Mother name is required');
                </script>
            ";
    } elseif (empty($_POST['email'])) {
        echo "
                <script>
                    alert('Email is required');
                </script>
            ";
    } elseif (empty($_POST['contact'])) {
        echo "
                <script>
                    alert('Contact is required');
                </script>
            ";
    } elseif (empty($_POST['address'])) {
        echo "
                <script>
                    alert('Address is required');
                </script>
            ";
    } elseif (empty($_POST['rfid'])) {
        echo "
                <script>
                    alert('RFID is required');
                </script>
            ";
    } elseif (empty($_POST['designation'])) {
        echo "
                <script>
                    alert('Designation is required');
                </script>
            ";
    } elseif (empty($_POST['category'])) {
        echo "
                <script>
                    alert('Category is required');
                </script>
            ";
    } elseif (empty($_POST['remark'])) {
        echo "
                <script>
                    alert('Remark is required');
                </script>
            ";
    } elseif (empty($_FILES['photo']['name'])) {
        echo "
                <script>
                    alert('Employee photo is required');
                </script>
            ";
    } else {
        $school_id = $_POST['school_id'];
        $emp_name = $_POST['emp_name'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $husband_or_father = $_POST['husband_or_father'];
        $mother_name = $_POST['mother_name'];
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $rfid = $_POST['rfid'];
        $designation = $_POST['designation'];
        $category = $_POST['category'];
        $remark = $_POST['remark'];
        $fileName = $_FILES['photo']['name'];
        $file_tmp_name = $_FILES['photo']['tmp_name'];
        $ep_fetch = "SELECT * FROM employee WHERE email='$email'";
        $data = mysqli_query($conn, $ep_fetch);
        if (mysqli_num_rows($data) == 0) {
            move_uploaded_file($file_tmp_name, "employee_photo/$fileName");
            $sql = "INSERT INTO employee (school_id, emp_name, gender, dob, husband_or_father, mother_name, email, contact, address, rfid, designation, category, remark, photo) 
            VALUES ('$school_id','$emp_name', '$gender', '$dob', '$husband_or_father', '$mother_name', '$email', '$contact', '$address', '$rfid', '$designation', '$category', '$remark', '$fileName')";

            if (mysqli_query($conn, $sql)) {
                echo "
                <script>
                    alert('Employee added successfully');
                </script>
            ";
            }
        } else {
            echo "
            <script>
                alert('Employee allready added');
            </script>
        ";
        }
    }
}
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
                    <div class="form-group">
                        <label for="school_id">School Id</label>
                        <input type="text" id="school_id" name="school_id" placeholder="Enter School Id" value="<?= $schoolId ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="employeeName">Employee Name<span style="color: red;">*</span></label>
                        <input type="text" id="employeeName" name="emp_name" placeholder="Employee Name">
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
                        <label for="fatherName">Husband/Father Name</label>
                        <input type="text" id="fatherName" placeholder="Husbend/Father" name="husband_or_father">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="motherName">Mother Name</label>
                        <input type="text" id="motherName" placeholder="Mother Name" name="mother_name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address<span style="color: red;">*</span></label>
                        <input type="email" placeholder="Mother Name" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact No</label>
                        <input type="tel" id="contact" placeholder="Contact Number" name="contact">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" placeholder="Address" name="address">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="rfid">RFID No</label>
                        <input type="text" id="rfid" name="rfid" placeholder="RFID Number">
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <select id="designation" name="designation">
                            <option value="">Select</option>
                            <option value="Teaching">Teaching</option>
                            <option value="nonTeaching">Non-Teaching</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <input type="text" id="categories" name="category" placeholder="Enter Category">
                    </div>
                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <input type="text" id="remark" name="remark" placeholder="Remark">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="employeePhoto">Employee Photo</label>
                        <input type="file" id="employeePhoto" name="photo">
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit">Submit</button>
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