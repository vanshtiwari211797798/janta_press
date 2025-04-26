<?php
include('phpqrcode/qrlib.php');

$id = isset($_GET['text']) ? $_GET['text'] : '';
$school_id = isset($_GET['school_id']) ? $_GET['school_id'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$father = isset($_GET['father']) ? $_GET['father'] : '';
$size = isset($_GET['size']) ? $_GET['size'] : '100x100';

$qrData = "id: $id\nName: $name\nFather/Husbend: $father\nSchoolId: $school_id";

list($width, $height) = explode('x', $size);

// QR कोड जेनरेट करें
QRcode::png($qrData, false, QR_ECLEVEL_L, min(max(1, (int)$width/25), 2));
?>