<?php
include("DB.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM student_leave WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Student Leave Deleted Successfully');
                window.location.href='viewStudentLeave.php';
            </script>
        ";
    }
} else {
    header('Location:viewStudentLeave.php');
}
