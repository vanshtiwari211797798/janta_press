<?php
session_start();
include("DB.php");
$studentId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
// $studentName = isset($_GET['studentName']) ? $_GET['studentName'] : '';
// $class = isset($_GET['class']) ? $_GET['class'] : '';
// $section = isset($_GET['section']) ? $_GET['section'] : '';

// Construct query with filters
$sql = "SELECT * FROM students WHERE school_id='$studentId'";
// if (!empty($studentName)) {
//     $sql .= " AND name LIKE '%$studentName%'";
// }
// if (!empty($class) && $class != "Select Class") {
//     $sql .= " AND class = '$class'";
// }
// if (!empty($section) && $section != "Select") {
//     $sql .= " AND section = '$section'";
// }

$data = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download CSV</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .main {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
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
            gap: 20px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-actions {
            margin-top: 20px;
        }

        .form-actions button {
            margin-top: 8px;
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
                <h2>View Student CSV</h2>
                <form method="GET">
                    <!-- <div class="form-group">
                        <label for="studentName">Student Name</label>
                        <input type="text" id="studentName" name="studentName" placeholder="Enter Student Name" value="<?= htmlspecialchars($studentName) ?>">
                    </div>
                    <div class="form-group">
                        <label for="class">Class</label>
                        <select id="class" name="class">
                            <option>Select Class</option>
                            <option value="1" <?= $class == "1" ? "selected" : "" ?>>Class 1</option>
                            <option value="2" <?= $class == "2" ? "selected" : "" ?>>Class 2</option>
                            <option value="3" <?= $class == "3" ? "selected" : "" ?>>Class 3</option>
                            <option value="4" <?= $class == "4" ? "selected" : "" ?>>Class 4</option>
                            <option value="5" <?= $class == "5" ? "selected" : "" ?>>Class 5</option>
                            <option value="6" <?= $class == "6" ? "selected" : "" ?>>Class 6</option>
                            <option value="7" <?= $class == "7" ? "selected" : "" ?>>Class 7</option>
                            <option value="8" <?= $class == "8" ? "selected" : "" ?>>Class 8</option>
                            <option value="9" <?= $class == "9" ? "selected" : "" ?>>Class 9</option>
                            <option value="10" <?= $class == "10" ? "selected" : "" ?>>Class 10</option>
                            <option value="11" <?= $class == "11" ? "selected" : "" ?>>Class 11</option>
                            <option value="12" <?= $class == "12" ? "selected" : "" ?>>Class 12</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <select id="section" name="section">
                            <option>Select</option>
                            <option value="A" <?= $section == "A" ? "selected" : "" ?>>A</option>
                            <option value="B" <?= $section == "B" ? "selected" : "" ?>>B</option>
                            <option value="C" <?= $section == "C" ? "selected" : "" ?>>C</option>
                            <option value="D" <?= $section == "D" ? "selected" : "" ?>>D</option>
                            <option value="E" <?= $section == "E" ? "selected" : "" ?>>E</option>
                            <option value="F" <?= $section == "F" ? "selected" : "" ?>>F</option>
                        </select>
                    </div> -->
                    <div class="form-actions">
                        <button type="button" id="downloadCSV">CSV Download</button>
                    </div>
                </form>
            </div>
            <table style="overflow-x: auto;">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>School Id</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Category</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Roll No</th>
                        <th>Father</th>
                        <th>Father Contact</th>
                        <th>Mother</th>
                        <th>Mother Contact</th>
                        <th>Blood Group</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>RF ID</th>
                        <th>SMS</th>
                        <th>Password</th>
                        <th>Remark</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($data) > 0) {
                        while ($record = mysqli_fetch_assoc($data)) {
                    ?>
                            <tr>
                                <td><?= $record['id'] ?></td>
                                <td><?= $record['school_id'] ?></td>
                                <td><?= $record['name'] ?></td>
                                <td><?= $record['class'] ?></td>
                                <td><?= $record['section'] ?></td>
                                <td><?= $record['category'] ?></td>
                                <td><?= $record['gender'] ?></td>
                                <td><?= $record['dob'] ?></td>
                                <td><?= $record['roll_number'] ?></td>
                                <td><?= $record['father_name'] ?></td>
                                <td><?= $record['father_contact'] ?></td>
                                <td><?= $record['mother_name'] ?></td>
                                <td><?= $record['mother_contact'] ?></td>
                                <td><?= $record['blood_grp'] ?></td>
                                <td><?= $record['city'] ?></td>
                                <td><?= $record['address'] ?></td>
                                <td><?= $record['rf_id'] ?></td>
                                <td><?= $record['sms'] ?></td>
                                <td><?= $record['android_password'] ?></td>
                                <td><?= $record['remark'] ?></td>
                                <td><a href="update-student-data.php?id=<?= $record['id'] ?>" style="color: red;">Update</a></td>
                                <td><a href="deleteStudent.php?id=<?= $record['id'] ?>" style="color: red;">Delete</a></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>





    <script>
        document.getElementById("downloadCSV").addEventListener("click", function() {
            let table = document.querySelector("table");
            let rows = table.querySelectorAll("tr");
            let csvContent = "";

            rows.forEach(row => {
                let cols = row.querySelectorAll("th, td");
                let rowData = [];

                cols.forEach(col => {
                    // Extract text content while ignoring images and links
                    let text = col.querySelector("img") ? col.querySelector("img").src : col.innerText;
                    rowData.push('"' + text.replace(/"/g, '""') + '"'); // Escape quotes for CSV format
                });

                csvContent += rowData.join(",") + "\n";
            });

            let blob = new Blob([csvContent], {
                type: "text/csv"
            });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "students_data.csv";
            link.click();
        });
    </script>


</body>

</html>