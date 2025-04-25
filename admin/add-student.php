<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
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
    
    
        <div class="main" style="padding: 20px;">
            <h2>Add Student</h2>
            <form>
                <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" id="studentName" placeholder="Enter Student Name">
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <select id="class">
                        <option>Select Class</option>
                        <option>Class 1</option>
                        <option>Class 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select id="section">
                        <option>Select</option>
                        <option>A</option>
                        <option>B</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="studentCategory">Student Category</label>
                    <select id="studentCategory">
                        <option>Select</option>
                        <option>General</option>
                        <option>OBC</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender">
                        <option>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Student DOB</label>
                    <input type="date" id="dob">
                </div>
                <div class="form-group">
                    <label for="rollNumber">Student Roll Number</label>
                    <input type="text" id="rollNumber" placeholder="Enter Roll Number">
                </div>
                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" id="fatherName" placeholder="Enter Father's Name">
                </div>
                <div class="form-group">
                    <label for="fatherContact">Father Contact</label>
                    <input type="text" id="fatherContact" placeholder="Enter Contact">
                </div>
                <div class="form-group">
                    <label for="motherName">Mother Name</label>
                    <input type="text" id="motherName" placeholder="Enter Mother's Name">
                </div>
                <div class="form-group">
                    <label for="motherContact">Mother Contact</label>
                    <input type="text" id="motherContact" placeholder="Enter Contact">
                </div>
                <div class="form-group">
                    <label for="bloodGroup">Blood Group</label>
                    <input type="text" id="bloodGroup" placeholder="Enter Blood Group">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" placeholder="Enter City">
                </div>
                <div class="form-group">
                    <label for="address">Student Address</label>
                    <textarea id="address" rows="2" placeholder="Enter Address"></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Student Photo</label>
                    <input type="file" id="photo">
                    <img src="placeholder.png" alt="Preview">
                </div>
                <div class="form-group">
                    <label for="rfId">Add RF ID Number</label>
                    <input type="text" id="rfId" placeholder="Enter RF ID Number">
                </div>
                <div class="form-group">
                    <label for="webSms">Web SMS</label>
                    <select id="webSms">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Android Password</label>
                    <input type="password" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <textarea id="remark" rows="2" placeholder="Enter Remark"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div> 
    </div>

    <script src="/script.js"></script>
</body>

</html>
