<?php
    require_once('connect_database.php');
    $dbHost = $_SERVER['SERVER_NAME'];
    $dbName = "inb201project";
    $dbUser = "teamtouch";
    $dbPassword = "JFQQ4v2rXs";
    
    /*
    global $resource;
    
    $sql = "SQL STATEMENT";
    $records = mysql_query($sql, $resource)
        or die("Problem reading table: " . mysql_error());
    
    $resuts = mysql_fetch_array($records);
    
    return 
    */
    
    function checkStaffExists($username)
    {
        global $resource;
        $sql = "SELECT *
                FROM staff
                WHERE username = '$username'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        
        return mysql_num_rows($records);
    }
    
    function staffInfoUsername($username)
    {
        global $resource;
        $sql = "SELECT staffID, username, firstName, surname, dateOfBirth, phoneNumber, salary, position, ward
                FROM staff
                WHERE username = '$username'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());

        return mysql_fetch_array($records);
    }
    
    function staffInfoId($id)
    {
        global $resource;
        $sql = "SELECT staffID, username, firstName, surname, dateOfBirth, phoneNumber, salary, position, ward
                FROM staff
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());

        return mysql_fetch_array($records);
    }
    
    function addStaff($username, $firstName, $surname, $dateOfBirth, $phoneNumber, $salary, $position, $ward, $hash)
    {
        global $resource;
        $sql = "SELECT *
                FROM staff";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        
        $count = mysql_num_rows($records);
        $sql = "INSERT INTO staff (staffID, username, firstName, surname, dateOfBirth, phoneNumber, salary, position, ward, hash)
                VALUES ('$count', '$username', '$firstName', '$surname', '$dateOfBirth', '$phoneNumber', '$salary', '$position', '$ward', '$hash')";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
    }
    
    function editStaff($id, $firstName, $surname, $dateOfBirth, $phoneNumber, $salary, $position, $ward)
    {
        global $resource;
        $sql = "UPDATE staff
                SET firstName='$firstName',
                    surname='$surname',
                    dateOfBirth='$dateOfBirth',
                    phoneNumber='$phoneNumber',
                    salary='$salary',
                    position='$position',
                    ward='$ward'
                WHERE staffID='$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
    }
    
    function changePassword($id, $hash)
    {
        global $resource;
        $sql = "UPDATE staff
                SET hash='$hash'
                WHERE staffID='$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
    }
    
    function countTable($table)
    {
        global $resource;
        $sql = "SELECT *
                FROM $table";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        return mysql_num_rows($records);
    }

    function viewTable($table)
    {
        global $resource;
        $sql = "SELECT *
                FROM $table";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        while ($row = mysql_fetch_array($records))
        {
            $results[] = $row;
        }
        if (isset($results))
        {
            return $results;
        }
        else
        {
            return null;
        }
    }
?>
