<?php
    require('classes.php');
    
    /*
        Returns all upcoming tests for the technician.
    */
    function viewTests()
    {
        $technician = new Test();
        $technician->technician = $_SESSION['login'];
        $result['test'] = viewTable("tests", null, "start", true);
        $return[0] = 0;
        $now = new DateTime();
        
        for ($i = 1; $i <= $result['test'][0]; $i++)
        {
            $test = new Test($result['test'][$i]);
            if ($test->start)
            {
                $file = new File();
                $file->fileID = $test->file;
                $result['file'] = viewTable("files", $file);
                $file = new File($result['file']);
                
                if (isset($file->patient))
                {
                    $identified = new Patient();
                    $identified->patientID = $file->patient;
                    $result['patient'] = viewTable("patients", $identified);
                }
                else
                {
                    $unidentified = new Patient();
                    $unidentified->file = $test->file;
                    $result['patient'] = viewTable("unidentified", $unidentified);
                }
                
                $equipment = new Equipment();
                $equipment->equipmentID = $test->equipment;
                $result['equipment'] = viewTable("equipment", $equipment);
                
                $case['test'] = $result['test'][$i];
                $case['file'] = $result['file'][1];
                $case['patient'] = $result['patient'][1];
                $case['equipment'] = $result['equipment'][1];
                $return[] = $case;
                $return[0]++;
            }
        }
        
        return $return;
    }
?>