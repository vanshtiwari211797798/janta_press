<?php
session_start();

$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
include("DB.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        echo "
                <script>
                    alert('Student name is required');
                </script>
            ";
    } elseif (empty($_POST['from_date'])) {
        echo "
            <script>
                alert('From date is required');
            </script>
        ";
    } elseif (empty($_POST['to_date'])) {
        echo "
            <script>
                alert('To date is required');
            </script>
        ";
    } elseif (empty($_POST['holiday_for'])) {
        echo "
            <script>
                alert('Holiday for is required');
            </script>
        ";
    } elseif (empty($_POST['description'])) {
        echo "
            <script>
                alert('Description is required');
            </script>
        ";
    } else {
        $school_id = $_POST['school_id'];
        $name = $_POST['name'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $holiday_for = $_POST['holiday_for'];
        $description = $_POST['description'];

        $sql = "INSERT INTO holidays (school_id, name,from_date,to_date,holiday_for,description) VALUES ('$school_id','$name','$from_date','$to_date','$holiday_for','$description')";
        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
                alert('Holiday Added Successfully');
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
    <title>Add Holiday</title>
    <link rel="stylesheet" href="style.css">
    <!-- this should go after your </body> -->
    <script src="//code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
    <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">
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
                <h2>Holiday Form</h2>
                <form method="post">

                    <div class="form-group">
                        <label for="school_id">School Id</label>
                        <input type="text" id="school_id" name="school_id" placeholder="Enter School Id" value="<?= $schoolId ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="studentName">Holiday Name*</label>
                        <input type="text" id="studentName" name="name" placeholder="Enter Holiday Name">
                    </div>
                    <div class="form-group">
                        <label for="dob">From Date*</label>
                        <input type="text" style="cursor: pointer;" name="from_date" id="myDate" class="bod-picker" placeholder="YYYY-MM-DD">
                    </div>
                    <script>
                        const dateInput = document.getElementById("myDate");

                        dateInput.addEventListener("input", function(e) {
                            let value = this.value.replace(/[^0-9]/g, ""); // Remove non-numeric
                            if (value.length > 4) {
                                value = value.slice(0, 4) + "-" + value.slice(4);
                            }
                            if (value.length > 7) {
                                value = value.slice(0, 7) + "-" + value.slice(7, 9);
                            }
                            this.value = value;
                        });
                    </script>
                    <div class="form-group">
                        <label for="dob">To Date*</label>
                        <input type="text" style="cursor: pointer;" name="to_date" id="myDate2" placeholder="YYYY-MM-DD">
                    </div>
                    <script>
                        (() => {
                            const dateInput = document.getElementById("myDate2");

                            dateInput.addEventListener("input", function(e) {
                                let value = this.value.replace(/[^0-9]/g, ""); // Remove non-numeric
                                if (value.length > 4) {
                                    value = value.slice(0, 4) + "-" + value.slice(4);
                                }
                                if (value.length > 7) {
                                    value = value.slice(0, 7) + "-" + value.slice(7, 9);
                                }
                                this.value = value;
                            });
                        })(); // <-- yeh missing tha
                    </script>
                    <div class="form-group">
                        <label for="section">Holiday For*</label>
                        <select id="section" name="holiday_for">
                            <option value="">Select</option>
                            <option value="Student">Student</option>
                            <option value="Employee">Employee</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="remark">Description</label>
                        <textarea id="remark" name="description" rows="2" placeholder="Enter Remark"></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit">Submit</button>
                    </div>


                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>School Id</th>
                                <th>Name</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Holiday For</th>
                                <th>Description</th>
                                <th>Modify</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fetchHoliday = "SELECT * FROM holidays";
                            $data = mysqli_query($conn, $fetchHoliday);
                            if (mysqli_num_rows($data) > 0) {
                                while ($res = mysqli_fetch_assoc($data)) {


                            ?>
                                    <tr>
                                        <td><?= $res['id'] ?></td>
                                        <td><?= $res['school_id'] ?></td>
                                        <td><?= $res['name'] ?></td>
                                        <td><?= $res['from_date'] ?></td>
                                        <td><?= $res['to_date'] ?></td>
                                        <td><?= $res['holiday_for'] ?></td>
                                        <td><?= $res['description'] ?></td>
                                        <td><a href="updateHoliday.php?id=<?= $res['id'] ?>" style="color:green">Update</a></td>
                                        <td><a href="delete_holiday.php?id=<?= $res['id'] ?>" style="color:red">Delete</a></td>
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