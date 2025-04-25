 <?php
session_start();
ob_start();
include("DB.php");
if(!isset($_SESSION['schoolId'])){
    header('Location:login.php');
}
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
        <a href='logout.php'>
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


        <div class="right-main" style="padding: 10px;">
            <div id="Dashboard" class="w3-container tab-content active">
                <h1>Dashboard</h1>
              
                <div id="content">
                    <div class="card student">
                        <div id="card-content">
                            <h3>Student</h3>
                            <p>Enter</p>
                        </div>
                        <a href='student-Management.php'>More info</a>
                    </div>

                    <div class="card staff">
                        <div id="card-content">
                            <h3>Staff</h3>
                            <p>Enter</p>
                        </div>
                        <a href='Employee-Management.php'>More info</a>
                    </div>

                    <div class="card holiday">
                        <div id="card-content">
                            <h3>Holiday</h3>
                            <p>Enter</p>
                        </div>
                        <a href='Holiday-Management.php'>More info</a>
                    </div>

                    <div class="card leave">
                        <div id="card-content">
                            <h3>Leave</h3>
                            <p>Enter</p>
                        </div>
                        <a href='Leave-management.php'>More info</a>
                    </div>

                    <div class="card attendance">
                        <div id="card-content">
                            <h3>Attendance</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Attendance-management.php">More info</a>
                    </div>
                    <!--         
                    <div class="card sms">
                        <div id="card-content">
                            <h3>SMS</h3>
                        <p>Enter</p>
                        </div>
                        <a href="student-sms.php">More info</a>
                    </div> -->

                    <div class="card school-info">
                        <div id="card-content">
                            <h3>school-info</h3>
                            <p>Enter</p>
                        </div>
                        <a href="school-general-info.php">More info</a>
                    </div>

                    <!-- <div class="card credit-detail">
                        <div id="card-content">
                            <h3>Credit-Detail</h3>
                        <p>Enter</p>
                        </div>
                        <a href="Credit-Management.php">More info</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>


    <script src="/script.js"></script>
</body>

</html>