<?php
include("config/db.php");
header('Content-Type: application/json');

// Get parameters from the query string
$schoolId = $_GET['school_id'] ?? null;


if (!$schoolId) {
    echo json_encode(['error' => 'School ID is required']);
    exit;
}

// Base query
$query = "SELECT * FROM employee WHERE school_id = ?";
$params = [$schoolId];
$types = "s";

// // Apply additional filtering if class and/or section are provided
// if (!empty($class)) {
//     $query .= " AND class = ?";
//     $params[] = $class;
//     $types .= "s";
// }

// if (!empty($section)) {
//     $query .= " AND section = ?";
//     $params[] = $section;
//     $types .= "s";
// }

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = [
        'id' => $row['id'],
        'emp_name' => $row['emp_name'],
        'husband_or_father' => $row['husband_or_father'],
        'gender' => $row['gender'],
        'contact' => $row['contact'],
        'address' => $row['address'],
        'rfid' => $row['rfid'],
        'designation' => $row['designation'],
        'dob' => $row['dob'],
        'photo' => $row['photo'],
        'category' => $row['category'],
        'emp_n_name' => $row['emp_n_name'],
        'gender_n' => $row['gender_n'],
        'dob_n' => $row['dob_n'],
        'husbend_father_n' => $row['husbend_father_n'],
        'contact_n' => $row['contact_n'],
        'address_n' => $row['address_n'],
        'desiginition_n' => $row['desiginition_n'],
        'blood_grp' => $row['blood_grp'],
        'blood_grp_n' => $row['blood_grp_n'],
        'citizenship_number' => $row['citizenship_number'],
        'citizenship_number_n' => $row['citizenship_number_n'],
        'shaatrall_number' => $row['shaatrall_number'],      
        'shaatrall_number_n' => $row['shaatrall_number_n'],
        'pan_number' => $row['pan_number'],
        'pan_number_n' => $row['pan_number_n']
    ];
}

echo json_encode(['students' => $students]);
?>