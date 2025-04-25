<?php
include("DB.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM employee_leave WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Employee Leave Deleted Successfully');
                window.location.href='view_employee_leave.php';
            </script>
        ";
    }
} else {
    header('Location:view_employee_leave.php');
}
