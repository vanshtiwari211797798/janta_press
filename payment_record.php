<?php
session_start();
ob_start();
include("admin/DB.php");
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
    <title>Responsive School Fee Table</title>
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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eef2f7;
            margin: 20px;
            text-align: center;
        }

        .container {
            max-width: 95%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007BFF;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            font-size: 16px;
            color: white;
            background: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s ease-in-out;
        }

        .btn:hover {
            background: #0056b3;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007BFF;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #e8f0ff;
            transition: 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            table {
                font-size: 13px;
            }

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
        <a href="user_dashboard.php" class="btn">Back to Dashboard</a>
        <h2>Your Fee Payment History</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>School ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>DOB</th>
                        <th>Roll No.</th>
                        <th>Father's Name</th>
                        <th>Father's Contact</th>
                        <th>Mother's Name</th>
                        <th>Address</th>
                        <th>Fee</th>
                        <th>Submitted Fee</th>
                        <th>Due Fee</th>
                        <th>Payment Status</th>
                        <th>Month</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM paid_fee WHERE school_id='$school_id' AND class='$class' AND section='$section' AND roll_number='$roll_number'";
                    $data = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($data) > 0) {
                        while ($rec = mysqli_fetch_assoc($data)) {
                    ?>
                            <tr>
                                <td><?= $rec['school_id'] ?></td>
                                <td><?= $rec['name'] ?></td>
                                <td><?= $rec['class'] ?></td>
                                <td><?= $rec['section'] ?></td>
                                <td><?= $rec['dob'] ?></td>
                                <td><?= $rec['roll_number'] ?></td>
                                <td><?= $rec['father_name'] ?></td>
                                <td><?= $rec['father_contact'] ?></td>
                                <td><?= $rec['mother_name'] ?></td>
                                <td><?= $rec['address'] ?></td>
                                <td>₹<?= $rec['fee'] ?></td>
                                <td>₹<?= $rec['submit_fee'] ?></td>
                                <td style="color: <?= $rec['due_fee'] == 0 ? 'green' : 'red'; ?>;">
                                    ₹<?= $rec['due_fee'] ?>
                                </td>
                                <td style="color: <?= $rec['payment_status'] == 'Approved' ? 'green' : 'red'; ?>;">
                                    <?= $rec['payment_status'] ?>
                                </td>
                                <td><?= date('M', strtotime($rec['created_at'])) ?></td>
                                <td><?= date('d-m-Y', strtotime($rec['created_at'])) ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
