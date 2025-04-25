<?php
session_start();
include("DB.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard with Tabs</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
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

        <!-- Right Content Section -->
        <div class="right-main" style="padding: 10px;">
            <div id="Dashboard" class="w3-container tab-content active">
                <h1>Employee Management</h1>
                <div id="content">
                    <div class="card student" style="background-color: #5A4B5E;">
                        <div id="card-content">
                            <h3>Employee Add</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Employee-Add.php">More info</a>
                    </div>

                    <div class="card staff" style="background-color: #364d4e;">
                        <div id="card-content">
                            <h3>Employee List</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Id-Generate.php">More info</a>
                    </div>

                    <div class="card holiday" style="background-color: #7cdb2e;">
                        <div id="card-content">
                            <h3>Id Generate </h3>
                            <p>Enter</p>
                        </div>
                        <a href="Id-Generate.php">More info</a>
                    </div>
                    <div class="card holiday" style="background-color:rgb(6, 105, 36);">
                        <div id="card-content">
                            <h3>Upload Csv </h3>
                            <p>Enter</p>
                        </div>
                        <a href="emp_csv_file.php">More info</a>
                    </div>
                    <div class="card leave" style="background-color: #1d098d;">
                        <div id="card-content">
                            <h3>
                                Staff Face Assign</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Staff-Face-Assign.php">More info</a>
                    </div>

                    <!-- <div class="card attendance" style="background-color: #c04984;">
                        <div id="card-content">
                            <h3>
                                Assign Rfid Card</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Assign-Rfid-Card.php">More info</a>
                    </div> -->

                    <div class="card sms" style="background-color: #194042;">
                        <div id="card-content">
                            <h3>Staff QRCODE Generate</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Staff-Qrcode-Generate.php">More info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>