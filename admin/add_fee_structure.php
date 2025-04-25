<?php
session_start();

$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
include("DB.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['school_id'])) {
        echo "
                <script>
                    alert('School id is required');
                </script>
            ";
    } elseif (empty($_POST['class_fee'])) {
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
    } elseif (empty($_POST['fee'])) {
        echo "
            <script>
                alert('Holiday for is required');
            </script>
        ";
    }  elseif (empty($_POST['account_number'])) {
        echo "
            <script>
                alert('Account Number is required');
            </script>
        ";
    }
    elseif (empty($_POST['ifsc_code'])) {
        echo "
            <script>
                alert('IFSC Code is required');
            </script>
        ";
    }
    elseif (empty($_POST['bank_name'])) {
        echo "
            <script>
                alert('Bank Name is required');
            </script>
        ";
    }
    elseif (empty($_FILES['qr_code']['name'])) {
        echo "
            <script>
                alert('QR image is required');
            </script>
        ";
    } else {
        $school_id = $_POST['school_id'];
        $class_fee = $_POST['class_fee'];
        $section = $_POST['section'];
        $fee = $_POST['fee'];
        $account_number = $_POST['account_number'];
        $ifsc_code = $_POST['ifsc_code'];
        $bank_name = $_POST['bank_name'];
        $qr_codeName = $_FILES['qr_code']['name'];
        $qr_codeTmpName = $_FILES['qr_code']['tmp_name'];
        move_uploaded_file($qr_codeTmpName, "qr_code/$qr_codeName");
        $sql = "INSERT INTO fee_structure (school_id, class_fee,section,fee,account_number,ifsc_code,bank_name,qr_code) VALUES ('$school_id','$class_fee','$section','$fee','$account_number','$ifsc_code','$bank_name','$qr_codeName')";
        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
                alert('Fee Structure Added Successfully');
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
    <title>Add Fee Structure</title>
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

        table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;

        }

        thead {
            background-color: #3b5998;
            color: white;
        }

        th,
        td {
            border: 1px solid #ddd;
            text-align: start;
            padding: 6px;
            width: 190px;
        }

        th {
            font-size: 13px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
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


            <div class="main" style="padding: 20px;">
                <h2>Add fee structure</h2>
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="school_id">School Id</label>
                        <input type="text" id="school_id" name="school_id" placeholder="Enter School Id" value="<?= $schoolId ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="section">Class</label>
                        <select id="section" name="class_fee">
                            <option value="">Select</option>
                            <option value="1">Class 1</option>
                            <option value="2">Class 2</option>
                            <option value="3">Class 3</option>
                            <option value="4">Class 4</option>
                            <option value="5">Class 5</option>
                            <option value="6">Class 6</option>
                            <option value="7">Class 7</option>
                            <option value="8">Class 8</option>
                            <option value="9">Class 9</option>
                            <option value="10">Class 10</option>
                            <option value="11">Class 11</option>
                            <option value="12">Class 12</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <select id="section" name="section">
                            <option value="">Select</option>
                            <option value="A">Section A</option>
                            <option value="B">Section B</option>
                            <option value="C">Section C</option>
                            <option value="D">Section D</option>
                            <option value="E">Section E</option>
                            <option value="F">Section F</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="school_id">Enter fee</label>
                        <input type="number" id="fee" name="fee" placeholder="Enter Fee">
                    </div>
                    <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input type="text" id="account_number" name="account_number" placeholder="Enter Account Number">
                    </div>
                    <div class="form-group">
                        <label for="ifsc_code">IFSC Code</label>
                        <input type="text" id="ifsc_code" name="ifsc_code" placeholder="Enter IFSC Code">
                    </div>
                    <div class="form-group">
                        <label for="bank_name">Bank Name</label>
                        <input type="text" id="bank_name" name="bank_name" placeholder="Enter Bank Name">
                    </div>
                    <div class="form-group">
                        <label for="qr_code">QR Code</label>
                        <input type="file" id="qr_code" name="qr_code">
                    </div>
                    <div class="form-actions">
                        <button type="submit">Submit</button>
                    </div>


                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>School Id</th>
                                <th>QR Code</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Fee</th>
                                <th>Account Number</th>
                                <th>IFSC Code</th>
                                <th>Bank Name</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fetchHoliday = "SELECT * FROM fee_structure WHERE school_id='$schoolId'";
                            $data = mysqli_query($conn, $fetchHoliday);
                            if (mysqli_num_rows($data) > 0) {
                                while ($res = mysqli_fetch_assoc($data)) {


                            ?>
                                    <tr>
                                        <td><?= $res['id'] ?></td>
                                        <td><?= $res['school_id'] ?></td>
                                        <td><img src="qr_code/<?= $res['qr_code'] ?>" height="60px" width="60px" alt="qr code image"></td>
                                        <td><?= $res['class_fee'] ?></td>
                                        <td><?= $res['section'] ?></td>
                                        <td><?= $res['fee'] ?></td>
                                        <td><?= $res['account_number'] ?></td>
                                        <td><?= $res['ifsc_code'] ?></td>
                                        <td><?= $res['bank_name'] ?></td>
                                        <td><a href="delete_fee_structure.php?id=<?= $res['id'] ?>" style="color:red">Delete</a></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </table>
                </form>
            </div>
        </div>

        <script src="script.js"></script>
</body>

</html>