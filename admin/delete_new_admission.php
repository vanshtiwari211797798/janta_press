<?php
    include("DB.php");
    $id=isset($_GET['id']) ? $_GET['id'] : '';
    $sql="DELETE FROM new_admission WHERE id=$id";
    if(mysqli_query($conn,$sql)){
        echo "
            <script>
                alert('Admission Deleted Successfully');
                history.back();
            </script>
        ";
    }
?>