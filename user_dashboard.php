<?php
session_start();

// Check if user is logged in, redirect if not
if(!isset($_SESSION['school_id'])){
    header('Location:stdlogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Dashboard</title>
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
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f3f4f6;
            height: 100vh;
            flex-direction: row;
            align-items: flex-start;
            overflow-x: hidden;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background-color: #007bff;
            color: white;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s ease;
        }

        .sidebar h3 {
            padding: 20px 0px 0px 0px;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            text-decoration: none;
            padding: 15px;
            display: block;
            color: white;
            font-size: 18px;
            margin-bottom: 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        /* Main content area */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        h2 {
            text-align: center;
            padding: 30px 0px 0px 0px;
            margin-bottom: 30px;
        }

        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            width: 250px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s;
            text-align: center;
            margin: 10px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 16px;
        }

        /* Hidden sections */
        .hidden {
            display: none;
        }

        .section {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .section button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .section button:hover {
            background-color: #0056b3;
        }

        /* Sidebar toggle button for small screens */
        .sidebar-toggle {
            display: none;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 24px;
            padding: 10px;
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                position: absolute;
                top: 0;
                left: -250px;
                padding-top: 60px;
            }

            .sidebar a {
                font-size: 16px;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .card-container {
                justify-content: center;
            }

            .card {
                width: 100%;
                max-width: 300px;
            }

            .sidebar.active {
                width: 250px;
                left: 0;
            }

            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
            }
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3>Student Dashboard</h3>
        <a href="payfee.php">Pay fee</a>
        <a href="payment_record.php">Payment Record</a>
        <a href="holiday_list.php">Holiday List</a>
        <a href="admit_card.php">Admit card</a>
        <a href="my_leave.php">My Leave</a>
        <a href="mytc.php">My TC</a>
        <a href="student_logout.php">Logout</a>

    </div>

    <!-- Sidebar Toggle Button (for small screens) -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">&#9776;</button>

    <!-- Main content -->
    <div class="main-content">
        <h2>Welcome <?= isset($_SESSION['std_name']) ? $_SESSION['std_name'] : '' ?> to Your Dashboard</h2>

        <div class="card-container">
            <!-- Card for Apply TC -->
            <div class="card">
                <h3><a href="apply_tc.php" style="text-decoration:none;">Apply TC</a></h3>
                <p>Apply for Transfer Certificate</p>
            </div>

            <!-- Card for View Result -->
            <div class="card">
                <h3><a href="" style="text-decoration:none;">View Result</a></h3>
                <p>Check Your Results</p>
            </div>
        </div>


    </div>

    <!-- JavaScript to control section switching and sidebar toggle -->
    <script>
        function openSection(section) {
            // Hide all sections
            var sections = document.querySelectorAll('.section');
            sections.forEach(function(sec) {
                sec.classList.add('hidden');
            });

            // Show the selected section
            document.getElementById(section).classList.remove('hidden');
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>

</body>

</html>