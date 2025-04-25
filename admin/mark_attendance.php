<?php
session_start();
include("DB.php");
$schoolId = $_SESSION['schoolId'];

$date = $_POST['date'];
$attendance_data = $_POST['attendance'];

foreach ($attendance_data as $student_id => $status) {
    // Fetch name, class, section from student
    $res = mysqli_query($conn, "SELECT name, class, section FROM students WHERE id='$student_id'");
    $student = mysqli_fetch_assoc($res);

    $name = $student['name'];
    $class = $student['class'];
    $section = $student['section'];

    // Prevent duplicate entry
    $check = mysqli_query($conn, "SELECT id FROM attendance WHERE student_id='$student_id' AND date='$date'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO attendance (student_id, name, class, section, date, status, school_id) 
        VALUES ('$student_id', '$name', '$class', '$section', '$date', '$status', '$schoolId')");
            echo "
            <script>
                alert('Attendence marked successfully');
                history.back();
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Attendence is allready marked');
                history.back();
            </script>
        ";
    }
}


?>


