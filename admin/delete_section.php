<?php
include("DB.php");
if (isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    $deleteQuery = "DELETE FROM addsection WHERE id = '$deleteId'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Section deleted successfully'); window.location.href = 'add_section.php';</script>";
    } else {
        echo "<script>alert('Failed to delete Section');</script>";
    }
}
?>