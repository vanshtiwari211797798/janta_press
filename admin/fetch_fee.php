<?php
include("DB.php");

if (isset($_POST['class']) && isset($_POST['school_id'])) {
    $class = $_POST['class'];
    $school_id = $_POST['school_id'];

    // Fetch fee from admission_fee_struc table
    $query = "SELECT fee FROM admission_fee_struc WHERE school_id='$school_id' AND class='$class'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['fee']; // Return the fee amount
    } else {
        echo "0"; // If no fee found, return 0
    }
}
?>
