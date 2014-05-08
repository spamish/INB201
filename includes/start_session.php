<?php
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != null))
    {
        header ("Location: http://" . $_SERVER['SERVER_NAME'] . "/inb201/index.php");
    }
?>