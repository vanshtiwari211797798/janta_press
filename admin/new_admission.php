<!-- submit logic of the form -->
<?php
session_start();
$school_id = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
include("DB.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $school_id = $_POST['school_id'];
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $aadhar_number = $_POST['aadhar_number'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $parent_contact = $_POST['parent_contact'];
    $previous_school = $_POST['previous_school'];
    $total_fee = $_POST['total_fee'];
    $submited_fee = $_POST['submited_fee'];
    $due_fee = $_POST['due_fee'];
    $photoName = $_FILES['photo']['name'];
    $photoNameTmp = $_FILES['photo']['tmp_name'];

    // uploading the file
    move_uploaded_file($photoNameTmp, "new_admissionPhoto/$photoName");
    $sql = "INSERT INTO new_admission (school_id,full_name,dob,gender,class,section,aadhar_number,father_name,mother_name,parent_contact,previous_school,total_fee,submited_fee,due_fee,photo) VALUES ('$school_id','$full_name','$dob','$gender','$class','$section','$aadhar_number','$father_name','$mother_name','$parent_contact','$previous_school','$total_fee','$submited_fee','$due_fee','$photoName')";

    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Admission successfully');
                window.location.href='show_admissions_lists.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Somethings went wrong');
        </script>
    ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Form</title>
    <!-- this should go after your </body> -->
    <script src="//code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
    <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari&display=swap" rel="stylesheet">
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

        /* @font-face {
            font-family: 'Preeti';
            src: url('preeti_font/Preeti_Normal.otf') format('opentype');
        } */

        body {
            background: #f4f4f4;
            padding: 20px;
            /* font-family: 'Preeti', sans-serif; */
        }

        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            background: #007BFF;
            color: white;
            padding: 10px;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            input,
            select {
                font-size: 14px;
            }

            button {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>
    <div class="container">
        <h2>Student Admission Form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="school_id">School Id</label>
                <input type="text" id="school_id" name="school_id" value="<?= $school_id ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="full_name" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="text" style="cursor: pointer;"  placeholder="YYYY-MM-DD" id="myDate" name="dob" required>
            </div>
            <script>
                    const dateInput = document.getElementById("myDate");

                    dateInput.addEventListener("input", function(e) {
                        let value = this.value.replace(/[^0-9]/g, ""); // Remove non-numeric
                        if (value.length > 4) {
                            value = value.slice(0, 4) + "-" + value.slice(4);
                        }
                        if (value.length > 7) {
                            value = value.slice(0, 7) + "-" + value.slice(7, 9);
                        }
                        this.value = value;
                    });
                </script>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="class">Class</label>
                <select id="section" name="class">
                    <option value="">Select</option>
                    <?php
                    $fetchClass = "SELECT class FROM addclass WHERE school_id='$school_id'";
                    $classList = mysqli_query($conn, $fetchClass);
                    if (mysqli_num_rows($classList) > 0) {
                        while ($classData = mysqli_fetch_assoc($classList)) {


                    ?>
                            <option value="<?= $classData['class'] ?>"><?= $classData['class'] ?></option>
                    <?php
                        }
                    } else {
                        echo "<option value=''>Please enter class by admin panel</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="section">Section</label>
                <select id="section" name="section">
                    <option value="">Select</option>
                    <?php
                    $fetchClass = "SELECT section FROM addsection WHERE school_id='$school_id'";
                    $classList = mysqli_query($conn, $fetchClass);
                    if (mysqli_num_rows($classList) > 0) {
                        while ($classData = mysqli_fetch_assoc($classList)) {


                    ?>
                            <option value="<?= $classData['section'] ?>"><?= $classData['section'] ?></option>
                    <?php
                        }
                    } else {
                        echo "<option value=''>Please enter class by admin panel</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="aadhar">Aadhar Number</label>
                <input type="text" id="aadhar" name="aadhar_number" required>
            </div>

            <div class="form-group">
                <label for="fatherName">Father's Name</label>
                <input type="text" id="fatherName" name="father_name" required>
            </div>

            <div class="form-group">
                <label for="motherName">Mother's Name</label>
                <input type="text" id="motherName" name="mother_name" required>
            </div>

            <div class="form-group">
                <label for="contact">Parent Contact Number</label>
                <input type="text" id="contact" name="parent_contact" required>
            </div>

            <div class="form-group">
                <label for="prevSchool">Previous School (if any)</label>
                <input type="text" id="prevSchool" name="previous_school">
            </div>

            <div class="form-group">
                <label for="total_fee">Total Fee</label>
                <input type="text" id="total_fee" name="total_fee" readonly>
            </div>
            <div class="form-group">
                <label for="submited_fee">Submited Fee</label>
                <input type="text" id="submited_fee" name="submited_fee" oninput="calculateMyDuePayment()">
            </div>
            <div class="form-group">
                <label for="due_fee">Due Fee (if any)</label>
                <input type="text" id="due_fee" name="due_fee" readonly>
            </div>
            <div class="form-group">
                <label for="profilePhoto">Profile Photo</label>
                <input type="file" id="profilePhoto" name="photo">
            </div>

            <button type="submit">Submit Admission</button>

        </form>
    </div>


    <!-- javascript here -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("class").addEventListener("change", function() {
                var selectedClass = this.value;
                var schoolId = document.getElementById("school_id").value;

                if (selectedClass) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "fetch_fee.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.getElementById("total_fee").value = xhr.responseText;
                        }
                    };

                    xhr.send("class=" + selectedClass + "&school_id=" + schoolId);
                }
            });
        });


        // auto calculate the due fee of the student at admission time

        const calculateMyDuePayment = () => {
            let total_fee = document.getElementById("total_fee").value;
            let submited_fee = document.getElementById("submited_fee").value;
            let dueFee = (total_fee) - (submited_fee);
            document.getElementById("due_fee").value = dueFee;
        }


        // nepali calender code here
    </script>



</body>

</html>