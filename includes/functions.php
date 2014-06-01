<?php
    require_once('classes.php');
    
    /*
        Searches addresses and if it doesn't exist then create a new entry.
        Then returns that address.
    */
    function assignAddress($address)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $result = viewTable("addresses", $address);
        
        if (!$result[0])
        {
            //Add address details.
            $insert = "house, street, suburb, postcode, region, country";
            $values = "'" . $address->house . "', '"
                          . $address->street . "', '"
                          . $address->suburb . "', '"
                          . $address->postcode . "', '"
                          . $address->region . "', '"
                          . $address->country . "'";
            
            //Add unit details.
            if (isset($unit))
            {
                $insert = ", unit";
                $values = ", '" . $address->unit . "'";
            }
            
            $result = viewTable("addresses");
            
            //Create address.
            $sql = "INSERT INTO addresses (addressID, " . $insert . ") VALUES ('" . $result[0] . "', " . $values . ")";
            $records = mysql_query($sql, $resource);
            
            $result = viewTable("addresses", $address);
        }
        
        return new Address($result[1]);
    }
    
    /*
        Retrieves staff information.
        *doesn't return the hash of the password*
    */
    function getStaffInfo($username)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "SELECT *
                FROM staff
                WHERE username = '$username'";
        $records = mysql_query($sql, $resource);
        
        return new Staff(mysql_fetch_array($records));
    }
    
    /*
        Returns array with data from a table;
        Variables
        table: defined the table to retrieve data from.
        parameters: accepts an object that defined search parameters.
        order: defines the column that the table should be ordered by.
        sort: defined if ordering is asc or desc.
        limit: defines first row of table to select.
        count: defined number of rows to return.
    */
    function viewTable($table, $parameters = null, $order = null, $sort = true, $limit = 0, $count = 0)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //View sorted by id in ascending order.
        $sql = "SELECT * FROM $table"
             . addParameters($parameters);
        
        //Add sorting options to view function.
        if ($order)
        {
            $sql .= " ORDER BY " . $order . ($sort ? " ASC" : " DESC");
        }
        
        if ($count > 0)
        {
            $sql .= " LIMIT $limit,$count";
        }
        $records = mysql_query($sql, $resource);
        
        if (!$results[0] = mysql_num_rows($records))
        {
            return null;
        }
        
        while ($row = mysql_fetch_array($records))
        {
            $results[] = $row;
        }
        
        return $results;
    }
    
    /*
        Creates a note.
    */
    function createNote($note)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $records = viewTable("notes");
        $note->noteID = $records[0] + 1;
        
        $sql = "INSERT INTO notes (noteID, file, type, staff, timestamp, details)
                VALUES ('" . $note->noteID . "', '"
                           . $note->file . "', '"
                           . $note->type . "', '"
                           . $note->staff . "', '"
                           . $note->timestamp->format('Y-m-d H:i:s') . "', '"
                           . $note->details . "')";
        $records = mysql_query($sql, $resource);
    }
    
    /*
        Searches for all active case files.
    */
    function viewCurrent($file = null, $patient = null, $room = null, $staff = null)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        $return[0] = 0;
        
        //Searches for any room parameters given.
        $result['room'] = viewTable("rooms", $room);
        
        $reference = viewTable("staff");
        $result['staff'] = viewTable("staff", $staff);
        
        if ($result['staff'][0] && ($result['staff'][0] != $reference[0]))
        {
            $staff = new Staff($result['staff'][1]);
            $file->doctor = $staff->staffID;
        }
        
        $file->discharge = "NULL";
        $result['file'] = viewTable("files", $file);
        
        for ($i = 1; $i <= $result['file'][0]; $i++)
        {
            if (isset($result['file'][$i]['patient']))
            {
                $identified = new Patient();
                $identified->file = $patient->patientID;
                $identified->firstName = $patient->firstName;
                $identified->surname = $patient->surname;
                $identified->gender = $patient->gender;
                $result['patient'] = viewTable("patients", $identified);
            }
            else
            {
                $unidentified = new Patient();
                $unidentified->file = $result['file'][$i]['fileID'];
                $unidentified->firstName = $patient->firstName;
                $unidentified->surname = $patient->surname;
                $unidentified->gender = $patient->gender;
                
                $result['patient'] = viewTable("unidentified", $unidentified);
            }
            if ($result['patient'][0] != 0)
            {
                $return[0]++;
                $case['file'] = $result['file'][$i];
                $case['patient'] = $result['patient'][1];
                //$case['staff']
                //$case['room']
                
                $return[] = $case;
            }
        }
        return $return;
    }
    
    /*
    
    */
    function surgeons($operation)
    {
        $surgeon = new Staff();
        $surgeon->position = "surgeon";
        $results = viewTable("staff", $surgeon);
        
        $operation->surgeons = unserialize($operation->surgeons);
        
        echo $results[0] . "<br>";
        for ($i = 1; $i <= $results[0]; $i++)
        {
            $staff = new Staff($results[$i]);
            $j = 0;
            
            while (isset($operation->surgeons[$j]))
            {
                if ($staff->staffID == $operation->surgeons[$j])
                {
                    $surgeons[] = $staff;
                }
                $j++;
            }
        }
        
        return $surgeons = false;
    }
    
    /*
        Updates a row in a table.
    */
    function update($table, $index, $id, $type, $value)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
                
        $sql = "UPDATE $table
                SET $type = '$value'
                WHERE $index = '$id'";
        $records = mysql_query($sql, $resource);
    }
    
    /*
        Deletes a row in a table.
    */
    function delete($table, $index, $id)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //Delete value.
        $sql = "DELETE FROM $table
                WHERE $index = '$id'";
        $records = mysql_query($sql, $resource);
    }
    
    /*
        Takes the float of state and translates to corresponding state.
        eg. 0.5 => Stable
    */
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
    
    /*
        Returns the gender value as the corresponding string.
        m => Male, f => Female
    */
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
    
    /*
        Returns an array of sql search parameters.
    */
    function addParameters($input = null)
    {
        $return = "";
        if ($input)
        {
            $count = 0;
            
            foreach ($input as $type => $value)
            {
                if ($value)
                {
                    $return .= (($count++ == 0) ? "" : " AND ");
                    if (gettype($value) == 'object')
                    {
                        $return .= $type . " = '" . $value->format('Y-m-d H:i:s') . "' ";
                    }
                    elseif (($pos = strpos($value, "LIKE.")) !== FALSE)
                    {
                        $return .= $type . " LIKE '" . substr($value, $pos+5) . "%' ";
                    }
                    elseif ($value == "NULL")
                    {
                        $return .= $type . " IS NULL ";
                    }
                    else
                    {
                        $return .= $type . " = '" . $value . "' ";
                    }
                }
            }
            
            if($count)
            {
                $return = " WHERE " . $return;
            }
        }
        return $return;
    }
?>
