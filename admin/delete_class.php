<?php
include("DB.php");
if (isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    $deleteQuery = "DELETE FROM addclass WHERE id = '$deleteId'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Class deleted successfully'); window.location.href = 'add_class.php';</script>";
    } else {
        echo "<script>alert('Failed to delete class');</script>";
    }
}
?>