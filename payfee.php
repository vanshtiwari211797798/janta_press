<?php
session_start();
ob_start();
include("admin/DB.php");
$stdName = $_SESSION['std_name'];
$school_id = $_SESSION['school_id'];
$std_class = $_SESSION['class'];
$std_section = $_SESSION['section'];
$std_roll_num = $_SESSION['roll_number'];

$sql = "SELECT * FROM fee_structure WHERE class_fee='$std_class' AND school_id='$school_id'";
$data = mysqli_query($conn, $sql);
if (mysqli_num_rows($data) > 0) {
    $res = mysqli_fetch_assoc($data);
    $feeData = $res['fee'];
    $qr_code = $res['qr_code'];
} else {
    echo "
        <script>
            alert('Fee is not entered for your class by your admin');
            window.location.href='user_dashboard.php';
        </script>
    ";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['school_id']) || empty($_POST['name']) || empty($_POST['class']) || empty($_POST['section']) || empty($_POST['dob']) || empty($_POST['roll_number']) || empty($_POST['father_name']) || empty($_POST['father_contact']) || empty($_POST['mother_name']) || empty($_POST['address']) || empty($_POST['fee']) || empty($_POST['submit_fee']) || empty($_FILES['payment_screenshot']['name'])) {
        echo "
            <script>
                alert('All fields is required');
            </script>
        ";
    } else {
        $school_id = $_POST['school_id'];
        $name = $_POST['name'];
        $class = $_POST['class'];
        $section = $_POST['section'];
        $dob = $_POST['dob'];
        $roll_number = $_POST['roll_number'];
        $father_name = $_POST['father_name'];
        $father_contact = $_POST['father_contact'];
        $mother_name = $_POST['mother_name'];
        $address = $_POST['address'];
        $fee = $_POST['fee'];
        $submit_fee = $_POST['submit_fee'];
        $due_fee = $_POST['due_fee'];
        $payment_screenshotName = $_FILES['payment_screenshot']['name'];
        $payment_screenshotTmpName = $_FILES['payment_screenshot']['tmp_name'];
        move_uploaded_file($payment_screenshotTmpName, "paid_fee_screen_shot/$payment_screenshotName");
        if ($submit_fee <= $fee) {
            $insertFee = "INSERT INTO paid_fee (school_id,name,class,section,dob,roll_number,father_name,father_contact,mother_name,address,fee,submit_fee,payment_screenshot,due_fee) VALUES ('$school_id','$name','$class','$section','$dob','$roll_number','$father_name','$father_contact','$mother_name','$address','$fee','$submit_fee','$payment_screenshotName','$due_fee')";
            if (mysqli_query($conn, $insertFee)) {
                echo "
                <script>
                    alert('Fee submited successfully');
                    window.location.href='user_dashboard.php';
                </script>
            ";
            }
        } else {
            echo "
            <script>
                alert('Enter valid fee');
            </script>
        ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Submission Form</title>
    <!-- this should go after your </body> -->
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
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
        }

        .form-actions button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-actions button.back {
            background-color: #007BFF;
        }

        .form-actions button:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>
    <div class="form-container">
        <h2>Fee Submission Form</h2>
        <div class="image-container">
            <img src="admin/qr_code/<?= $qr_code ?>" height="130px" width="130px" alt="School Qr Code">
        </div>
        <div class="account-details">
            <h3>Bank Details</h3>
            <p><strong>Account Number:</strong> <?= $res['account_number'] ?></p>
            <p><strong>IFSC Code:</strong> <?= $res['ifsc_code'] ?></p>
            <p><strong>Bank Name:</strong> <?= $res['bank_name'] ?></p>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="school_id">School ID</label>
            <input type="text" id="school_id" value="<?= $_SESSION['school_id'] ?>" name="school_id" readonly>

            <label for="name">Student Name</label>
            <input type="text" id="name" name="name" value="<?= $_SESSION['std_name'] ?>" readonly>

            <label for="class">Class</label>
            <select id="class" name="class" style="pointer-events: none; background-color: #f0f0f0;">
                <option value="">Select Class</option>
                <option value="1" <?= $_SESSION['class'] == 1 ? 'selected' : '' ?>>Class 1</option>
                <option value="2" <?= $_SESSION['class'] == 2 ? 'selected' : '' ?>>Class 2</option>
                <option value="3" <?= $_SESSION['class'] == 3 ? 'selected' : '' ?>>Class 3</option>
                <option value="4" <?= $_SESSION['class'] == 4 ? 'selected' : '' ?>>Class 4</option>
                <option value="5" <?= $_SESSION['class'] == 5 ? 'selected' : '' ?>>Class 5</option>
                <option value="6" <?= $_SESSION['class'] == 6 ? 'selected' : '' ?>>Class 6</option>
                <option value="7" <?= $_SESSION['class'] == 7 ? 'selected' : '' ?>>Class 7</option>
                <option value="8" <?= $_SESSION['class'] == 8 ? 'selected' : '' ?>>Class 8</option>
                <option value="9" <?= $_SESSION['class'] == 9 ? 'selected' : '' ?>>Class 9</option>
                <option value="10" <?= $_SESSION['class'] == 10 ? 'selected' : '' ?>>Class 10</option>
                <option value="11" <?= $_SESSION['class'] == 11 ? 'selected' : '' ?>>Class 11</option>
                <option value="12" <?= $_SESSION['class'] == 12 ? 'selected' : '' ?>>Class 12</option>
            </select>


            <label for="section">Section</label>
            <select id="section" name="section" style="pointer-events: none; background-color: #f0f0f0;">
                <option value="">Select Section</option>
                <option value="A" <?= $_SESSION['section'] == 'A' ? 'selected' : '' ?>>Section A</option>
                <option value="B" <?= $_SESSION['section'] == 'B' ? 'selected' : '' ?>>Section B</option>
                <option value="C" <?= $_SESSION['section'] == 'C' ? 'selected' : '' ?>>Section C</option>
                <option value="D" <?= $_SESSION['section'] == 'D' ? 'selected' : '' ?>>Section D</option>
                <option value="E" <?= $_SESSION['section'] == 'E' ? 'selected' : '' ?>>Section E</option>
                <option value="F" <?= $_SESSION['section'] == 'F' ? 'selected' : '' ?>>Section F</option>
            </select>

            <label for="dob">Date of Birth</label>
            <input type="text" id="dob" name="dob" class="bod-picker" style="cursor: pointer;" placeholder="Select DOB">

            <label for="roll_number">Roll Number</label>
            <input type="text" id="roll_number" name="roll_number" value="<?= $_SESSION['roll_number'] ?>" readonly>

            <label for="father_name">Father's Name</label>
            <input type="text" id="father_name" name="father_name">

            <label for="father_contact">Father's Contact</label>
            <input type="tel" id="father_contact" name="father_contact">

            <label for="mother_name">Mother's Name</label>
            <input type="text" id="mother_name" name="mother_name">

            <label for="address">Address</label>
            <input type="text" id="address" name="address">

            <label for="fee">Fee Amount</label>
            <input type="number" id="fee" name="fee" value="<?= $feeData ?>" readonly>

            <label for="submit_fee">Submit Fee</label>
            <input type="number" id="submit_fee" name="submit_fee" oninput="checkDueFee()">

            <label for="due_fee">Due Fee</label>
            <input type="number" id="due_fee" name="due_fee" readonly>

            <label for="payment_screenshot">Fee Screenshot</label>
            <input type="file" id="payment_screenshot" name="payment_screenshot">

            <div class="form-actions">
                <button type="submit">Submit</button>
                <button type="button" class="back" onclick="window.location.href='user_dashboard.php';">Back to Dashboard</button>
            </div>
        </form>
    </div>



    <script>
        // check due fee payment
        const checkDueFee = () => {
            let feeAmount = document.getElementById("fee").value;
            let submit_fee = document.getElementById("submit_fee").value;
            let mainDueFee = feeAmount - submit_fee;
            document.getElementById("due_fee").value = mainDueFee;

        }

        // nepali calender code here
        $(".bod-picker").nepaliDatePicker({
            dateFormat: "%d %M, %y",
            closeOnDateSelect: true
        });

        $("#clear-bth").on("click", function(event) {
            $(".bod-picker").val('');
        });
    </script>
</body>

</html>