<?php
include("DB.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM admission_fee_struc WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "
            <script>
                alert('Admission Fee structure Deleted Successfully');
                window.location.href='add_admission_fee_struture.php';
            </script>
        ";
    }
} else {
    header('Location:add_admission_fee_struture.php');
}
