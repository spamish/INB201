<?php
    class Connection
    {
        public function Connect()
        {
            $dbHost = $_SERVER['SERVER_NAME'];
            $dbName = "inb201project";
            $dbUser = "teamtouch";
            $dbPassword = "JFQQ4v2rXs";
            
            $dbResource = mysql_connect($dbHost, $dbUser, $dbPassword);
            mysql_select_db($dbName, $dbResource);
        
            return $dbResource;
        }
    }
?>