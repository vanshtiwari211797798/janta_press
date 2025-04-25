<?php
include('config/db.php');

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid JSON input']));
}

$schoolId = $data['school_id'] ?? null;
$templateData = $data['template_data'] ?? null;

if (!$schoolId || !$templateData) {
    die(json_encode(['status' => 'error', 'message' => 'Missing required fields']));
}

// Function to process images and save to uploads folder
function processImages($sideData, $sideName) {
    if (isset($sideData['background'])) {
        if (preg_match('/url\("data:image\/(\w+);base64,([A-Za-z0-9+\/=]+)"\)/', $sideData['background'], $matches)) {
            $imageType = $matches[1];
            $base64Data = $matches[2];
            $imagePath = 'uploads/' . uniqid('id_card_'.$sideName.'_') . '.' . $imageType;
            file_put_contents($imagePath, base64_decode($base64Data));
            $sideData['background'] = $imagePath;
        }
    }

    if (isset($sideData['elements']) && is_array($sideData['elements'])) {
        foreach ($sideData['elements'] as &$element) {
            if ($element['type'] === 'image' && strpos($element['content'], 'data:image/') === 0) {
                if (preg_match('/data:image\/(\w+);base64,([A-Za-z0-9+\/=]+)/', $element['content'], $matches)) {
                    $imageType = $matches[1];
                    $base64Data = $matches[2];
                    $filename = 'uploads/' . uniqid('element_'.$sideName.'_') . '.' . $imageType;
                    file_put_contents($filename, base64_decode($base64Data));
                    $element['content'] = $filename;
                }
            }
        }
    }

    return $sideData;
}

// Process template
if (isset($templateData['front'])) {
    $templateData['front'] = processImages($templateData['front'], 'front');
}
if (isset($templateData['back'])) {
    $templateData['back'] = processImages($templateData['back'], 'back');
}

// Insert into DB
$templateJson = json_encode($templateData);

$stmt = $conn->prepare("INSERT INTO id_card_templates (school_id, template_data) VALUES (?, ?)");
$stmt->bind_param("is", $schoolId, $templateJson);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Template saved successfully',
        'template_id' => $stmt->insert_id
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();