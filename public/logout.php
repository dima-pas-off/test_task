<?php
    session_start();
    unset($_COOKIE["login"]);
    unset($_SESSION["login"]);
    header("Location: ../auth.php");
?>