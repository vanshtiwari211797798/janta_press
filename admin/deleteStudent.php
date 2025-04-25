<?php
include("DB.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Student Deleted Successfully');
                window.location.href='view-student.php';
            </script>
        ";
    }
} else {
    header('Location:view-student.php');
}
