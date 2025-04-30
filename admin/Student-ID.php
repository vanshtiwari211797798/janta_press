<?php
session_start();
include("DB.php");

$section = isset($_GET['section']) ? $_GET['section'] : '';
$scchool_id=isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
$sql = "SELECT * FROM students WHERE school_id='$scchool_id'";
if (!empty($school_id)) {
    $sql .= " AND school_id LIKE '%$school_id%'";
}
if (!empty($section)) {
    $sql .= " AND section = '$section'";
}

$data = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Student Id</title>
    <link rel="stylesheet" href="style.css">
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
<div id="google_translate_element"></div>
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
                <h2>Student Id card</h2>
                <form method="get">
                    <div class="form-group">
                        <label for="school_id">School Id</label>
                        <input type="text"  id="school_id" name="school_id"  placeholder="Enter School Id" value="<?= htmlspecialchars($scchool_id) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <input type="text" name="section" id="section" value="<?=$section?>">
                    </div>

                    <div class="form-actions">
                        <button type="submit">Search</button>
                    </div>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>School Id</th>
                        <th>Image</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Roll Number</th>
                        <th>City</th>
                        <th>Generate Id</th>
                        <th>Action</th>
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
                                <td><img src="Students_photo/<?= $record['photo'] ?>" height="50px" width="50px" alt="student image"></td>
                                <td><?= $record['name'] ?></td>
                                <td><?= $record['class'] ?></td>
                                <td><?= $record['section'] ?></td>
                                <td><?= $record['roll_number'] ?></td>
                                <td><?= $record['city'] ?></td>
                                <td><a href="Id_Card_download.php?id=<?= $record['id'] ?>" style="color: green;">Generate Now</a></td>
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
    <script src="script.js"></script>
</body>

</html>