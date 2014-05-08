<?php
    require_once('connect_database.php');
    
    function searchStaff($id)
    {
        global $resource;
        
        $sql = "SELECT *
                FROM staff
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());

        return mysql_fetch_array($records);
    }
    
    function searchSalaries()
    {
        
    }
    
    function searchAllRooms($roomNumber)
    {
        global $resource;
        
        //Search for the room number in all relevant tables.
        $sql = "SELECT *
                FROM rooms
                WHERE roomNumber = '$roomNumber'";
        $result = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        $room = mysql_fetch_array($result);
        
        $sql = "SELECT *
                FROM theaters
                WHERE roomNumber = '$roomNumber'";
        $result = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        $theater = mysql_fetch_array($result);
        
        $sql = "SELECT *
                FROM equipment
                WHERE roomNumber = '$roomNumber'";
        $result = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        $equipment = mysql_fetch_array($result);
        
        //Return the details corresponding to a matching room.
        if ($room):
            return $room;
        elseif ($theater):
            return $theater;
        elseif ($equipment):
            return $equipment;
        else: //Or return nothing.
            return null;
        endif;
    }
    
    function searchProcedure()
    {
        
    }
    
    function searchPolicy()
    {
        
    }
    
    function createStaff($username, $firstName, $surname, $dateOfBirth, $phoneNumber, $salary, $position, $ward, $hash)
    {
        global $resource;
        
        $sql = "SELECT *
                FROM staff";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        
        $count = mysql_num_rows($records) + 1;
        
        $sql = "INSERT INTO staff (staffID, username, firstName, surname, dateOfBirth, phoneNumber, salary, position, ward, hash)
                VALUES ('$count', '$username', '$firstName', '$surname', '$dateOfBirth', '$phoneNumber', '$salary', '$position', '$ward', '$hash')";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
    }
    
    function createSalary()
    {
        
    }
    
    function createRoom($roomNumber, $ward, $roomCapacity, $occupiedBeds)
    {
        global $resource;
        
        $id = 1;
        
        while (1)
        {
            //Iterate through rooms table.
            $sql = "SELECT *
                    FROM rooms
                    WHERE roomID = '$id'";
            $records = mysql_query($sql, $resource)
                or die("Problem reading table: " . mysql_error());
            
            //Add data when unique index is found.
            if (!mysql_fetch_array($records))
            {
                $sql = "INSERT INTO rooms (roomID, roomNumber, ward, roomCapacity, occupiedBeds)
                        VALUES ('$id', '$roomNumber', '$ward', '$roomCapacity', '$occupiedBeds')";
                $records = mysql_query($sql, $resource)
                    or die("Problem reading table: " . mysql_error());
                return;
            }
            $id++;
        }
    }
    
    function createEquipment($roomNumber, $type, $schedule, $staff)
    {
        global $resource;
        
        $id = 1;
        
        while (1)
        {
            //Iterate through equipment table.
            $sql = "SELECT *
                    FROM equipment
                    WHERE equipmentID = '$id'";
            $records = mysql_query($sql, $resource)
                or die("Problem reading table: " . mysql_error());
            
            //Add data when unique index is found.
            if (!mysql_fetch_array($records))
            {
                //Add data to table.
                $sql = "INSERT INTO equipment (equipmentID, roomNumber, type, schedule, staff)
                        VALUES ('$id', '$roomNumber', '$type', '$schedule', '$staff')";
                $records = mysql_query($sql, $resource)
                    or die("Problem reading table: " . mysql_error());
                return;
            }
            $id++;
        }
    }
    
    function createTheater($roomNumber, $ward, $schedule)
    {
        global $resource;
        
        $id = 1;
        
        while (1)
        {
            //Iterate through theater table.
            $sql = "SELECT *
                    FROM theaters
                    WHERE theaterID = '$id'";
            $records = mysql_query($sql, $resource)
                or die("Problem reading table: " . mysql_error());
            
            //Add data when unique index is found.
            if (!mysql_fetch_array($records))
            {
                //Add data to table.
                $sql = "INSERT INTO theaters (theaterID, roomNumber, ward, schedule)
                        VALUES ('$id', '$roomNumber', '$ward', '$schedule')";
                $records = mysql_query($sql, $resource)
                    or die("Problem reading table: " . mysql_error());
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
        global $resource;
        
        $sql = "UPDATE staff
                SET firstName = '$firstName',
                    surname = '$surname',
                    dateOfBirth = '$dateOfBirth',
                    phoneNumber = '$phoneNumber',
                    salary = '$salary',
                    position = '$position',
                    ward = '$ward'
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
    }
    
    function editSalary()
    {
        
    }
    
    function editRoom($id, $roomCapacity)
    {
        global $resource;
        
        $sql = "UPDATE rooms
                SET roomCapacity = '$roomCapacity'
                WHERE roomID = '$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
    }
    
    function editEquipment($id, $type, $staff)
    {
        global $resource;
        
        $sql = "UPDATE equipment
                SET type = '$type',
                    staff = '$staff'
                WHERE equipmentID = '$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
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
        global $resource;
        
        //Delete value.
        $sql = "DELETE FROM $table
                WHERE roomNumber = '$roomNumber'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
    }
    
    function deleteProcedure()
    {
        
    }
    
    function deletePolicy()
    {
        
    }
?>