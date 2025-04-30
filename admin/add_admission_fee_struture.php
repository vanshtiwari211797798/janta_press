<?php
session_start();
include("DB.php");

$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['school_id'])) {
        echo "
                <script>
                    alert('School id is required');
                </script>
            ";
    } elseif (empty($_POST['class'])) {
        echo "
            <script>
                alert('Class is required');
            </script>
        ";
    } elseif (empty($_POST['fee'])) {
        echo "
            <script>
                alert('Fee is required');
            </script>
        ";
    } else {
        $school_id = $_POST['school_id'];
        $class = $_POST['class'];
        $fee = $_POST['fee'];
        $sql = "INSERT INTO admission_fee_struc (school_id, class,fee) VALUES ('$school_id','$class','$fee')";
        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
                alert('Admission Fee Structure Added Successfully');
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
    <title>Add Admission Fee Structure</title>
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
                <h2>Add Admission fee structure</h2>
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="school_id">School Id</label>
                        <input type="text" id="school_id" name="school_id" placeholder="Enter School Id" value="<?= $schoolId ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="section">Class</label>
                        <select id="section" name="class_fee">
                            <option value="">Select</option>
                            <?php
                            $fetchClass = "SELECT class FROM addclass WHERE school_id='$schoolId'";
                            $classList = mysqli_query($conn, $fetchClass);
                            if (mysqli_num_rows($classList) > 0) {
                                while ($classData = mysqli_fetch_assoc($classList)) {


                            ?>
                                    <option value="<?= $classData['class'] ?>"><?= $classData['class'] ?></option>
                            <?php
                                }
                            } else {
                                echo "<option value=''>Please enter class by admin panel</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="school_id">Enter fee</label>
                        <input type="number" id="fee" name="fee" placeholder="Enter Fee">
                    </div>
                    <div class="form-actions">
                        <button type="submit">Submit</button>
                    </div>


                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>School Id</th>
                                <th>Class</th>
                                <th>Fee</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fetchHoliday = "SELECT * FROM admission_fee_struc WHERE school_id='$schoolId'";
                            $data = mysqli_query($conn, $fetchHoliday);
                            if (mysqli_num_rows($data) > 0) {
                                while ($res = mysqli_fetch_assoc($data)) {

                            ?>
                                    <tr>
                                        <td><?= $res['id'] ?></td>
                                        <td><?= $res['school_id'] ?></td>
                                        <td><?= $res['class'] ?></td>
                                        <td><?= $res['fee'] ?></td>
                                        <td><a href="delete_admission_fee_struc.php?id=<?= $res['id'] ?>" style="color:red">Delete</a></td>
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