<?php
    require_once('classes.php');
    
    function timestamp($input = null)
    {
        if (!isset($input))
        {
            $input = time();
        }
        date_default_timezone_set('Australia/Brisbane');
        return date('Y-m-d H:i:s', $input);
    }
    
    function roomNumber($string)
    {
        $length = strlen($string);
        
        for ($j = $length; $j < 6; $j++)
        {
            $string = "0" . $string;
        }
        return $string;
    }
    
    function idString($string)
    {
        $length = strlen($string);
        
        for ($j = $length; $j < 12; $j++)
        {
            $string = "0" . $string;
        }
        return $string;
    }
    
    function getStaffInfo($username)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "SELECT *
                FROM staff
                WHERE username = '$username'";
        $records = mysql_query($sql, $resource);
        
        return mysql_fetch_array($records);
    }
    
    function viewTable($table, $order = null, $sort = true)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //View sorted by id in ascending order.
        $sql = "SELECT *
                FROM $table";
        
        
        //Add sorting options to view function.
        if (isset($order))
        {
            $sql .= " ORDER BY " . $order . ($sort ? " ASC" : " DESC");
        }
        $records = mysql_query($sql, $resource);
        $results[0] = 0;
        
        while ($row = mysql_fetch_array($records))
        {
            $results[] = $row;
            $results[0]++;
        }
        
        return $results;
    }
    
    function createNote($note)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $file =  $note['file'];
        $type = $note['type'];
        $staff = $note['staff'];
        $time = timestamp();
        $details = $note['details'];
        
        $sql = "SELECT *
                FROM notes";
        $records = mysql_query($sql, $resource);
        $count = mysql_num_rows($records) + 1;
        
        $sql = "INSERT INTO notes (noteID, file, type, staff, time, details)
                VALUES ('$count', '$file', '$type', '$staff', '$time', '$details')";
        $records = mysql_query($sql, $resource);
    }
    
    function viewNotes($file, $option = null, $type = null)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //View sorted by id in ascending order.
        $sql = "SELECT *
                FROM notes
                WHERE file = '$file'";
        
        //Add sorting options to view function.
        if (isset($option))
        {
            $sql .= " AND $option = '$type'";
        }
        $records = mysql_query($sql, $resource);
        
        while ($row = mysql_fetch_array($records))
        {
            $results[] = $row;
        }
        
        return $results;
    }
    
    function searchUnidentified($forename, $postname)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //Search for the file number.
        $sql = "SELECT *
                FROM unidentified
                WHERE forename = '$forename'
                AND postname = '$postname'";
        $result = mysql_query($sql, $resource);
        return mysql_fetch_array($result);
    }
    
    function searchPatients($firstName, $surname, $gender = null, $dateOfBirth = null)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //Search for the patient number.
        $sql = "SELECT *
                FROM patients
                WHERE firstName = '$firstName'
                AND surname = '$surname'";
        
        //Inclulde if gender is specified.
        if (isset($gender))
        {
            $sql .= " AND gender = '$gender'";
        }
        //Include if date of birth is specified.
        if (isset($dateOfBirth))
        {
            $sql .= " AND dateOfBirth = '$dateOfBirth'";
        }
        $records = mysql_query($sql, $resource);
        
        $results[0] = 0;
        
        while ($row = mysql_fetch_array($records))
        {
            $results[] = $row;
            $results[0]++;
        }
        
        return $results;
    }
    
    function condition($state)
    {
        switch ($state)
        {
            case 0.5:
                return "Stable";
                break;
            case 0.7:
                return "Urgent";
                break;
            case 0.9:
                return "Critical";
                break;
        }
    }
    
    function gender($input)
    {
        switch ($input)
        {
            case "m":
                return "Male";
                break;
            case "f";
                return "Female";
                break;
        }
    }
    
    function viewCurrent($search = null, $options = null)
    {
        //$patientID, $fileID, $firstName, $surname, $roomNumber, $ward, $staff, $order
        $resource = new Connection();
        $resource = $resource->Connect();
        $results[0] = 0;
        
        //Search cases for active ones.
        $sql = "SELECT *
                FROM files
                WHERE discharge IS NULL";
        
        //Add search fields for case file.
        if (   isset($search['file'])
            || isset($search['roomNumber'])
            || isset($search['ward']))
        {
            $sql .= (isset($search['file']) ? (" AND fileID = '" . $search['file'] . "'") : "")
                  . (isset($search['roomNumber']) ? (" AND roomNumber = '" . $search['roomNumber'] . "'") : "")
                  . (isset($search['ward']) ? (" AND ward = '" . $search['ward'] . "'") : "");
        }
        
        //Add sorting options to view function.
        if (   isset($options['roomNumber'])
            || isset($options['ward']))
        {
            $sql .= " ORDER BY " . $order . ($sort ? " ASC" : " DESC");
        }
        
        $files = mysql_query($sql, $resource);
        
        if(mysql_num_rows($files))
        {
            while ($row = mysql_fetch_array($files))
            {
                if (!isset($search['patient']) || ($row['patient'] == $search['patient']))
                {
                    if ($id = $row['patient'])
                    {
                        $sql = "SELECT *
                                FROM patients
                                WHERE patientID = '$id'";
                        
                        //Add search fields for patient file.
                        if (   isset($search['firstName'])
                            || isset($search['surname']))
                        {
                            $sql .= (isset($search['firstName']) ? (" AND firstName = '" . $search['firstName'] . "'") : "")
                                  . (isset($search['surname']) ? (" AND surname = '" . $search['surname'] . "'") : "");
                        }
                        
                        $record = mysql_query($sql, $resource);
                        
                        while ($patient = mysql_fetch_array($record))
                        {
                            $patient['file'] = $row['fileID'];
                            $results[] = $patient;
                            $results[0]++;
                        }
                    }
                    else
                    {
                        $id = $row['fileID'];
                        $sql = "SELECT *
                                FROM unidentified
                                WHERE file = '$id'";
                        
                        //Add search fields for unidentified file.
                        if (   isset($search['firstName'])
                            || isset($search['surname']))
                        {
                            $sql .= (isset($search['firstName']) ? (" AND forename = '" . $search['firstName'] . "'") : "")
                                  . (isset($search['surname']) ? (" AND postname = '" . $search['surname'] . "'") : "");
                        }
                        
                        $record = mysql_query($sql, $resource);
                        
                        while ($patient = mysql_fetch_array($record))
                        {
                            $results[] = $patient;
                            $results[0]++;
                        }
                    }
                }
            }
        }
        return $results;
    }
?>
