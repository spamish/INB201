<?php
    require_once('classes.php');
    
    /*
        
    */
    function createUnidentified($patient)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $search = new Patient();
        $search->firstName = $patient->firstName;
        $search->surname = $patient->surname;
        
        $count = 0;
        $names = array('Alpha',  'Bravo',    'Charlie', 'Delta',  'Echo',    'Foxtrot',
                       'Golf',   'Hotel',    'India',   'Juliet', 'Kilo',    'Lima',
                       'Mike',   'November', 'Oscar',   'Papa',   'Quebec',  'Romeo',
                       'Sierra', 'Tango',    'Uniform', 'Victor', 'Whiskey', 'Xray',
                       'Yankee', 'Zulu');
        
        if (!$search->surname)
        {
            $search->surname = date('d', time()) . date('m', time());
        }
        
        if ($search->firstName)
        {
            $search->firstName .= "." . $count;
            do
            {
                $search->firstName = strstr($search->firstName, '.', true) . "." . ++$count;
                $check = viewTable("unidentified", $search);
            }
            while ($check[0] != 0);
        }
        else
        {
            $result = viewTable("unidentified");
            $count = $result[0];
            
            //Cycles through phonetic alphabet till unique name is found.
            do
            {
                $search->firstName = $names[++$count % 25];
                $check = viewTable("unidentified", $search);
            }
            while ($check[0] != 0);
            
        }
        
        $patient->firstName = $search->firstName;
        $patient->surname = $search->surname;
        
        $sql = "INSERT INTO unidentified (file, firstName, surname, gender)
                VALUES ('" . $patient->file . "', '"
                           . $patient->firstName . "', '"
                           . $patient->surname . "', '"
                           . $patient->gender . "')";
        $records = mysql_query($sql, $resource);
        $result = viewTable("unidentified", $patient);
        
        return $result[1];
    }
    
    /*
        
    */
    function createPatient($patient)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $patient->identified = null;
        
        //$patient->identified = (isset($patient->identified) ? $patient->identified : null);
        $return = viewTable("patients", $patient);
        
        if (!$return[0])
        {
            //Creates patient file if not already existing.
            $result = viewTable("patients");
            $patient->patientID = $result[0] + 1;
            
            $sql = "INSERT INTO patients (patientID, firstName, surname, gender, dateOfBirth)
                    VALUES ('" . $patient->patientID . "', '"
                               . $patient->firstName . "', '"
                               . $patient->surname . "', '"
                               . $patient->gender . "', '"
                               . $patient->dateOfBirth->format('Y-m-d') . "')";
            
            $records = mysql_query($sql, $resource);
            
            $return = viewTable("patients", $patient);
        }
        
        $return[1]['identified'] = true;
        return new Patient($return[1]);
    }
    
    /*
        
    */
    function createFile($file)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $records = viewTable("files");
        $file->fileID = $records[0] + 1;
        
        $sql = "INSERT INTO files (fileID, admission, state)
                VALUES ('" . $file->fileID . "', '"
                           . $file->admission->format('Y-m-d H:i:s') . "', '"
                           . $file->state . "')";
        $records = mysql_query($sql, $resource);
        $return = viewTable("files", $file);
        
        return new File($return[1]);
    }
    
    /*
    
    */
    function viewBalances()
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        $return[0] = 0;
        
        //View sorted by id in ascending order.
        $sql = "SELECT * FROM files
                WHERE balance > 0";
        
        $records = mysql_query($sql, $resource);
        
        if (!$result['file'][0] = mysql_num_rows($records))
        {
            return null;
        }
        
        while ($row = mysql_fetch_array($records))
        {
            $result['file'][] = $row;
        }
        
        for ($i = 1; $i <= $result['file'][0]; $i++)
        {
            if (isset($result['file'][$i]['patient']))
            {
                $identified = new Patient();
                $identified->patientID = $result['file'][$i]['patient'];
                $result['patient'] = viewTable("patients", $identified);
            }
            else
            {
                $unidentified = new Patient();
                $unidentified->file = $result['file'][$i]['fileID'];
                $result['patient'] = viewTable("unidentified", $unidentified);
            }
            if ($result['patient'][0] != 0)
            {
                $return[0]++;
                $case['file'] = $result['file'][$i];
                $case['patient'] = $result['patient'][1];
                
                $return[] = $case;
            }
        }
        return $return;
    }
    
    /*
    
    */
    function assignInsurance($insurance)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $result = viewTable("insurance", $insurance);
        
        if (!$result[0])
        {
            $result = viewTable("insurance");
            $insurance->insuranceID = $result[0] + 1;
            //Create address.
            $sql = "INSERT INTO insurance (insuranceID, provider, policy, percent, maximum)
                    VALUES ('" . $insurance->insuranceID . "', '"
                               . $insurance->provider . "', '"
                               . $insurance->policy . "', '"
                               . $insurance->percent . "', '"
                               . $insurance->maximum . "')";
            $records = mysql_query($sql, $resource);
            
            $result = viewTable("insurance", $insurance);
        }
        
        return new Insurance($result[1]);
    }
    
    /*
    
    */
    function assignGuardian($guardian)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $result = viewTable("guardians", $guardian);
        
        if (!$result[0])
        {
            $result = viewTable("guardians");
            $guardian->guardianID = $result[0] + 1;
            
            //Create guardian.
            $sql = "INSERT INTO guardians (guardianID, firstName, surname, gender, mobilePhone, homePhone, address)
                    VALUES ('" . $guardian->guardianID . "', '"
                               . $guardian->firstName . "', '"
                               . $guardian->surname . "', '"
                               . $guardian->gender . "', '"
                               . $guardian->mobilePhone . "', '"
                               . $guardian->homePhone . "', '"
                               . $guardian->address . "')";
            $records = mysql_query($sql, $resource);
            
            $result = viewTable("guardians", $guardian);
        }
        
        return new Guardian($result[1]);
    }
?>