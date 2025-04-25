<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 20px auto;
            gap: 20px;
            flex-wrap: wrap;
        }

        .panel {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 300px;
        }

        .panel h2 {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .panel input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .group {
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
        }

        .group h3 {
            font-size: 16px;
            margin: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .group h3 span {
            font-size: 18px;
            cursor: pointer;
        }

        .sms-panel label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .sms-panel input,
        .sms-panel textarea,
        .sms-panel select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .sms-panel button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .sms-panel button:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        /* Media Query for Mobile Devices */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
<div id="nav">
        <a href='Dashboard.php'><img id="logo" src="janta_logo.jpeg" alt=""></a>
        <a href="index.php"><h2 id="logout">Logout</h2></a>
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
            <p style="font-size: 20px; padding-left: 20px;">SMS Management </p>
            <div class="container">
                <!-- All Absent Students List -->
                <div class="panel">
                    <h2>All Absent Students List</h2>
                    <input type="text" placeholder="Search by name...">
                    <div class="group">
                        <h3>NURSERY[A] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>NURSERY[B] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>UKG[A] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>1ST[A] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>1ST[B] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>1ST[C] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>1ST[D] <span>+</span></h3>
                    </div>
                </div>

                <!-- SMS Panel -->
                <div class="panel sms-panel">
                    <p><strong>Balance:</strong> 0</p>
                    <label for="sms-method">Select SMS Method</label>
                    <select id="sms-method">
                        <option value="" disabled selected>Select</option>
                        <option value="method1">Method 1</option>
                        <option value="method2">Method 2</option>
                    </select>
                    <label for="contact">Contact</label>
                    <input type="text" id="contact" placeholder="Eg: 0123456789,1234567890,987654321">
                    <label for="sms-content">Sms Content</label>
                    <textarea id="sms-content"
                        placeholder="Enter SMS content...">Dear Parent, Your Child is absent from school Today Date:19-01-2025. Please Send Him/Her School Regularly. Thank You</textarea>
                    <button type="submit">Send</button>
                </div>

                <!-- All NOT Mark Students List -->
                <div class="panel">
                    <h2>All NOT Mark Students List</h2>
                    <input type="text" placeholder="Search by name...">
                    <div class="group">
                        <h3>NURSERY[A] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>NURSERY[B] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>UKG[A] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>1ST[A] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>1ST[B] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>1ST[C] <span>+</span></h3>
                    </div>
                    <div class="group">
                        <h3>1ST[D] <span>+</span></h3>
                    </div>
                </div>
            </div>

            <footer>
                Copyright © 2024 & 2025 . Ltd. All rights reserved.
            </footer>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>