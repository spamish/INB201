<?php
    $dbHost = $_SERVER['SERVER_NAME'];
    $dbName = "inb201project";
    $dbUser = "teamtouch";
    $dbPassword = "JFQQ4v2rXs";
    
    $resource = mysql_connect($dbHost, $dbUser, $dbPassword)
        or die("Could not connect: " . mysql_error());
    mysql_select_db($dbName, $resource)
        or die("Could not find database: " . mysql_error());
?>