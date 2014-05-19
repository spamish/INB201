<?php
    require_once('classes.php');
    
    function searchRooms($roomNumber, $ward)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //Search for the room number in all relevant tables.
        $sql = "SELECT *
                FROM rooms
                WHERE roomNumber = '$roomNumber'
                AND ward = '$ward'";
        $result = mysql_query($sql, $resource);
        $room = mysql_fetch_array($result);
        
        if ($room)
        {
            return $room;
        }
    }
    
    function searchTheaters($roomNumber)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "SELECT *
                FROM theaters
                WHERE roomNumber = '$roomNumber'";
        $result = mysql_query($sql, $resource);
        $theater = mysql_fetch_array($result);
        
        if ($theater)
        {
            return $theater;
        }
    }
    
    function searchEquipment($roomNumber)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "SELECT *
                FROM equipment
                WHERE roomNumber = '$roomNumber'";
        $result = mysql_query($sql, $resource);
        $equipment = mysql_fetch_array($result);
        
        return $equipment;
    }
    
    function createStaff($staff)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
                
        $sql = "SELECT *
                FROM staff";
        $records = mysql_query($sql, $resource);
        $staff->staffID = (mysql_num_rows($records) + 1);
        
        $sql = "INSERT INTO staff (staffID,
                                   username,
                                   firstName,
                                   surname,
                                   gender,
                                   dateOfBirth, 
                                   mobilePhone,
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
                           . $staff->dateOfBirth . "', '"
                           . $staff->mobilePhone . "', '"
                           . $staff->address . "', '"
                           . $staff->roster . "', '"
                           . $staff->salary . "', '"
                           . $staff->position . "', '"
                           . $staff->ward . "', '"
                           . $staff->hash . "')";
        
        $records = mysql_query($sql, $resource);
        
        $sql = "SELECT *
                FROM staff";
        $records = mysql_query($sql, $resource);
        
        return new Staff(mysql_fetch_array($records));
    }
    
    function createRoom($roomNumber, $ward, $roomCapacity, $occupiedBeds)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $id = 1;
        
        while (1)
        {
            //Iterate through rooms table.
            $sql = "SELECT *
                    FROM rooms
                    WHERE roomID = '$id'";
            $records = mysql_query($sql, $resource);
            
            //Add data when unique index is found.
            if (!mysql_fetch_array($records))
            {
                $sql = "INSERT INTO rooms (roomID, roomNumber, ward, roomCapacity, occupiedBeds)
                        VALUES ('$id', '$roomNumber', '$ward', '$roomCapacity', '$occupiedBeds')";
                $records = mysql_query($sql, $resource);
                
                return;
            }
            $id++;
        }
    }
    
    function createEquipment($roomNumber, $code, $duration, $description)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $id = 1;
        
        while (1)
        {
            //Iterate through equipment table.
            $sql = "SELECT *
                    FROM equipment
                    WHERE equipmentID = '$id'";
            $records = mysql_query($sql, $resource);
            
            //Add data when unique index is found.
            if (!mysql_fetch_array($records))
            {
                //Add data to table.
                $sql = "INSERT INTO equipment (equipmentID, roomNumber, code, duration, description)
                        VALUES ('$id', '$roomNumber', '$code', '$duration', '$description')";
                $records = mysql_query($sql, $resource);
                
                return;
            }
            $id++;
        }
    }
    
    function createTheater($roomNumber, $ward, $schedule)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $id = 1;
        
        while (1)
        {
            //Iterate through theater table.
            $sql = "SELECT *
                    FROM theaters
                    WHERE theaterID = '$id'";
            $records = mysql_query($sql, $resource);
            
            //Add data when unique index is found.
            if (!mysql_fetch_array($records))
            {
                //Add data to table.
                $sql = "INSERT INTO theaters (theaterID, roomNumber, ward, schedule)
                        VALUES ('$id', '$roomNumber', '$ward', '$schedule')";
                $records = mysql_query($sql, $resource);
                
                return;
            }
            $id++;
        }
    }
    
    function editStaff($staff)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "UPDATE staff
                SET firstName = '" . $staff->firstName . "',
                    surname = '" . $staff->surname . "',
                    gender = '" . $staff->gender . "',
                    dateOfBirth = '" . $staff->dateOfBirth . "',
                    mobilePhone = '" . $staff->mobilePhone . "',
                    address = '" . $staff->address . "'
                    roster = '" . $staff->roster . "'
                    salary = '" . $staff->salary . "',
                    position = '" . $staff->position . "',
                    ward = '" . $staff->ward . "'
                WHERE staffID = '" . $staff->staffID . "'";
        $records = mysql_query($sql, $resource);
        
        $sql = "SELECT *
                FROM staff";
        $records = mysql_query($sql, $resource);
        
        return new Staff(mysql_fetch_array($records));
    }
    
    function editRoom($id, $roomCapacity)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "UPDATE rooms
                SET roomCapacity = '$roomCapacity'
                WHERE roomID = '$id'";
        $records = mysql_query($sql, $resource);
    }
    
    function editEquipment($id, $code, $duration, $description)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "UPDATE equipment
                SET code = '$code',
                    duration = '$duration',
                    description = '$description'
                WHERE equipmentID = '$id'";
        $records = mysql_query($sql, $resource);
    }
    
    function deleteRoom($table, $roomNumber)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //Delete value.
        $sql = "DELETE FROM $table
                WHERE roomNumber = '$roomNumber'";
        $records = mysql_query($sql, $resource);
    }
    
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
    
    function assignSalary($salary)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        while(1)
        {
            $sql = "SELECT *
                    FROM salaries
                    WHERE payRate = '" . $salary->payRate . "'
                    AND nextDate = '" . $salary->nextDate . "'";
            
            $records = mysql_query($sql, $resource);
            
            if (mysql_num_rows($records) > 0)
            {
                return new Salary(mysql_fetch_array($records));
            }
            else
            {
                $sql = "SELECT *
                        FROM salaries";
                $records = mysql_query($sql, $resource);
                $count = mysql_num_rows($records) + 1;
                
                $sql = "INSERT INTO salaries (salaryID, payRate, nextDate)
                        VALUES ('$count', '" . $salary->payRate . "', '"
                                             . $salary->nextDate . "')";
                
                $records = mysql_query($sql, $resource);
            }
        }
    }
    
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