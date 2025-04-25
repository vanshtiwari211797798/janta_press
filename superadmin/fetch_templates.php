<?php
include("config/db.php");
$school_id = "13264";
$result = $conn->query("SELECT id, template_name FROM id_card_templates WHERE school_id = $school_id");

$templates = [];
while ($row = $result->fetch_assoc()) {
    $templates[] = $row;
}
echo json_encode($templates);
?>
