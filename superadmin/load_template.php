<?php
include("config/db.php");
$template_id = 1;
$result = $conn->query("SELECT template_data FROM id_card_templates WHERE id = $template_id");

$row = $result->fetch_assoc();
echo $row['template_data'];
?>
