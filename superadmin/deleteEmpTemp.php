<?php
include("config/db.php");
// print_r($_GET);
$school_id = isset($_GET['school_id']) ? $_GET['school_id'] : '';
// print_r($school_id);
// Deleting templete data from the id card templete students table
$sql="DELETE FROM id_card_templates_emp WHERE school_id='$school_id'";
if(mysqli_query($conn,$sql)){
    echo "<script>
        alert('Templete Deleted succesfully');
        window.location.href='index.php';
    </script>";
}
?>