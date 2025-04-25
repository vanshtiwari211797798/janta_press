<?php
session_start();
include("admin/DB.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data and escape special characters
    $school_id = mysqli_real_escape_string($conn, trim($_POST['school_id']));
    $class = mysqli_real_escape_string($conn, trim($_POST['class']));
    $section = mysqli_real_escape_string($conn, trim($_POST['section']));
    $roll_number = mysqli_real_escape_string($conn, trim($_POST['roll_number']));
    // No password field is being verified now

    if (empty($school_id) || empty($class) || empty($section) || empty($roll_number)) {
        $error_message = "All fields are required.";
    } else {
        // Query to check the student's existence based on school_id, class, section, and roll_number
        $sql = "SELECT * FROM students WHERE school_id = '$school_id' AND class = '$class' AND section = '$section' AND roll_number = '$roll_number'";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $student = mysqli_fetch_assoc($result);
            $_SESSION['std_name'] = $student['name'];
            $_SESSION['school_id'] = $student['school_id'];
            $_SESSION['class'] = $student['class'];
            $_SESSION['section'] = $student['section'];
            $_SESSION['roll_number'] = $student['roll_number'];
            header("Location: user_dashboard.php");
            exit;
        } else {
            $error_message = "Student not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Login</title>
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
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        input:focus,
        select:focus {
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-btn {
            width: 100%;
            padding: 12px;
            background-color: #ccc;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #999;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        @media screen and (max-width: 768px) {
            .login-form {
                padding: 20px;
            }

            h2 {
                font-size: 22px;
            }

            input,
            select {
                padding: 8px;
                font-size: 14px;
            }

            button,
            .back-btn {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>
    <div class="container">
        <div class="login-form">
            <h2>Student Login</h2>
            <?php if (isset($error_message)) {
                echo "<div class='error'>$error_message</div>";
            } ?>
            <form id="loginForm" method="post">
                <div class="input-group">
                    <label for="school_id">School ID</label>
                    <input type="text" id="school_id" name="school_id" required>
                </div>

                <div class="input-group">
                    <label for="class">Class</label>
                    <select id="class" name="class" required>
                        <option value="">Select Class</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="section">Section</label>
                    <select id="section" name="section" required>
                        <option value="">Select Section</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="roll_number">Roll Number</label>
                    <input type="text" id="roll_number" name="roll_number" required>
                </div>

                <!-- No password field anymore -->
                <button type="submit" class="btn">Login</button>
                <button type="button" style="margin-top: 15px;" class="back-btn" onclick="history.back()">Back</button>
            </form>
        </div>
    </div>
</body>

</html>