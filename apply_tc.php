<?php
session_start();
include('admin/DB.php');
ob_start();

$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';
$std_name = isset($_SESSION['std_name']) ? $_SESSION['std_name'] : '';
$class = isset($_SESSION['class']) ? $_SESSION['class'] : '';
$section = isset($_SESSION['section']) ? $_SESSION['section'] : '';
$roll_number = isset($_SESSION['roll_number']) ? $_SESSION['roll_number'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['school_id'])) {
        echo "
            <script>
                alert('School id is required');
            </script>
        ";
    } elseif (empty($_POST['school_name'])) {
        echo "
        <script>
            alert('School Name is required');
        </script>
    ";
    } elseif (empty($_POST['name'])) {
        echo "
        <script>
            alert('Name is required');
        </script>
    ";
    } elseif (empty($_POST['class'])) {
        echo "
        <script>
            alert('Class is required');
        </script>
    ";
    } elseif (empty($_POST['section'])) {
        echo "
        <script>
            alert('Section is required');
        </script>
    ";
    } elseif (empty($_POST['dob'])) {
        echo "
        <script>
            alert('DOB is required');
        </script>
    ";
    } elseif (empty($_POST['roll_number'])) {
        echo "
        <script>
            alert('Roll Number is required');
        </script>
    ";
    } elseif (empty($_POST['father_name'])) {
        echo "
        <script>
            alert('Father Name is required');
        </script>
    ";
    } elseif (empty($_POST['mother_name'])) {
        echo "
        <script>
            alert('Mother Name is required');
        </script>
    ";
    } else {
        $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);
        $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $section = mysqli_real_escape_string($conn, $_POST['section']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $roll_number = mysqli_real_escape_string($conn, $_POST['roll_number']);
        $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
        $mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);


        // Inserting the data into the database
        $sql = "INSERT INTO request_tc (school_id, school_name, name, class, section, dob, roll_number, father_name, mother_name) 
VALUES ('$school_id', '$school_name', '$name', '$class', '$section', '$dob', '$roll_number', '$father_name', '$mother_name')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            echo "
                <script>
                    alert('Tc Applied successfully');
                    window.location.href='user_dashboard.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('Somethings went wrong');
                history.back();
            </sccript>
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
    <title>Declare Student Tc</title>
    <link rel="stylesheet" href="style.css">
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
        .container {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #004d40;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .form-group {
            flex: 1 1 calc(25% - 10px);
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group input[type="file"] {
            padding: 3px;
        }

        .form-group img {
            margin-top: 10px;
            width: 50px;
            height: 50px;
        }

        .form-actions {
            flex: 1 1 100%;
            text-align: center;
            margin-top: 20px;
        }

        .form-actions button {
            padding: 10px 20px;
            border: none;
            background-color: #004d40;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .form-actions button:hover {
            background-color: #00796b;
        }
    </style>
</head>

<body>

    <div id="google_translate_element"></div>
    <div id="main">



        <div class="main" style="padding: 20px;">
            <h2>Apply TC</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="school_id">School Id</label>
                    <input type="text" id="school_id" name="school_id" placeholder="Enter School Id" value="<?= $school_id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="school_id">School Name</label>
                    <input type="text" id="school_name" name="school_name" placeholder="Enter School Name">
                </div>
                <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" id="studentName" name="name" value="<?= $std_name ?>" placeholder="Enter Student Name" readonly>
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <select id="class" name="class" readonly>
                        <option value="">Select Class</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = ($class == $i) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select id="section" name="section" readonly>
                        <option value="">Select</option>
                        <?php
                        $sections = ['A', 'B', 'C', 'D', 'E', 'F'];
                        foreach ($sections as $sec) {
                            $selected = ($section == $sec) ? 'selected' : '';
                            echo "<option value='$sec' $selected>$sec</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Student DOB</label>
                    <input type="text" name="dob" id="dob" class="bod-picker" placeholder="Select dob">
                </div>
                <div class="form-group">
                    <label for="rollNumber">Student Roll Number</label>
                    <input type="text" name="roll_number" id="rollNumber" value="<?= $roll_number ?>" placeholder="Enter Roll Number" readonly>
                </div>
                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" id="fatherName" name="father_name" placeholder="Enter Father's Name">
                </div>
                <div class="form-group">
                    <label for="mothername">Mother Name</label>
                    <input type="text" id="mothername" name="mother_name" placeholder="Enter Mother's Name">
                </div>
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='user_dashboard.php'" style="background-color:rgb(147, 11, 150);">Back to Dashboard</button>
                    <button type="submit">Submit</button>
                </div>

            </form>

        </div>
    </div>

    <script src="script.js"></script>
    <script>
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