<?php
// Database connection
include("config/db.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM id_card_templates_emp WHERE school_id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Assuming the 'template_data' column contains JSON formatted string.
    $templateData = json_decode($row['template_data'], true);  // Decode to an array
    echo json_encode($templateData); // Return the template data as JSON
} else {
    echo json_encode(["error" => "No data found"]);
}
$conn->close();
?>
