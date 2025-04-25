<?php
session_start();
include("DB.php");

$myschool_id = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
// update the school information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $school_id = isset($_POST['school_id']) ? $_POST['school_id'] : '';
    $school_name = isset($_POST['school_name']) ? $_POST['school_name'] : '';
    $school_disc_code = isset($_POST['school_disc_code']) ? $_POST['school_disc_code'] : '';
    $school_registration = isset($_POST['school_registration']) ? $_POST['school_registration'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $district = isset($_POST['district']) ? $_POST['district'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $pin_code = isset($_POST['pin_code']) ? $_POST['pin_code'] : '';
    $primary_school_contact = isset($_POST['primary_school_contact']) ? $_POST['primary_school_contact'] : '';
    $secondary_school_contact = isset($_POST['secondary_school_contact']) ? $_POST['secondary_school_contact'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $school_address_1 = isset($_POST['school_address_1']) ? $_POST['school_address_1'] : '';
    $school_address_2 = isset($_POST['school_address_2']) ? $_POST['school_address_2'] : '';
    $school_website = isset($_POST['school_website']) ? $_POST['school_website'] : '';
    $db_version = isset($_POST['db_version']) ? $_POST['db_version'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $attendence_machine_msg_student = isset($_POST['attendence_machine_msg_student']) ? $_POST['attendence_machine_msg_student'] : '';
    $attendence_machine_self = isset($_POST['attendence_machine_self']) ? $_POST['attendence_machine_self'] : '';
    $principal_name = isset($_POST['principal_name']) ? $_POST['principal_name'] : '';
    $principal_contact = isset($_POST['principal_contact']) ? $_POST['principal_contact'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $remark = isset($_POST['remark']) ? $_POST['remark'] : '';


    $principal_seal = isset($_FILES['principal_seal']) ? $_FILES['principal_seal']['name'] : '';
    $principal_signature = isset($_FILES['principal_signature']) ? $_FILES['principal_signature']['name'] : '';
    $logo = isset($_FILES['logo']) ? $_FILES['logo']['name'] : '';



    $principal_sealTmp = isset($_FILES['principal_seal']) ? $_FILES['principal_seal']['tmp_name'] : '';
    $principal_signatureTmp = isset($_FILES['principal_signature']) ? $_FILES['principal_signature']['tmp_name'] : '';
    $logoTmp = isset($_FILES['logo']) ? $_FILES['logo']['tmp_name'] : '';

    move_uploaded_file($principal_sealTmp, "add_school_img/$principal_seal");
    move_uploaded_file($principal_signatureTmp, "add_school_img/$principal_signature");
    move_uploaded_file($logoTmp, "add_school_img/$logo");
    $sql = "UPDATE add_school 
    SET 
        school_name='$school_name',
        school_disc_code='$school_disc_code',
        school_registration='$school_registration',
        country='$country',
        state='$state',
        district='$district',
        city='$city',
        pin_code='$pin_code', 
        primary_school_contact='$primary_school_contact',
        secondary_school_contact='$secondary_school_contact', 
        email='$email',
        school_address_1='$school_address_1',
        school_address_2='$school_address_2',
        school_website='$school_website',
        db_version='$db_version',
        password='$password',
        attendence_machine_msg_student='$attendence_machine_msg_student',
        attendence_machine_self='$attendence_machine_self',
        principal_name='$principal_name',
        principal_contact='$principal_contact',
        date='$date',
        principal_seal='$principal_seal',
        principal_signature='$principal_signature',
        logo='$logo',
        remark='$remark' 
    WHERE school_id='$myschool_id'";


    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
        alert('School data updated successfully');
            window.location.href='Dashboard.php';
        </script>
    ";
    }
}


$school_id = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
$password = isset($_SESSION['Schoolpassword']) ? $_SESSION['Schoolpassword'] : '';
$sql = "SELECT * FROM add_school WHERE school_id='$school_id'";
$data = mysqli_query($conn, $sql);
if (mysqli_num_rows($data) > 0) {
    $record = mysqli_fetch_assoc($data);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>School General Info</title>
        <link rel="stylesheet" href="style.css">
        <!-- this should go after your </body> -->
        <link rel="stylesheet" href="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css">
        <script src="//code.jquery.com/jquery-3.7.1.min.js"></script> <!-- Slim नहीं, full version -->
        <script src="//unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js"></script>
        <style>
            .main {
                flex: 1;
                padding: 20px;
                box-sizing: border-box;
            }

            .form-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #f9f9f9;
            }

            .form-container h3 {
                margin-bottom: 20px;
                color: #2966c2;
            }

            .form-group {
                display: flex;
                justify-content: space-between;
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-size: 14px;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
            }

            .form-group input[type="file"] {
                width: auto;
            }

            .form-group .field {
                width: 24%;
                display: flex;
                flex-direction: column;
            }

            .form-group .full-width {
                width: 100%;
            }

            .submit-button {
                text-align: center;
            }

            .submit-button button {
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .submit-button button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>

    <body>
        <div id="nav">
            <a href='Dashboard.php'><img id="logo" src="janta_logo.jpeg" alt=""></a>
            <a href="index.php">
                <h2 id="logout">Logout</h2>
            </a>
        </div>

        <div id="main">
            <div id="left-slider">
                <div class="sidebar">
                    <h2>Menu</h2>
                    <a href="Dashboard.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Dashboard')">Dashboard</a>
                    <a href="student-Management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Student')">Student</a>
                    <a href="Employee-Management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Staff')">Staff</a>
                    <a href="Holiday-Management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Holiday')">Holiday</a>
                    <a href="Leave-management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Leave')">Leave</a>
                    <a href="Attendance-management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Attendance</a>
                    <a href="add_inventry.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'AddInventry')">Add Inverntry</a>
                    <a href="inventry.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'ViewInventry')">View Inventry</a>
                    <a href="tc_management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'TC')">TC</a>
                    <a href="marksheet_management.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Marksheet</a>
                    <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Admit Cart</a>
                    <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Expences</a>
                    <a href="" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'Attendance')">Transport</a>
                    <a href="student-sms.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'SMS')">SMS</a>
                    <a href="school-general-info.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'SchoolInfo')">School Info</a>
                    <!-- <a href="Dashboard.php" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'CreditDetail')">Log Out</a> -->
                </div>
            </div>

            <div class="main">
                <div class="form-container">
                    <h3>School General Info</h3>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="field">
                                <label for="school-id">School ID</label>
                                <input type="text" id="school-id" name="school_id" value="<?= $school_id ?>" readonly>
                            </div>
                            <div class="field">
                                <label for="school-name">School Name</label>
                                <input type="text" name="school_name" id="school-name" value="<?= $record['school_name'] ?>">
                            </div>
                            <div class="field">
                                <label for="school-dise-code">School Dise Code</label>
                                <input type="text" id="school-dise-code" name="school_disc_code" value="<?= $record['school_disc_code'] ?>">
                            </div>
                            <div class="field">
                                <label for="school-registration">School Registration</label>
                                <input type="text" id="school-registration" name="school_registration" value="<?= $record['school_registration'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <label for="country">Country</label>
                                <select id="country" name="country" value="<?= $record['country'] ?>">
                                    <option value="">Select Country</option>
                                    <option value="india">India</option>
                                    <option value="nepal">Nepal</option>
                                    <option value="bhopal">Bhopal</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="state">State</label>
                                <input type="text" id="state" name="state" value="<?= $record['state'] ?>">
                            </div>
                            <div class="field">
                                <label for="district">District</label>
                                <input type="text" id="district" name="district" value="<?= $record['district'] ?>">
                            </div>
                            <div class="field">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" value="<?= $record['city'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <label for="pincode">Pincode</label>
                                <input type="text" id="pincode" name="pin_code" value="<?= $record['pin_code'] ?>">
                            </div>
                            <div class="field">
                                <label for="primary-contact">Primary Contact No</label>
                                <input type="text" id="primary-contact" name="primary_school_contact" value="<?= $record['primary_school_contact'] ?>">
                            </div>
                            <div class="field">
                                <label for="secondary-contact">Secondary Contact No</label>
                                <input type="text" id="secondary-contact" name="secondary_school_contact" value="<?= $record['secondary_school_contact'] ?>">
                            </div>
                            <div class="field">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="<?= $record['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <label for="school-address1">School Address 1</label>
                                <input type="text" id="school-address1" name="school_address_1" value="<?= $record['school_address_1'] ?>">
                            </div>
                            <div class="field">
                                <label for="school-address2">School Address 2</label>
                                <input type="text" id="school-address2" name="school_address_2" value="<?= $record['school_address_2'] ?>">
                            </div>
                            <div class="field">
                                <label for="school-website">School Website</label>
                                <input type="text" id="school-website" name="school_website" value="<?= $record['school_website'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <label for="database-version">Database Version (Eg. 2.1)</label>
                                <input type="text" id="database-version" name="db_version" value="<?= $record['db_version'] ?>">
                            </div>
                            <div class="field">
                                <label for="password">Password</label>
                                <input type="text" id="password" name="password" value="<?= $password ?>" readonly>
                            </div>
                            <div class="field">
                                <label for="attendance-student">Attendance Machine Message Student</label>
                                <select id="attendance-student" name="attendence_machine_msg_student">
                                    <option value="" >Select</option>
                                    <option value="Yes" <?= $record['attendence_machine_msg_student']=='Yes' ? 'selected' : '' ?>>Yes</option>
                                    <option value="No" <?= $record['attendence_machine_msg_student']=='No' ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="field">
                                <label for="attendance-staff">Attendance Machine Message Staff</label>
                                <select id="attendance-staff" name="attendence_machine_self" >
                                    <option value="">Select</option>
                                    <option value="Yes" <?= $record['attendence_machine_self']=='Yes' ? 'selected' : '' ?>>Yes</option>
                                    <option value="No" <?= $record['attendence_machine_self']=='No' ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <label for="principal-name">Principal Name</label>
                                <input type="text" id="principal-name" name="principal_name" value="<?= $record['principal_name'] ?>">
                            </div>
                            <div class="field">
                                <label for="principal-contact">Principal Contact</label>
                                <input type="text" id="principal-contact" name="principal_contact" value="<?= $record['principal_contact'] ?>">
                            </div>
                            <div class="field">
                                <label for="date">Date</label>
                                <input type="text" id="date" name="date" class="bod-picker" placeholder="Enter Date" value="<?= $record['date'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <label for="principal-seal">Principal Seal</label>
                                <input type="file" id="principal-seal" name="principal_seal">
                            </div>
                            <div class="field">
                                <label for="principal-signature">Principal Signature</label>
                                <input type="file" id="principal-signature" name="principal_signature">
                            </div>
                            <div class="field">
                                <label for="logo">Logo</label>
                                <input type="file" id="logo" name="logo">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <label for="remark">Remark</label>
                                <textarea id="remark" class="full-width" name="remark"></textarea>
                            </div>
                        </div>
                        <div class="submit-button">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
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

<?php
}
?>