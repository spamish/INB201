<?php
    require_once('connect_database.php');
    
    function getStaffInfo($username)
    {
        global $resource;
        
        $sql = "SELECT *
                FROM staff
                WHERE username = '$username'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());

        return mysql_fetch_array($records);
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

    function viewTable($table, $order = null, $sort = null)
    {
        global $resource;
        
        //Add sorting options to view function.
        if (isset($order)):
            $sql = "SELECT *
                    FROM $table
                    ORDER BY $order $sort";
        //View sorted by id in ascending order.
        else:
            $sql = "SELECT *
                    FROM $table";
        endif;
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        
        $results[0] = null;
        
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
