<?php
session_start();

// Unset specific session variables
unset($_SESSION['std_name']);
unset($_SESSION['school_id']);
unset($_SESSION['class']);
unset($_SESSION['section']);
unset($_SESSION['roll_number']);

echo "
    <script>
        alert('Logout successfully');
        window.location.href='stdlogin.php';
    </script>
";
exit;
?>
