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
            padding: 2px;
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            padding: 2px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            gap: 20px;
            flex-wrap: wrap;
        }

        .left-panel,
        .right-panel {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 2px 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .left-panel {
            flex: 2;
            min-width: 300px;
        }

        .right-panel {
            flex: 1;
            min-width: 300px;
        }

        .left-panel input[type="text"] {
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

        .right-panel label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .right-panel input,
        .right-panel textarea,
        .right-panel select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .right-panel button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .right-panel button:hover {
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
                <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">TC</a>
                <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Marksheet</a>
                <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Admit Cart</a>
                <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Expences</a>
                <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Transport</a>
                <a href="student-sms.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'SMS')">SMS</a>
                <a href="school-general-info.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'SchoolInfo')">School Info</a>
            </div>
    
            
        </div>

        <div class="main">
            <p style="font-size: 20px;">SMS Management </p>
            <div class="container">
                <!-- Left Panel -->
                <div class="left-panel">
                    <input  style="width: 730px; margin-top: 12px;" type="text" placeholder="Search by name...">
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

                <!-- Right Panel -->
                <div class="right-panel">
                    <p><strong>Balance:</strong> 0</p>
                    <label for="sms-method">Select SMS Method</label>
                    <select id="sms-method">
                        <option value="" disabled selected>Select</option>
                        <option value="method1">Method 1</option>
                        <option value="method2">Method 2</option>
                    </select>
                    <label for="contact" >Contact</label>
                    <input style="width: 170px;" type="text" id="contact" placeholder="Eg: 0123456789,1234567890,987654321">
                    <label for="sms-content">Sms Content</label>
                    <textarea style="width: 170px;" id="sms-content" placeholder="Enter SMS content..."></textarea>
                    <button type="submit">Send</button>
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