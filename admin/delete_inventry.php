<?php
include 'DB.php';

$id = $_GET['id'];

$sql = "DELETE FROM inventorys WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: inventry.php"); 
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
