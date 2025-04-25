<?php
    session_start();

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
    
        <!-- Right Content Section -->
        <div class="right-main" style="padding: 10px;">
            <div id="Dashboard" class="w3-container tab-content active">
                <h1>School Information Management</h1>
                <div id="content"">
                    <div class="card student" style="background-color: #D9A420;">
                        <div id="card-content">
                            <h3>School General Info</h3>
                            <p>Enter</p>
                        </div>
                        <a href="1-School-General-Info.php">More info</a>
                    </div>
        
                    <!-- <div class="card staff" style="background-color: #0E2F44;">
                        <div id="card-content">
                            <h3>
                                Add Class</h3>
                            <p>Enter</p>
                        </div>
                        <a href="2-Add-Class.php">More info</a>
                    </div> -->
<!--         
                    <div class="card holiday" style="background-color: #FF4040;">
                        <div id="card-content">
                            <h3>
                                Student Category</h3>
                            <p>Enter</p>
                        </div>
                        <a href="3-Student-Category.php">More info</a>
                    </div>
        
                    <div class="card leave" style="background-color: #BADA55;">
                        <div id="card-content">
                            <h3>Staff Category</h3>
                            <p>Enter</p>
                        </div>
                        <a href="4-Staff-Category.php">More info</a>
                    </div> -->
        
                    <div class="card attendance" style="background-color: #4C4CAD;">
                        <div id="card-content">
                            <h3>ID CARD STUDENT</h3>
                            <p>Enter</p>
                        </div>
                        <a href="Student-ID.php">More info</a>
                    </div>
        
                    <div class="card sms" style="background-color: #075435;">
                        <div id="card-content">
                            <h3>ID CARD SATFF</h3>
                        <p>Enter</p>
                        </div>
                        <a href="Id-Generate.php">More info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script src="script.js"></script>
</body>

</html>