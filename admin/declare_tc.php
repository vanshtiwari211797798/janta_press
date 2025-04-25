<?php
include('DB.php');
session_start();
ob_start();


if (!isset($_GET['id'])) {
    echo "
    <script>
        window.location.href='requested_tc.php';
    </script>
";
}
$school_id = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['school_id'])) {
        echo "
            <script>
                alert('School id is required');
            </script>
        ";
    } elseif (empty($_POST['school_name'])) {
        echo "
        <script>
            alert('School Name is required');
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
            alert('Class is required');
        </script>
    ";
    } elseif (empty($_POST['section'])) {
        echo "
        <script>
            alert('Section is required');
        </script>
    ";
    } elseif (empty($_POST['dob'])) {
        echo "
        <script>
            alert('DOB is required');
        </script>
    ";
    } elseif (empty($_POST['roll_number'])) {
        echo "
        <script>
            alert('Roll Number is required');
        </script>
    ";
    } elseif (empty($_POST['father_name'])) {
        echo "
        <script>
            alert('Father Name is required');
        </script>
    ";
    } elseif (empty($_POST['mother_name'])) {
        echo "
        <script>
            alert('Mother Name is required');
        </script>
    ";
    } elseif (empty($_POST['date_of_admission'])) {
        echo "
        <script>
            alert('Admission Date is required');
        </script>
    ";
    } elseif (empty($_POST['date_of_leave'])) {
        echo "
        <script>
            alert('Date of leave is required');
        </script>
    ";
    } elseif (empty($_POST['reason_for_leaving'])) {
        echo "
        <script>
            alert('Leaving Reason is required');
        </script>
    ";
    } elseif (empty($_POST['behaviour'])) {
        echo "
        <script>
            alert('Behaviour is required');
        </script>
    ";
    } elseif (empty($_POST['issued_by'])) {
        echo "
        <script>
            alert('Issued By is required');
        </script>
    ";
    } elseif (empty($_POST['date_of_tc_issue'])) {
        echo "
        <script>
            alert('Tc issue is required');
        </script>
    ";
    } elseif (empty($_FILES['seal_signature']['name'])) {
        echo "
        <script>
            alert('Seal or Signature is required');
        </script>
    ";
    } else {
        $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
        $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $section = mysqli_real_escape_string($conn, $_POST['section']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $roll_number = mysqli_real_escape_string($conn, $_POST['roll_number']);
        $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
        $mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);
        $date_of_admission = mysqli_real_escape_string($conn, $_POST['date_of_admission']);
        $date_of_leave = mysqli_real_escape_string($conn, $_POST['date_of_leave']);
        $reason_for_leaving = mysqli_real_escape_string($conn, $_POST['reason_for_leaving']);
        $behaviour = mysqli_real_escape_string($conn, $_POST['behaviour']);
        $issued_by = mysqli_real_escape_string($conn, $_POST['issued_by']);
        $date_of_tc_issue = mysqli_real_escape_string($conn, $_POST['date_of_tc_issue']);
        $seal_signatureName = mysqli_real_escape_string($conn, $_FILES['seal_signature']['name']);
        $seal_signatureTmpName = $_FILES['seal_signature']['tmp_name'];

        move_uploaded_file($seal_signatureTmpName, "tc_seal_signature/$seal_signatureName");

        // Inserting the data into the database
        $sql = "INSERT INTO declared_tc (school_id, school_name, name, class, section, dob, roll_number, father_name, mother_name, date_of_admission, date_of_leave, reason_for_leaving, behaviour, issued_by, date_of_tc_issue, seal_signature) 
VALUES ('$school_id', '$school_name', '$name', '$class', '$section', '$dob', '$roll_number', '$father_name', '$mother_name', '$date_of_admission', '$date_of_leave', '$reason_for_leaving', '$behaviour', '$issued_by', '$date_of_tc_issue', '$seal_signatureName')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            echo "
                <script>
                    alert('Tc Declared successfully');
                    window.location.href='tc_management.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('Somethings went wrong');
                history.back();
            </sccript>
        ";
        }
    }
}


// getting the data based on the id

$fetchRequestedTc = "SELECT * FROM request_tc WHERE id=$id";
$tcData = mysqli_query($conn, $fetchRequestedTc);
if (mysqli_num_rows($tcData) > 0) {
    $recordTc = mysqli_fetch_assoc($tcData);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declare Student Tc</title>
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
                <!-- <a href="Dashboard.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'CreditDetail')">Log Out</a> -->
            </div>


        </div>


        <div class="main" style="padding: 20px;">
            <h2>Declare TC</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="school_id">School Id</label>
                    <input type="text" id="school_id" name="school_id" placeholder="Enter School Id" value="<?= $school_id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="school_id">School Name</label>
                    <input type="text" id="school_name" value="<?= $recordTc['school_name'] ?>" name="school_name" placeholder="Enter School Name">
                </div>
                <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" id="studentName" value="<?= $recordTc['name'] ?>" name="name" placeholder="Enter Student Name">
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <select id="class" name="class">
                        <option value="">Select Class</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = ($recordTc['class'] == $i) ? 'selected' : '';
                            echo "<option value=\"$i\" $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select id="section" name="section">
                        <option value="">Select</option>
                        <?php
                        $sections = ['A', 'B', 'C', 'D', 'E', 'F'];
                        foreach ($sections as $section) {
                            $selected = ($recordTc['section'] == $section) ? 'selected' : '';
                            echo "<option value=\"$section\" $selected>$section</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Student DOB</label>
                    <input type="text" name="dob" id="dob" class="bod-picker" placeholder="Select DOB" value="<?= $recordTc['dob'] ?>">
                </div>
                <div class="form-group">
                    <label for="rollNumber">Student Roll Number</label>
                    <input type="text" name="roll_number" id="rollNumber" value="<?= $recordTc['roll_number'] ?>" placeholder="Enter Roll Number">
                </div>
                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" id="fatherName" name="father_name" value="<?= $recordTc['father_name'] ?>" placeholder="Enter Father's Name">
                </div>
                <div class="form-group">
                    <label for="mothername">Mother Name</label>
                    <input type="text" id="mothername" name="mother_name" value="<?= $recordTc['mother_name'] ?>" placeholder="Enter Mother's Name">
                </div>
                <div class="form-group">
                    <label for="date_of_admission">Date of Admission</label>
                    <input type="text" name="date_of_admission" id="date_of_admission" class="bod-picker" placeholder="Admission Date">
                </div>
                <div class="form-group">
                    <label for="date_of_admission">Date of Leave</label>
                    <input type="text" name="date_of_leave" id="date_of_leave" class="bod-picker" placeholder="Select leave date">
                </div>
                <div class="form-group">
                    <label for="reason_for_leaving">Reason for Leaving</label>
                    <input type="text" id="reason_for_leaving" name="reason_for_leaving" placeholder="Enter Leaving Reason">
                </div>
                <div class="form-group">
                    <label for="behaviour">Behaviour of student</label>
                    <input type="text" id="behaviour" name="behaviour" placeholder="Enter Student Behaviour">
                </div>
                <div class="form-group">
                    <label for="issued_by">Issued by</label>
                    <input type="text" id="issued_by" name="issued_by" placeholder="Issued by">
                </div>
                <div class="form-group">
                    <label for="date_of_tc_issue">Date of TC Issue</label>
                    <input type="text" id="date_of_tc_issue" name="date_of_tc_issue" class="bod-picker" placeholder="Tc issue date">
                </div>
                <div class="form-group">
                    <label for="seal_signature">School Seal/Signature</label>
                    <input type="file" id="seal_signature" name="seal_signature">
                </div>
                <div class="form-actions">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        $(".bod-picker").nepaliDatePicker({
            dateFormat: "%D, %M %d, %y",
            closeOnDateSelect: true
        });

        $("#clear-bth").on("click", function(event) {
            $(".bod-picker").val('');
        });
    </script>
</body>

</html>