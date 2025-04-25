<?php
session_start();
ob_start();
include("DB.php");
$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
$sql = "SELECT * FROM request_tc WHERE school_id='$schoolId'";
$data = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tc Requested Table</title>
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
            max-width: 1200px;
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
            min-width: 1000px;
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
</head>

<body>

    <div id="google_translate_element"></div> 

    <div class="container">
        <a href="tc_management.php" class="back-btn">⬅ Back</a>
        <h2>📋 Student Details</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>School ID</th>
                    <th>School Name</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>DOB</th>
                    <th>Roll Number</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Created At</th>
                    <th>Declare Now</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($data) > 0) {
                    $sr = 1;
                    while ($rec = mysqli_fetch_assoc($data)) {
                ?>
                        <tr>
                            <td><?= $sr++ ?></td>
                            <td><?= $rec['school_id'] ?></td>
                            <td><?= $rec['school_name'] ?></td>
                            <td><?= $rec['name'] ?></td>
                            <td><?= $rec['class'] ?></td>
                            <td><?= $rec['section'] ?></td>
                            <td><?= $rec['dob'] ?></td>
                            <td><?= $rec['roll_number'] ?></td>
                            <td><?= $rec['father_name'] ?></td>
                            <td><?= $rec['mother_name'] ?></td>
                            <td><?= $rec['created_at'] ?></td>
                            <td><a href="declare_tc.php?id=<?= $rec['id'] ?>" style="color: green; text-decoration:none">Declare</a></td>
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
