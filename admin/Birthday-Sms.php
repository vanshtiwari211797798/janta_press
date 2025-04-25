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

        .main{
            display: flex;
        }

        .container {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .container h3 {
            background-color: #5A5C9E;
            color: white;
            padding: 10px;
            text-align: center;
            margin: 0 0 10px 0;
            border-radius: 5px;
        }
        .list {
            list-style-type: none;
            padding: 0;
        }
        .list li {
            padding: 5px;
            border-bottom: 1px solid #ccc;
        }
        .list li:last-child {
            border-bottom: none;
        }
        .sms-section {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            height: 100px;
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
            <div class="container">
                <h3>All Student List [Today Birthday]</h3>
                <ul class="list">
                    <li><input type="checkbox"> Maruf Ahmed Barbhuiya (9691786836) [1997-01-01]</li>
                </ul>
                <h3>All Student List [This Month Birthday]</h3>
                <ul class="list">
                    <li><input type="checkbox"> Maruf Ahmed Barbhuiya (9691786836) [1997-01-01]</li>
                    <li><input type="checkbox"> One() [2016-01-07]</li>
                    <li><input type="checkbox"> RIMPA SHEEL() [2016-01-07]</li>
                    <li><input type="checkbox"> One() [2016-01-17]</li>
                    <li><input type="checkbox"> ITIKA MONDAL() [2016-01-17]</li>
                    <li><input type="checkbox"> One() [2016-01-20]</li>
                    <li><input type="checkbox"> BANDANA SARKAR() [2016-01-20]</li>
                    <li><input type="checkbox"> One() [2016-04-28]</li>
                </ul>
            </div>
            <div class="container">
                <h3>SMS Sending Section</h3>
                <div class="sms-section">
                    <label for="sms-method">Select SMS Method</label>
                    <select id="sms-method">
                        <option>Select</option>
                    </select>
                    <label for="template">Template</label>
                    <select id="template">
                        <option>Select Template</option>
                    </select>
                    <label for="contact">Contact</label>
                    <input type="text" id="contact" placeholder="Eg: 0123456789,1234567890,987654321">
                    <label for="sms-content">Sms Content</label>
                    <textarea id="sms-content">Dear student, Wish you many happy returns of the day. Happy Birthday to You! From SIMPTION TECH [SIMPTION]</textarea>
                </div>
            </div>
            <div class="container">
                <h3>Staff List [Today Birthday]</h3>
                <ul class="list">
                    <li><input type="checkbox"> Mohammed Nijam (9589919501) [1972-01-06]</li>
                </ul>
                <h3>Staff List [This Month Birthday]</h3>
                <ul class="list">
                    <li><input type="checkbox"> Mohammed Nijam (9589919501) [1972-01-06]</li>
                    <li><input type="checkbox"> GAURAV KUMAR (6203130659) [1986-01-01]</li>
                    <li><input type="checkbox"> SANTOSH KUMAR (9625580620) [1995-01-01]</li>
                    <li><input type="checkbox"> Binod Bdr Bhul (9868688865) [1995-01-01]</li>
                    <li><input type="checkbox"> RAUSHAN KUMAR (9153363571) [1995-01-21]</li>
                    <li><input type="checkbox"> RAJNI (6299016210) [2001-01-11]</li>
                    <li><input type="checkbox"> ANAND KUMAR GUPTA (8770584026) [2024-01-25]</li>
                </ul>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>