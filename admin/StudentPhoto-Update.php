<?php
include("DB.php");
$class = isset($_GET['class']) ? $_GET['class'] : '';
$section = isset($_GET['section']) ? $_GET['section'] : '';
$showTable = false;
// Construct query with filters

if(!empty($class) && !empty($section)){
    $showTable=true;
    $sql = "SELECT * FROM students WHERE 1=1";
    if (!empty($class) && $class != "Select Class") {
        $sql .= " AND class LIKE '%$class%'";
    }
    if (!empty($section) && $section != "Select") {
        $sql .= " AND section = '$section'";
    }
    
    $data = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .main {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .filter-container {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .filter-container label {
            font-weight: bold;
            margin-right: 5px;
            font-size: 15px;
            font-weight: 600;
        }

        .filter-container select {
            padding: 5px 70px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .filter-container button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .filter-container button:hover {
            background-color: #45a049;
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
            text-align: center;
            padding: 6px;
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


        </div>

        <div class="main">
            <div class="container">
                <h1 style="font-size: 1.3rem; font-weight: 500;">Student Photo Update</h1>
                <form action="" method="get">
                    <div class="filter-container">
                        <div>
                            <label for="class">Class</label>
                            <br>
                            <select id="class" name="class">
                                <option value="">Select Class</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div>
                            <label for="section">Section</label>
                            <br>
                            <select id="section" name="section">
                                <option value="">Select Section</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                            </select>
                        </div>

                        <div style="margin-top: 17px;">
                            <button style="padding: 10px 27px; font-size: 15px;" type="submit">Get List</button>
                        </div>
                    </div>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Image</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Roll Number</th>
                        <th>City</th>
                        <th>Update</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($showTable) :?>
                    <?php
                    if (mysqli_num_rows($data) > 0) {
                        while ($record = mysqli_fetch_assoc($data)) {
                    ?>
                            <tr>
                                <td><?= $record['id'] ?></td>
                                <td><img src="Students_photo/<?= $record['photo'] ?>" height="50px" width="50px" alt="student image"></td>
                                <td><?= $record['name'] ?></td>
                                <td><?= $record['class'] ?></td>
                                <td><?= $record['section'] ?></td>
                                <td><?= $record['roll_number'] ?></td>
                                <td><?= $record['city'] ?></td>
                                <td><a href="update-student-data.php?id=<?= $record['id'] ?>" style="color: green;">Update</a></td>
                                <td><a href="deleteStudent.php?id=<?= $record['id'] ?>" style="color: red;">Delete</a></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
                <?php
                endif
                ?>
            </table>
        </div>

        <script src="script.js"></script>
</body>

</html>