<?php
session_start();
unset($_SESSION['schoolId']);

    echo "
    <script>
        alert('Logout Successfully');
        window.location.href='login.php';
    </script>
";
