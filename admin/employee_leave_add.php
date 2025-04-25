<?php
session_start();
include("DB.php");

$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        echo "
                <script>
                    alert('Employee name is required');
                </script>
            ";
    } elseif (empty($_POST['contact'])) {
        echo "
            <script>
                alert('Contact is required');
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
    } elseif (empty($_POST['leave_from'])) {
        echo "
            <script>
                alert('Leave from is required');
            </script>
        ";
    } elseif (empty($_POST['leave_to'])) {
        echo "
            <script>
                alert('Leave To is required');
            </script>
        ";
    } elseif (empty($_POST['approved_by'])) {
        echo "
            <script>
                alert('Approved By is required');
            </script>
        ";
    } elseif (empty($_FILES['application_photo']['name'])) {
        echo "
            <script>
                alert('Application image is required');
            </script>
        ";
    } elseif (empty($_POST['total_leave_days'])) {
        echo "
            <script>
                alert('Total leave days is required');
            </script>
        ";
    } elseif (empty($_POST['reason'])) {
        echo "
            <script>
                alert('Reason is required');
            </script>
        ";
    } else {
        $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $rfid = mysqli_real_escape_string($conn, $_POST['rfid']);
        $designation = mysqli_real_escape_string($conn, $_POST['designation']);
        $leave_from = mysqli_real_escape_string($conn, $_POST['leave_from']);
        $leave_to = mysqli_real_escape_string($conn, $_POST['leave_to']);
        $approved_by = mysqli_real_escape_string($conn, $_POST['approved_by']);
        $total_leave_days = mysqli_real_escape_string($conn, $_POST['total_leave_days']);
        $total_sunday = mysqli_real_escape_string($conn, $_POST['total_sunday']);
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);
        // $fileName = mysqli_real_escape_string($conn, $_FILES['application_photo']['name']);
        // $fileTmp_name = mysqli_real_escape_string($conn, $_FILES['application_photo']['tmp_name']);
        $fileName = $_FILES['application_photo']['name'];
        $fileTmp_name = $_FILES['application_photo']['tmp_name'];
        move_uploaded_file($fileTmp_name, "Leave_Application/$fileName");
        $sql = "INSERT INTO employee_leave (school_id, name, contact, rfid, designation, leave_from, leave_to, approved_by, application_photo, total_leave_days, total_sunday, reason) 
                VALUES ('$school_id','$name', '$contact', '$rfid', '$designation', '$leave_from', '$leave_to', '$approved_by', '$fileName', '$total_leave_days', '$total_sunday', '$reason')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Leave application submitted successfully');
                    window.location.href='Leave-management.php';
            </script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee Leave</title>
    <link rel="stylesheet" href="style.css">
    <!-- this should go after your </body> -->
    <script src="//code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
    <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            width: 100%;
        }



        .main {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 0 0 48%;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="file"] {
            padding: 3px;
        }

        .form-group input[type="date"] {
            font-size: 14px;
        }

        .form-group textarea {
            resize: none;
            height: 80px;
        }

        .form-actions {
            text-align: center;
        }

        .form-actions button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-actions button:hover {
            background-color: #0056b3;
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

        <div class="main">
            <h2>Employee Leave Form</h2>
            <form style="width: 1120px;" method="post" enctype="multipart/form-data">
                <!-- Row 1 -->
                <!-- <div class="form-row">
                    <div class="form-group">
                        <label for="search-student">Search Student</label>
                        <select id="search-student" name="search-student">
                            <option value="" disabled selected>Select student</option>
                            <option value="student1">Student 1</option>
                            <option value="student2">Student 2</option>
                        </select>
                    </div>
                    div.form-grp
                </div> -->

                <!-- Row 2 -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="school_id">School Id</label>
                        <input type="text" id="school_id" name="school_id" placeholder="Enter School Id" value="<?= $schoolId ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="student-name">Employee Name</label>
                        <input type="text" id="student-name" name="name" placeholder="Employee Name">
                    </div>
                    <div class="form-group">
                        <label for="class">Contact</label>
                        <input type="tel" id="contact" name="contact" placeholder="contact">
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="student-roll">RFID Number</label>
                        <input type="text" id="student-roll" name="rfid" placeholder="RFID Number">
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <select id="designation" name="designation">
                            <option value="">Select</option>
                            <option value="Teaching">Teaching</option>
                            <option value="nonTeaching">Non-Teaching</option>
                        </select>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="leave-from">Leave From</label>
                        <input type="text" id="leave-from" style="cursor: pointer;" name="leave_from" class="bod-picker" placeholder="Select leave from date">
                    </div>
                    <div class="form-group">
                        <label for="leave-to">Leave To</label>
                        <input type="text" id="leave-to" style="cursor: pointer;" name="leave_to" class="bod-picker" placeholder="Select leave to date">
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="approved-by">Approved By</label>
                        <input type="text" id="approved-by" name="approved_by" placeholder="Approved By">
                    </div>
                    <div class="form-group">
                        <label for="application">Upload Application Image</label>
                        <input type="file" id="application" name="application_photo">
                    </div>
                </div>

                <!-- Row 6 -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="total-leave">Total Leave Days</label>
                        <input type="text" id="total-leave" name="total_leave_days" placeholder="Total leave days">
                    </div>
                    <div class="form-group">
                        <label for="total-sunday">Total Sundays</label>
                        <input type="text" id="total-sunday" name="total_sunday" placeholder="Total Sundays">
                    </div>
                </div>

                <!-- Row 7 -->
                <div class="form-row">
                    <div class="form-group" style="flex: 0 0 100%;">
                        <label for="reason">Reason</label>
                        <textarea id="reason" name="reason" placeholder="Reason"></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
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