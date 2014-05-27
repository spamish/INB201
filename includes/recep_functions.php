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
                               . $patient->dateOfBirth . "')";
            
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
                           . $file->admission . "', '"
                           . $file->state . "')";
        $records = mysql_query($sql, $resource);
        $return = viewTable("files", $file);
        
        return new File($return[1]);
    }
?>