<?php
    session_start();
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != ""))
    {
        header ("Location: http://" . $_SERVER['SERVER_NAME'] . "/inb201/index.php");
    }
?>