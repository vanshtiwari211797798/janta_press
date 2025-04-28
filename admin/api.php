<?php
include("DB.php");

header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata'); // Set timezone

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;
$current_date = date('Y-m-d');

if (!$id) {
    echo json_encode(["status" => "invalid_id"]);
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

// Check today's attendance count
$checkCountQuery = "
    SELECT COUNT(*) AS count, MAX(created_at) AS last_entry 
    FROM attendance 
    WHERE student_id = '$id' AND date = '$current_date'
";
$checkCountResult = mysqli_query($conn, $checkCountQuery);
$attendanceData = mysqli_fetch_assoc($checkCountResult);

$attendanceCount = (int)$attendanceData['count'];
$lastAttendanceTime = $attendanceData['last_entry'];

if ($attendanceCount >= 2) {
    echo json_encode(["status" => "max_attendance_reached"]);
    exit;
}

if ($lastAttendanceTime) {
    $lastAttendanceTimeObj = new DateTime($lastAttendanceTime);
    $currentTime = new DateTime();

    $interval = $currentTime->getTimestamp() - $lastAttendanceTimeObj->getTimestamp();
    if ($interval < 60) { // Minimum 1-minute interval
        echo json_encode(["status" => "wait_one_minute"]);
        exit;
    }
}

// Prepare attendance data
$student_id = mysqli_real_escape_string($conn, $student['id']);
$name = mysqli_real_escape_string($conn, $student['name']);
$class = mysqli_real_escape_string($conn, $student['class']);
$section = mysqli_real_escape_string($conn, $student['section']);
$school_id = mysqli_real_escape_string($conn, $student['school_id']);
$status = "Present";

// Insert attendance
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