<?php
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
        $uid = $_POST['uid'];
        $name = $_POST['name'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $holiday_for = $_POST['holiday_for'];
        $description = $_POST['description'];

        $sql = "UPDATE holidays SET name='$name',from_date='$from_date',to_date='$to_date',holiday_for='$holiday_for',description='$description' WHERE id=$uid";
        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
                alert('Holiday Updated Successfully');
                window.location.href='Add-Holiday.php';
            </script>
        ";
        }
    }
}


if (!isset($_GET['id'])) {
    header('Location:Add-Holiday.php');
} else {
    $id = $_GET['id'];
    $fetchHoliDay = "SELECT * FROM holidays WHERE id=$id";
    $data_holiday = mysqli_query($conn, $fetchHoliDay);
    if (mysqli_num_rows($data_holiday) > 0) {
        $record = mysqli_fetch_assoc($data_holiday);


?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Holiday</title>
            <link rel="stylesheet" href="style.css">
            <script src="//code.jquery.com/jquery-3.7.1.slim.min.js"></script>
            <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
            <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">
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


                <div class="main" style="padding: 20px;">
                    <h2>Update Holiday</h2>
                    <form method="post">
                        <input type="hidden" value="<?= $record['id'] ?>" name="uid">
                        <div class="form-group">
                            <label for="studentName">Holiday Name*</label>
                            <input type="text" id="studentName" name="name" value="<?= $record['name'] ?>" placeholder="Enter Student Name">
                        </div>
                        <div class="form-group">
                            <label for="dob">From Date*</label>
                            <input type="text" style="cursor:pointer" value="<?= $record['from_date'] ?>" name="from_date" id="dob" class="bod-picker" placeholder="Select from date">
                        </div>
                        <div class="form-group">
                            <label for="dob">To Date*</label>
                            <input type="text" style="cursor: pointer;" value="<?= $record['to_date'] ?>" name="to_date" id="dob" class="bod-picker" placeholder="Select to date">
                        </div>
                        <div class="form-group">
                            <label for="section">Holiday For*</label>
                            <select id="section" name="holiday_for">
                                <option value="">Select</option>
                                <option value="Student" <?= $record['holiday_for'] == 'Student' ? 'selected' : '' ?>>Student</option>
                                <option value="Employee" <?= $record['holiday_for'] == 'Employee' ? 'selected' : '' ?>>Employee</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="remark">Description</label>
                            <textarea id="remark" name="description" rows="2" placeholder="Enter Remark"><?= $record['description'] ?></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit">Submit</button>
                        </div>

                    </form>
                </div>
            </div>

            <script src="script.js"></script>
            <script>
                $(".bod-picker").nepaliDatePicker({
                    dateFormat: "%D, %M %d, %y",
                    closeOnDateSelect: true
                });

                $("#clear-bth").on("click", function(event) {
                    $(".bod-picker").val('');
                });
            </script>
        </body>

        </html>

<?php
    }
}
?>