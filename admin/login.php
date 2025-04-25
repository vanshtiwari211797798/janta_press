<?php
session_start();
include("DB.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['school_id'])) {
        echo "
            <script>
                alert('School Id is required');
            </script>
        ";
    } elseif (empty($_POST['password'])) {
        echo "
        <script>
            alert('Password is required');
        </script>
    ";
    } else {
        // for saving the sql injection attack
        $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM add_school WHERE school_id='$school_id' AND password='$password'";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) == 1) {
            $record = mysqli_fetch_assoc($data);
            // print_r($record);
            $_SESSION['schoolId'] = $record['school_id'];
            $_SESSION['Schoolpassword'] = $record['password'];
            echo "
                <script>
                    alert('Login Successfully');
                    window.location.href='Dashboard.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('You are not registered in our database');
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
    <title>Login Page</title>
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
        /* General Page Styles */
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Login Container */
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        /* Login Form */
        .login-form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Forgot Password Link */
        .forgot-password {
            text-align: right;
            margin-bottom: 15px;
        }

        .forgot-password a {
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        /* Login Button */
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #007BFF;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 400px) {
            .login-container {
                width: 90%;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>

    <div class="login-container">
        <form class="login-form" method="post">
            <h2>Login</h2>

            <div class="input-group">
                <label for="school_id">School Id</label>
                <input type="text" id="school_id" name="school_id" placeholder="Enter school id" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>