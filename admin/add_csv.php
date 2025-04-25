<?php
session_start();
include("DB.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add CSV</title>
    <link rel="stylesheet" href="style.css">
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
        if (empty($_POST['std_id'])) {
            echo "
                <script>
                    alert('Student id is required');
                </script>
            ";
        } elseif (empty($_POST['std_name'])) {
            echo "
            <script>
                alert('Student Name is required');
            </script>
        ";
        } elseif (empty($_POST['roll_number'])) {
            echo "
            <script>
                alert('Roll no is required');
            </script>
        ";
        } elseif (empty($_POST['father_name'])) {
            echo "
            <script>
                alert('Father name is required');
            </script>
        ";
        } elseif (empty($_POST['mother_name'])) {
            echo "
            <script>
                alert('Mother name is required');
            </script>
        ";
        } elseif (empty($_POST['dob'])) {
            echo "
            <script>
                alert('DOB is required');
            </script>
        ";
        } else {
            $std_id = mysqli_real_escape_string($conn, $_POST['std_id']);
            $std_name = $_POST['std_name'];
            $std_class = $_POST['std_class'];
            // $roll_number = $_POST['roll_number'];
            $father_name = $_POST['father_name'];
            $mother_name = $_POST['mother_name'];
            // $phone = $_POST['phone'];
            // $address = $_POST['address'];
            $dob = $_POST['dob'];
            // $blood_grp = $_POST['blood_grp'];
            $sql = "INSERT INTO csv_details (std_id,std_name,std_class,father_name,mother_name,dob) VALUES ('$std_id','$std_name','$std_class','$father_name','$mother_name','$dob')";
            if (mysqli_query($conn, $sql)) {
                echo "
                    <script>
                        alert('Student Created Successfully');
                    </script>
                ";
            }
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
            <h2>Add CSV</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="studentid">Student Id</label>
                    <input type="number" id="studentid" name="std_id" placeholder="Enter Student Id">
                </div>
                <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" id="studentName" name="std_name" placeholder="Enter Student Name">
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <select id="class" name="std_class">
                        <option value="">Select Class</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <label for="section">Section</label>
                    <select id="section" name="section">
                        <option value="">Select</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                    </select>
                </div> -->
                <!-- <div class="form-group">
                    <label for="studentCategory">Student Category</label>
                    <select id="studentCategory" name="category">
                        <option value="">Select</option>
                        <option value="General">General</option>
                        <option value="OBC">OBC</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                    </select>
                </div> -->
                <!-- <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div> -->
                <div class="form-group">
                    <label for="rollNumber">Student Roll Number</label>
                    <input type="text" name="roll_number" id="rollNumber" placeholder="Enter Roll Number">
                </div>
                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" id="fatherName" name="father_name" placeholder="Enter Father's Name">
                </div>
                <div class="form-group">
                    <label for="motherName">Mother Name</label>
                    <input type="text" name="mother_name" id="motherName" placeholder="Enter Mother's Name">
                </div>
                <div class="form-group">
                    <label for="fatherContact">Contact</label>
                    <input type="text" name="phone" id="fatherContact" placeholder="Enter Contact">
                </div>
                <!-- <div class="form-group">
                    <label for="motherContact">Mother Contact</label>
                    <input type="text" name="mother_contact" id="motherContact" placeholder="Enter Contact">
                </div> -->
                <div class="form-group">
                    <label for="dob">Student DOB</label>
                    <input type="date" name="dob" id="dob">
                </div>
                <div class="form-group">
                    <label for="bloodGroup">Blood Group</label>
                    <input type="text" name="blood_grp" id="bloodGroup" placeholder="Enter Blood Group">
                </div>
                <!-- <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" placeholder="Enter City">
                </div> -->
                <div class="form-group">
                    <label for="address">Student Address</label>
                    <textarea id="address" name="address" rows="2" placeholder="Enter Address"></textarea>
                </div>
                <!-- <div class="form-group">
                    <label for="photo">Student Photo</label>
                    <input type="file" id="photo" name="photo">
                </div>
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
                </div> -->
                <div class="form-actions">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>