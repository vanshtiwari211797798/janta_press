<?php
session_start();
ob_start();
include("admin/DB.php");
// getting the session value from the $_SESSION (super global variable)
$std_name = isset($_SESSION['std_name']) ? $_SESSION['std_name'] : '';
$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';
$class = isset($_SESSION['class']) ? $_SESSION['class'] : '';
$section = isset($_SESSION['section']) ? $_SESSION['section'] : '';
$roll_number = isset($_SESSION['roll_number']) ? $_SESSION['roll_number'] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application Table</title>
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 15px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #218838;
        }

        @media (max-width: 600px) {

            th,
            td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>
    <div class="container">
        <a href="user_dashboard.php" class="back-btn">⬅ Back</a>
        <h2>📄 Leave Applications</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Application Image</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Roll Number</th>
                    <th>Total Days</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM student_leave WHERE school_id='$school_id' AND roll_number='$roll_number' AND class='$class' AND section='$section'";
                $data = mysqli_query($conn, $sql);
                if (mysqli_num_rows($data) > 0) {
                    $sr = 1;
                    while ($record = mysqli_fetch_assoc($data)) {


                ?>
                        <tr>
                            <td><?= $sr++ ?></td>
                            <td><img src="admin/Leave_Application/<?= $record['application_photo'] ?>" alt="Application" width="100"></td>
                            <td><?= $record['name'] ?></td>
                            <td><?= $record['class'] ?></td>
                            <td><?= $record['section'] ?></td>
                            <td><?= $record['roll_number'] ?></td>
                            <td><?= $record['total_leave_days'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>