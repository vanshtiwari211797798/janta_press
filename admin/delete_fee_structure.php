<?php
include("DB.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM fee_structure WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Fee structure Deleted Successfully');
                window.location.href='add_fee_structure.php';
            </script>
        ";
    }
} else {
    header('Location:add_fee_structure.php');
}
