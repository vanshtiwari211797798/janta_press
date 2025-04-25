<!-- submit logic of the form -->
<?php
session_start();
include("DB.php");
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['uid'];
    $oldimg = $_POST['old_img'];
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
    $admission_status = $_POST['admission_status'];
    if (empty($_FILES['photo']['name'])) {
        $photoName = $oldimg;
    } else {
        $photoName = $_FILES['photo']['name'];
        $photoNameTmp = $_FILES['photo']['tmp_name'];
        move_uploaded_file($photoNameTmp, "new_admissionPhoto/$photoName");
    }

    // uploading the file
    $sql = "UPDATE new_admission SET 
    school_id = '$school_id',
    full_name = '$full_name',
    dob = '$dob',
    gender = '$gender',
    class = '$class',
    section = '$section',
    aadhar_number = '$aadhar_number',
    father_name = '$father_name',
    mother_name = '$mother_name',
    parent_contact = '$parent_contact',
    previous_school = '$previous_school',
    total_fee = '$total_fee',
    submited_fee = '$submited_fee',
    due_fee = '$due_fee',
    photo = '$photoName',
    admission_status='$admission_status'
WHERE id = '$uid'";


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


// fetch data based on the id
$sql2 = "SELECT * FROM new_admission WHERE id=$id";
$data = mysqli_query($conn, $sql2);
if (mysqli_num_rows($data) > 0) {
    $resData = mysqli_fetch_assoc($data);
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

    <div class="container">
        <h2>Student Admission Form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="uid" value="<?= $resData['id'] ?>">
            <input type="hidden" name="old_img" value="<?= $resData['photo'] ?>">
            <div class="form-group">
                <label for="school_id">School Id</label>
                <input type="text" id="school_id" name="school_id" value="<?= $resData['school_id'] ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="full_name" value="<?= $resData['full_name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="text" id="dob" name="dob" class="bod-picker" placeholder="Select Date of Birth" value="<?= $resData['dob'] ?>" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select</option>
                    <option value="Male" <?= $resData['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $resData['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= $resData['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="class">Class</label>
                <select id="class" name="class" required>
                    <option value="">Select Class</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo '<option value="' . $i . '" ' . ($resData['class'] == $i ? 'selected' : '') . '>Class ' . $i . '</option>';
                    }
                    ?>

                </select>
            </div>

            <div class="form-group">
                <label for="section">Section</label>
                <select id="section" name="section" required>
                    <option value="">Select Section</option>
                    <?php
                    $sections = ['A', 'B', 'C', 'D', 'E', 'F'];
                    foreach ($sections as $sec) {
                        echo '<option value="' . $sec . '" ' . ($resData['section'] == $sec ? 'selected' : '') . '>Section ' . $sec . '</option>';
                    }
                    ?>

                </select>
            </div>

            <div class="form-group">
                <label for="aadhar">Aadhar Number</label>
                <input type="text" id="aadhar" name="aadhar_number" value="<?= $resData['aadhar_number'] ?>" required>
            </div>

            <div class="form-group">
                <label for="fatherName">Father's Name</label>
                <input type="text" id="fatherName" name="father_name" value="<?= $resData['father_name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="motherName">Mother's Name</label>
                <input type="text" id="motherName" name="mother_name" value="<?= $resData['mother_name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="contact">Parent Contact Number</label>
                <input type="tel" id="contact" name="parent_contact" value="<?= $resData['parent_contact'] ?>" required>
            </div>

            <div class="form-group">
                <label for="prevSchool">Previous School (if any)</label>
                <input type="text" id="prevSchool" name="previous_school" value="<?= $resData['previous_school'] ?>">
            </div>

            <div class="form-group">
                <label for="total_fee">Total Fee</label>
                <input type="text" id="total_fee" name="total_fee" value="<?= $resData['total_fee'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="submited_fee">Submited Fee</label>
                <input type="text" id="submited_fee" name="submited_fee" value="<?= $resData['submited_fee'] ?>" oninput="calculateMyDuePayment()">
            </div>
            <div class="form-group">
                <label for="due_fee">Due Fee (if any)</label>
                <input type="text" id="due_fee" name="due_fee" value="<?= $resData['due_fee'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="class">Admission status</label>
                <select id="admission_status" name="admission_status" required>
                    <option value="">Select status</option>
                    <option value="Approved" <?= $resData['admission_status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="Pending" <?= $resData['admission_status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>

                </select>
            </div>
            <div class="form-group">
                <label for="profilePhoto">Profile Photo</label>
                <input type="file" id="profilePhoto" name="photo">
            </div>
            <img src="new_admissionPhoto/<?= $resData['photo'] ?>" height="70px" width="70px" alt="student photo">

            <button type="submit">Submit Admission</button>

        </form>
    </div>


    <!-- javascript here -->
    <script>
        // auto calculate the due fee of the student at admission time

        const calculateMyDuePayment = () => {
            let total_fee = document.getElementById("total_fee").value;
            let submited_fee = document.getElementById("submited_fee").value;
            let dueFee = (total_fee) - (submited_fee);
            document.getElementById("due_fee").value = dueFee;
        }


        $(".bod-picker").nepaliDatePicker({
            dateFormat: "%D, %M %d, %y",
            closeOnDateSelect: true
        });

        $("#clear-bth").on("click", function(event) {
            $(".bod-picker").val('');
        });
    </script>

</body>

</html>