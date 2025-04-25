<?php
include("config/db.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM add_school WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
        alert('Deleted successfully');
            window.location.href='view_school.php';
        </script>
        ";
    }
} else {
    echo "
    <script>
        history.back();
    </script>
    ";
}
