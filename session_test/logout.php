<?php
    session_start();
    session_destroy();
    header('Location: http://localhost/pldt_dash/session_test/login.php');
?>