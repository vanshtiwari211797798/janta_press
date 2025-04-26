<?php
// logout code for current login user
session_start();
unset($_SESSION['adminemail']);
echo "
        <script>
            alert('Logout successfully');
            window.location.href='login.php';
        </script>
    ";
