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
                <h1>Leave Management</h1>
                <div id="content">
                    <div class="card credit-detail" style="background-color: #e4531a;">
                        <div id="card-content">
                            <h3>Student Leave</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Student-Leave.php">More info</a>
                    </div>

                    <div class="card credit-detail" style="background-color: #4ec754;">
                        <div id="card-content">
                            <h3>Employee Leave</h3>
                            <p>Enter</p>
                        </div>
                        <a href="employee_leave_add.php">More info</a>
                    </div>

                    <div class="card credit-detail" style="background-color: #11737a;">
                        <div id="card-content">
                            <h3>View Student Leave</h3>
                            <p>Enter</p>
                        </div>
                        <a href="viewStudentLeave.php">More info</a>
                    </div>
                    <div class="card credit-detail" style="background-color:rgb(12, 196, 137);">
                        <div id="card-content">
                            <h3>View Employee Leave</h3>
                            <p>Enter</p>
                        </div>
                        <a href="view_employee_leave.php">More info</a>
                    </div>
                </div>
            </div>
        </div>


        <script src="script.js"></script>
</body>

</html>