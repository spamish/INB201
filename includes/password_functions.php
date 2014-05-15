<?php
    require_once('lib/password.php');
    require_once('classes.php');
    
    function verifyPassword($id, $password)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "SELECT staffID, hash
                FROM staff
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource);
        $resuts = mysql_fetch_array($records);
        $hash = $resuts["hash"];
        
        return password_verify($password, $hash);
    }
    
    function changePassword($id, $password)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "UPDATE staff
                SET hash='$hash'
                WHERE staffID='$id'";
        $records = mysql_query($sql, $resource);
    }
?>