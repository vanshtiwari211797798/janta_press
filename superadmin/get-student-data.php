<?php
include("config/db.php");
header('Content-Type: application/json');

// Get parameters from the query string
$schoolId = $_GET['school_id'] ?? null;
$class = $_GET['class'] ?? null;
$section = $_GET['section'] ?? null;

if (!$schoolId) {
    echo json_encode(['error' => 'School ID is required']);
    exit;
}

// Base query
$query = "SELECT * FROM students WHERE school_id = ?";
$params = [$schoolId];
$types = "s";

// Apply additional filtering if class and/or section are provided
if (!empty($class)) {
    $query .= " AND class = ?";
    $params[] = $class;
    $types .= "s";
}

if (!empty($section)) {
    $query .= " AND section = ?";
    $params[] = $section;
    $types .= "s";
}

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'father_name' => $row['father_name'],
        'class' => $row['class'],
        'section' => $row['section'],
        'roll_number' => $row['roll_number'],
        'phone' => $row['father_contact'],
        'address' => $row['address'],
        'photo' => $row['photo'],
        'school_id' => $row['school_id'],
        'gender' => $row['gender'],
        'category' => $row['category'],
        'blood_grp' => $row['blood_grp'],
        'dob' => $row['dob'],
    ];
}

echo json_encode(['students' => $students]);
?>