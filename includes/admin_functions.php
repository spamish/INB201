<?php
    require_once('classes.php');
    
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
    
    function searchStaff($id)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "SELECT *
                FROM staff
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource);

        return mysql_fetch_array($records);
    }
    
    function searchSalaries()
    {
        
    }
    
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
        
        if ($equipment)
        {
            return $equipment;
        }
    }
    
    function searchProcedure()
    {
        
    }
    
    function searchPolicy()
    {
        
    }
    
    function createStaff($username, $firstName, $surname, $dateOfBirth, $phoneNumber, $salary, $position, $ward, $hash)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "SELECT *
                FROM staff";
        $records = mysql_query($sql, $resource);
        $count = mysql_num_rows($records) + 1;
        
        $sql = "INSERT INTO staff (staffID, username, firstName, surname, dateOfBirth, phoneNumber, salary, position, ward, hash)
                VALUES ('$count', '$username', '$firstName', '$surname', '$dateOfBirth', '$phoneNumber', '$salary', '$position', '$ward', '$hash')";
        $records = mysql_query($sql, $resource);
    }
    
    function createSalary()
    {
        
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
    
    function createProcedure()
    {
        
    }
    
    function createPolicy()
    {
    
    }
    
    function editStaff($id, $firstName, $surname, $dateOfBirth, $phoneNumber, $salary, $position, $ward)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $sql = "UPDATE staff
                SET firstName = '$firstName',
                    surname = '$surname',
                    dateOfBirth = '$dateOfBirth',
                    phoneNumber = '$phoneNumber',
                    salary = '$salary',
                    position = '$position',
                    ward = '$ward'
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource);
    }
    
    function editSalary()
    {
        
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
    
    function editProcedure()
    {
        
    }
    
    function editPolicy()
    {
        
    }
    
    function deleteSalary()
    {
        
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
    
    function deleteProcedure()
    {
        
    }
    
    function deletePolicy()
    {
        
    }
?>