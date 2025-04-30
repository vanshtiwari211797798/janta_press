<?php
// including the database and sessions
session_start();
include("DB.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Table</title>
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
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f4f4;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }

        .btn-edit {
            background: #28a745;
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            margin-bottom: 15px;
            display: inline-block;
        }

        @media (max-width: 600px) {

            th,
            td {
                font-size: 14px;
                padding: 8px;
            }

            .btn {
                font-size: 12px;
                padding: 5px;
            }
        }
    </style>
</head>

<body>
<div id="google_translate_element"></div>
    <div class="container">
        <a href="student-Management.php" class="btn btn-back">Back</a>
        <h2>Student Admissions</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>School ID</th>
                        <th>Full Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Aadhar Number</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Parent Contact</th>
                        <th>Previous School</th>
                        <th>Total Fee</th>
                        <th>Submit Fee</th>
                        <th>Due Fee</th>
                        <th>Admission status</th>
                        <th>Admission Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $school_id = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
                    $sql = "SELECT * FROM new_admission WHERE school_id='$school_id'";
                    $data = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($data) > 0) {
                        while ($res = mysqli_fetch_assoc($data)) {


                    ?>
                            <tr>
                                <td><?= $res['id'] ?></td>
                                <td><img src="new_admissionPhoto/<?= $res['photo'] ?>" alt="Photo" width="70"></td>
                                <td><?= $res['school_id'] ?></td>
                                <td><?= $res['full_name'] ?></td>
                                <td><?= $res['dob'] ?></td>
                                <td><?= $res['gender'] ?></td>
                                <td><?= $res['class'] ?></td>
                                <td><?= $res['section'] ?></td>
                                <td><?= $res['aadhar_number'] ?></td>
                                <td><?= $res['father_name'] ?></td>
                                <td><?= $res['mother_name'] ?></td>
                                <td><?= $res['parent_contact'] ?></td>
                                <td><?= $res['previous_school'] ?></td>
                                <td><?= $res['total_fee'] ?></td>
                                <td><?= $res['submited_fee'] ?></td>
                                <td><?= $res['due_fee'] ?></td>

                                <td style="color: <?= $res['admission_status'] == 'Approved' ? 'green' : 'red' ?>;"><?= $res['admission_status'] ?></td>
                                <td><?= $res['admission_date'] ?></td>
                                <td>
                                    <a href="edit_new_admission.php?id=<?= $res['id'] ?>" class="btn btn-edit">Edit</a>
                                    <a href="delete_new_admission.php?id=<?= $res['id'] ?>" class="btn btn-delete">Delete</a>
                                </td>
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