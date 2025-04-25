<?php
include("DB.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM holidays WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Holiday Deleted Successfully');
                window.location.href='Add-Holiday.php';
            </script>
        ";
    }
} else {
    header('Location:view-student.php');
}
