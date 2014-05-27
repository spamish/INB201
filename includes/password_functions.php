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
        $results = mysql_fetch_array($records);
        
        return password_verify($password, $results['hash']);
    }
    
    function changePassword($id, $password)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $hash = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = "UPDATE staff
                SET hash = '$hash'
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource);
    }
?>