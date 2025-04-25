<?php
include("DB.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM employee WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Employee Deleted Successfully');
                window.location.href='Id-Generate.php';
            </script>
        ";
    }
} else {
    header('Location:Id-Generate.php');
}
