<?php
session_start();
ob_start();
include("DB.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard with Tabs</title>
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
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>
    <div id="nav">
        <a href='Dashboard.php'><img id="logo" src="janta_logo.jpeg" alt=""></a>
        <a href="logout.php">
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
                <h1>Student Management</h1>
                <div id="content">
                    <div class="card student" style="background-color: #5A4B5E;">
                        <div id="card-content">
                            <h3>Add Student</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Student-info.php">More info</a>
                    </div>

                    <div class="card staff" style="background-color: #364d4e;">
                        <div id="card-content">
                            <h3>View student</h3>
                            <p>Enter</p>
                        </div>
                        <a href="view-student.php">More info</a>
                    </div>

                    <!-- <div class="card holiday" style="background-color: #7cdb2e;">
                        <div id="card-content">
                            <h3>
                                Student Photo Update</h3>
                            <p>Enter</p>
                        </div>
                        <a href="StudentPhoto-Update.php">More info</a>
                    </div> -->

                    <!-- <div class="card leave" style="background-color: #1d098d;">
                        <div id="card-content">
                            <h3>Assign Rfid Card</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Assign-RFID.php">More info</a>
                    </div> -->

                    <div class="card attendance" style="background-color: #c04984;">
                        <div id="card-content">
                            <h3>Student Id Generate</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Student-ID.php">More info</a>
                    </div>

                    <!-- <div class="card sms" style="background-color: #194042;">
                        <div id="card-content">
                            <h3>
                                Android id-password</h3>
                        <p>Enter</p>
                        </div>
                        <a href="Student-Password-Update.php">More info</a>
                    </div> -->

                    <!-- <div class="card school-info" style="background-color: #d64040;">
                        <div id="card-content">
                            <h3>Qrcode Generate</h3>
                        <p>Enter</p>
                        </div>
                        <a href="Student-Qrcode-Generate.php">More info</a>
                    </div> -->

                    <!-- <div class="card credit-detail" style="background-color: #4ec754;">
                        <div id="card-content">
                            <h3>Barcode Generate</h3>
                        <p>Enter</p>
                        </div>
                        <a href="Student-barcode-Generate.php">More info</a>
                    </div> -->

                    <!-- <div class="card credit-detail" style="background-color: #4ec754;">
                        <div id="card-content">
                            <h3>Student Face Assign</h3>
                        <p>Enter</p>
                        </div>
                        <a href="Student-Face-Assign.php">More info</a>
                    </div> -->

                    <!-- <div class="card credit-detail" style="background-color:rgb(192, 198, 26);">
                        <div id="card-content">
                            <h3>ADD CSV Data</h3>
                        <p>Enter</p>
                        </div>
                        <a href="add_csv.php">More info</a>
                    </div> -->
                    <div class="card credit-detail" style="background-color:rgb(120, 197, 12);">
                        <div id="card-content">
                            <h3>Upload CSV File</h3>
                            <p>Enter</p>
                        </div>
                        <a href="add_csv_file.php">More info</a>
                    </div>
                    <div class="card credit-detail" style="background-color: #4ec754;">
                        <div id="card-content">
                            <h3>Download CSV Data</h3>
                            <p>Enter</p>
                        </div>
                        <a href="download_csv_table.php">More info</a>
                    </div>

                    <!-- add fee structure -->
                    <div class="card credit-detail" style="background-color:rgb(0, 152, 155);">
                        <div id="card-content">
                            <h3>Add Fee structure</h3>
                            <p>Enter</p>
                        </div>
                        <a href="add_fee_structure.php">More info</a>
                    </div>

                    <div class="card credit-detail" style="background-color:rgb(171, 13, 163);">
                        <div id="card-content">
                            <h3>View Fee Payment History</h3>
                            <p>Enter</p>
                        </div>
                        <a href="view_fee_payment_history.php">More info</a>
                    </div>
                    <div class="card credit-detail" style="background-color:rgb(73, 0, 110);">
                        <div id="card-content">
                            <h3>Admission fee structure</h3>
                            <p>Enter</p>
                        </div>
                        <a href="add_admission_fee_struture.php">More info</a>
                    </div>
                    <div class="card credit-detail" style="background-color:rgb(137, 7, 70);">
                        <div id="card-content">
                            <h3>New Admission</h3>
                            <p>Enter</p>
                        </div>
                        <a href="new_admission.php">More info</a>
                    </div>

                    <div class="card credit-detail" style="background-color:rgb(202, 111, 175);">
                        <div id="card-content">
                            <h3>New Admission Lists</h3>
                            <p>Enter</p>
                        </div>
                        <a href="show_admissions_lists.php">More info</a>
                    </div>

                    <!-- add class -->
                    <div class="card credit-detail" style="background-color:rgb(96, 20, 167);">
                        <div id="card-content">
                            <h3>Add Class</h3>
                            <p>Enter</p>
                        </div>
                        <a href="add_class.php">More info</a>
                    </div>

                      <!-- add section -->
                      <div class="card credit-detail" style="background-color:rgb(111, 1, 103);">
                        <div id="card-content">
                            <h3>Add Section</h3>
                            <p>Enter</p>
                        </div>
                        <a href="add_section.php">More info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>