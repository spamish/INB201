<?php
    require_once('classes.php');
    
    /*
        
    */
    function createStaff($staff)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $results = viewTable("staff");
        $staff->staffID = $results[0] + 1;
        
        $sql = "INSERT INTO staff (staffID,
                                   username,
                                   firstName,
                                   surname,
                                   gender,
                                   dateOfBirth, 
                                   mobilePhone,
                                   homePhone,
                                   address,
                                   roster,
                                   salary,
                                   position,
                                   ward,
                                   hash)
                VALUES ('" . $staff->staffID . "', '"
                           . $staff->username . "', '"
                           . $staff->firstName . "', '"
                           . $staff->surname . "', '"
                           . $staff->gender . "', '"
                           . $staff->dateOfBirth->format("Y-m-d H:i:s") . "', '"
                           . $staff->mobilePhone . "', '"
                           . $staff->homePhone . "', '"
                           . $staff->address . "', '"
                           . $staff->roster . "', '"
                           . $staff->salary . "', '"
                           . $staff->position . "', '"
                           . $staff->ward . "', '"
                           . $staff->hash . "')";
        
        $records = mysql_query($sql, $resource);
        
        return $staff;
    }
    
    /*
        
    */
    function createRoom($room)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $check = new Room();
        $check->roomID = 1;
        $room->roomID = 1;
        
        while (1)
        {
            //Iterate through rooms table.
            $results = viewTable("rooms", $check);
            
            //Add data when unique index is found.
            if (!$results[0])
            {
                $sql = "INSERT INTO rooms (roomID, roomNumber, ward, capacity, occupied)
                        VALUES ('" . $room->roomID . "', '"
                                   . $room->roomNumber . "', '"
                                   . $room->ward . "', '"
                                   . $room->capacity . "', '0')";
                $records = mysql_query($sql, $resource);
                
                return;
            }
            $check->roomID++;
            $room->roomID++;
        }
    }
    
    /*
        
    */
    function createEquipment($equipment)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $check = new Equipment();
        $check->equipmentID = 1;
        $equipment->equipmentID = 1;
        
        while (1)
        {
            //Iterate through equipment table.
            $results = viewTable("equipment", $check);
            
            //Add data when unique index is found.
            if (!$results[0])
            {
                //Add data to table.
                $sql = "INSERT INTO equipment (equipmentID, roomNumber, code, duration, cost, description)
                        VALUES ('" . $equipment->equipmentID . "', '"
                                   . $equipment->roomNumber . "', '"
                                   . $equipment->code . "', '"
                                   . $equipment->duration->format('H:i:s') . "', '"
                                   . $equipment->cost . "', '"
                                   . $equipment->description . "')";
                $records = mysql_query($sql, $resource);
                
                return;
            }
            $check->equipmentID++;
            $equipment->equipmentID++;
        }
    }
    
    /*
        
    */
    function createTheater($theater)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $check = new Theater();
        $check->theaterID = 1;
        $theater->theaterID = 1;
        
        while (1)
        {
            //Iterate through theaters table.
            $results = viewTable("theaters", $check);
            
            //Add data when unique index is found.
            if (!$results[0])
            {
                //Add data to table.
                $sql = "INSERT INTO theaters (theaterID, roomNumber)
                        VALUES ('" . $theater->theaterID . "', '"
                                   . $theater->roomNumber . "')";
                $records = mysql_query($sql, $resource);
                
                return;
            }
            $check->theaterID++;
            $theater->theaterID++;
        }
    }
    
    /*
        
    */
    function editStaff($staff)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "UPDATE staff
                SET firstName = '" . $staff->firstName . "',
                    surname = '" . $staff->surname . "',
                    gender = '" . $staff->gender . "',
                    dateOfBirth = '" . $staff->dateOfBirth->format('Y-m-d H:i:s') . "',
                    mobilePhone = '" . $staff->mobilePhone . "',
                    homePhone = '" . $staff->homePhone . "',
                    address = '" . $staff->address . "',
                    roster = '" . $staff->roster . "',
                    salary = '" . $staff->salary . "',
                    position = '" . $staff->position . "',
                    ward = '" . $staff->ward . "'
                WHERE staffID = '" . $staff->staffID . "'";
        $records = mysql_query($sql, $resource);
        
        $results = viewTable("staff", $staff);
        
        return new Staff($results[1]);
    }
    
    /*
        
    */
    function editEquipment($equipment)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "UPDATE equipment
                SET code = '" . $equipment->code . "',
                    duration = '" . $equipment->duration->format('H:i:s') . "',
                    cost = '" . $equipment->cost . "',
                    description = '" . $equipment->description . "'
                WHERE equipmentID = '" . $equipment->equipmentID . "'";
        $records = mysql_query($sql, $resource);
        
        $results = viewTable("equipment", $equipment);
        
        return new Equipment($results[1]);
    }
    
    /*
        
    */
    function uniqueUsername()
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "SELECT username
                FROM (
                    SELECT 1
                    AS username
                    ) q1
                WHERE NOT
                EXISTS (
                    SELECT 1
                    FROM staff
                    WHERE username =1
                    )
                UNION ALL
                SELECT *
                FROM (
                    SELECT username +1
                    FROM staff t
                    WHERE NOT EXISTS (
                        SELECT 1
                        FROM staff ti
                        WHERE ti.username = t.username +1
                        )
                    ORDER BY username
                    LIMIT 1
                    ) q2
                ORDER BY username
                LIMIT 1";
        $result = mysql_query($sql, $resource);
        $id = mysql_fetch_array($result);
        
        return $id['username'];
    }
    
    /*
        
    */
    function assignRoster($roster)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        while(1)
        {
            $sql = "SELECT *
                    FROM rosters
                    WHERE start = '" . $roster->start . "'
                    AND finish = '" . $roster->finish . "'";
            
            $records = mysql_query($sql, $resource);
            
            if (mysql_num_rows($records) > 0)
            {
                return new Roster(mysql_fetch_array($records));
            }
            else
            {
                $sql = "SELECT *
                        FROM rosters";
                $records = mysql_query($sql, $resource);
                $count = mysql_num_rows($records) + 1;
                
                $sql = "INSERT INTO rosters (rosterID, start, finish)
                        VALUES ('$count', '" . $roster->start . "', '"
                                             . $roster->finish . "')";
                
                $records = mysql_query($sql, $resource);
            }
        }
    }
    
    /*
        
    */
    function assignSalary($salary)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $results = viewTable("salaries", $salary);
        
        if ($results[0])
        {
            $salary = new Salary($results[1]);
        }
        else
        {
            $results = viewTable("salaries");
            $salary->salaryID = $results[0] + 1;
            
            $sql = "INSERT INTO salaries (salaryID, payRate, nextDate)
                    VALUES ('" . $salary->salaryID . "', '"
                               . $salary->payRate . "', '"
                               . $salary->nextDate->format('Y-m-d H:i:s') . "')";
            $records = mysql_query($sql, $resource);
        }
        return $salary;
    }
    
    /*
        
    */
    function position($position)
    {
        switch($position)
        {
            case "doctor":
                return "Doctor";
                break;
            case "surgeon":
                return "Surgeon";
                break;
            case "nurse":
                return "Nurse";
                break;
            case "receptionist":
                return "Receptionist";
                break;
            case "technician":
                return "Medical Technician";
                break;
            case "administrator":
                return "System Administrator";
                break;
            default:
                return "Inactive";
                break;
        }
    }
?>