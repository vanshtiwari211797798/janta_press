<?php
include("DB.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM csv_details WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('CSV Deleted Successfully');
                window.location.href='download_csv_table.php';
            </script>
        ";
    }
} else {
    header('Location:download_csv_table.php');
}
