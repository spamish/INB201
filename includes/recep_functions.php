<?php
    require_once('classes.php');
    
    function searchAddress($address)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        //If address details are present.
        if (isset($address['houseNumber']))
        {
            $houseNumber = $address['houseNumber'];
            $street = $address['street'];
            $suburb = $address['suburb'];
            $postcode = $address['postcode'];
            $region = $address['region'];
            $country = $address['country'];
            
            $sql = "SELECT *
                    FROM addresses
                    WHERE houseNumber = '$houseNumber',
                    AND street = '$street',
                    AND suburb = '$suburb',
                    AND postcode = '$postcode',
                    AND region = '$region',
                    AND country = '$country'";
            if (isset($address['unit']))
            {
                $unit = $address['unit'];
                $sql .= ", AND unit = '$unit'";
            }
        }
        //If home phone number details are present.
        else
        {
            $homePhone = $address['homePhone'];
            
            $sql = "SELECT *
                    FROM addresses
                    WHERE homePhone = '$homePhone'";
        }
        
        //Search for address.
        $records = mysql_query($sql, $resource);
        
        //Return address ID if address exists.
        if (mysql_fetch_array($records))
        {
            return mysql_fetch_array($records);
        }
        //Create new address from address detials or home phone number.
        else
        {
            $sql = "SELECT *
                    FROM addresses";
            $records = mysql_query($sql, $resource);
            $count = mysql_num_rows($records) + 1;
            
            //Add address details.
            if(isset($houseNumber))
            {
                $insert = "houseNumber, street, suburb, postcode, region, country";
                $values = "'$houseNumber', '$street', '$suburb', '$postcode', '$region', '$country'";
            }
            //Add unit details.
            if (isset($unit))
            {
                $insert = ", unit";
                $values = ", '$unit'";
            }
            //Add home phone details.
            if (isset($homePhone))
            {
                $insert = isset($insert) ? ", homePhone" : "homePhone";
                $values = isset($values) ? ", '$homePhone'" : "'$homePhone'";
            }
            
            //Create address.
            $sql = "INSERT INTO addresses (addressID, " . $insert . ") VALUES ('$count', " . $values . ")";
            $records = mysql_query($sql, $resource);
            
            $sql = "SELECT *
                    FROM addresses
                    WHERE addressID = '$count'";
            //Search for address.
            $records = mysql_query($sql, $resource);
            
            //Return address ID if address exists.
            return mysql_fetch_array($records);
        }
    }
    
    function createUnidentified($patient)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        $names = array('Alpha',  'Bravo',    'Charlie', 'Delta',  'Echo',    'Foxtrot',
                       'Golf',   'Hotel',    'India',   'Juliet', 'Kilo',    'Lima',
                       'Mike',   'November', 'Oscar',   'Papa',   'Quebec',  'Romeo',
                       'Sierra', 'Tango',    'Uniform', 'Victor', 'Whiskey', 'Xray',
                       'Yankee', 'Zulu');
        
        $gender = $patient['gender'];
        $file = $patient['file'];
        
        if (isset($patient['firstname']))
        {
            //Creates patient file if date of birth is not known.
            $forename = $patient['firstName'];
            $postname = $patient['surname'];
        }
        else
        {
            //Creates patient file if no information is known.
            $sql = "SELECT *
                    FROM unidentified";
            
            $records = mysql_query($sql, $resource);
            $count = mysql_num_rows($records);
            
            //Assigns name for unidentified patient (steps through phonetic alphabet as more patients are added to the list).
            $forename = $names[$count % 25];
            $postname = date('d', time()) . date('m', time());
            
            //Cycles through phonetic alphabet till unique name is found.
            while (searchUnidentified($forename, $postname))
            {
                $count++;
                $forname = $names[$count % 25];
            }
        }
        
        $sql = "INSERT INTO unidentified (file, forename, postname, gender)
                VALUES ('$file', '$forename', '$postname', '$gender')";
        $records = mysql_query($sql, $resource);
        
        return searchUnidentified($forename, $postname);
    }
    
    function createPatient($patient)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $firstName = $patient['firstName'];
        $surname = $patient['surname'];
        $gender = $patient['gender'];
        $dateOfBirth = $patient['dateOfBirth'];
        
        $patient = searchPatients($firstName, $surname, $gender, $dateOfBirth);
        
        if (isset($patient))
        {
            //Creates patient file if not already existing.
            $sql = "SELECT *
                    FROM patients";
            
            $records = mysql_query($sql, $resource);
            $count = mysql_num_rows($records) + 1;
            
            $sql = "INSERT INTO patients (patientID, firstName, surname, gender, dateOfBirth)
                    VALUES ('$count', '$firstName', '$surname', '$gender', '$dateOfBirth')";
            $records = mysql_query($sql, $resource);
            
            $patient = searchPatients($firstName, $surname, $gender, $dateOfBirth);
        }
        
        return $patient;
    }
    
    function createFile($file)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $admission = $file['admission'];
        $state = $file['state'];
        
        $sql = "SELECT *
                FROM files";
        $records = mysql_query($sql, $resource);
        $count = mysql_num_rows($records) + 1;
        
        $sql = "INSERT INTO files (fileID, admission, state)
                VALUES ('$count', '$admission', '$state')";
        $records = mysql_query($sql, $resource);
        
        $sql = "SELECT *
                FROM files
                WHERE fileID = '$count'";
        //Search for address.
        $records = mysql_query($sql, $resource);
        
        //Return address ID if address exists.
        return mysql_fetch_array($records);
    }
    
    function assignPatient($file, $patient)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $patient = $patient[1]['patientID'];
        $file = $file['fileID'];
        
        $sql = "UPDATE files
                SET patient = '$patient'
                WHERE fileID = '$file'";
        $records = mysql_query($sql, $resource);
    }
?>