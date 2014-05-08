<?php
    require_once('lib/password.php');
    require_once('connect_database.php');
    
    function verifyPassword($id, $password)
    {
        global $resource;
        
        $sql = "SELECT staffID, hash
                FROM staff
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        
        $resuts = mysql_fetch_array($records);
        $hash = $resuts["hash"];
        
        return password_verify($password, $hash);
    }
    
    function changePassword($id, $password)
    {
        global $resource;
        
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE staff
                SET hash='$hash'
                WHERE staffID='$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
    }
?>