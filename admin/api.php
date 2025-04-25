<?php
include("DB.php");

header('Content-Type: application/json'); // JSON output only

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;
$current_date = date('Y-m-d');

if (!$id) {
    echo json_encode(["status" => "invalid_id"]);
    exit;
}

// Check if attendance already marked
$checkQuery = "SELECT * FROM attendance WHERE student_id = '$id' AND date = '$current_date'";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo json_encode(["status" => "already_marked"]);
    exit;
}

// Fetch student details
$studentQuery = "SELECT * FROM students WHERE id = '$id'";
$studentResult = mysqli_query($conn, $studentQuery);

if (mysqli_num_rows($studentResult) === 0) {
    echo json_encode(["status" => "no_student"]);
    exit;
}

$student = mysqli_fetch_assoc($studentResult);

// Prepare attendance data
$student_id = $student['id'];
$name = $student['name'];
$class = $student['class'];
$section = $student['section'];
$school_id = $student['school_id'];
$status = "Present";

// Insert into attendance
$insertQuery = "
    INSERT INTO attendance (student_id, name, class, section, school_id, date, status) 
    VALUES ('$student_id', '$name', '$class', '$section', '$school_id', '$current_date', '$status')
";

if (mysqli_query($conn, $insertQuery)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "insert_failed",
        "error" => mysqli_error($conn)
    ]);
}
?>