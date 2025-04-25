<?php
include("DB.php");
$status=isset($_GET['status']) ? $_GET['status'] : '';
$id=isset($_GET['id']) ? $_GET['id'] : '';
$sql="UPDATE paid_fee SET payment_status='$status' WHERE id=$id";
if(mysqli_query($conn,$sql)){
    echo "
        <script>
            alert('Payment $status Successfully');
            history.back();
        </script>
    ";
}
?>