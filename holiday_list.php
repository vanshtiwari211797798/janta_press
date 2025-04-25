<?php
session_start();
include("admin/DB.php");
$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';
$sql = "SELECT * FROM holidays WHERE school_id='$school_id'";
$data = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday List</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            text-align: left;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
            font-size: 16px;
            text-transform: uppercase;
        }

        td {
            background: #ffffff;
            color: #333;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        tr:hover {
            background: rgba(0, 123, 255, 0.1);
            transition: 0.3s;
        }

        .back-button {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            padding: 12px 18px;
            background: #007bff;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        .back-button:hover {
            background: #0056b3;
            box-shadow: none;
        }

        @media (max-width: 600px) {
            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 10px;
            }

            .back-button {
                font-size: 14px;
                padding: 10px 15px;
            }
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>
    <div class="container">
        <h2>📅 Holiday List</h2>
        <table>
            <thead>
                <tr>
                    <th>S.r No</th>
                    <th>Holiday Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Holiday For</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($data) > 0) {
                    $sr = 1;
                    while ($record = mysqli_fetch_assoc($data)) {


                ?>
                        <tr>
                            <td><?= $sr++ ?></td>
                            <td><?= $record['name'] ?></td>
                            <td><?= $record['from_date'] ?></td>
                            <td><?= $record['to_date'] ?></td>
                            <td><?= $record['holiday_for'] ?></td>
                            <td><?= $record['description'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="user_dashboard.php" class="back-button">⬅ Back</a>
    </div>

</body>

</html>