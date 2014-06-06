<?php
    require('classes.php');
    
    /*
        Returns all upcoming operations for the technician.
    */
    function viewOperations()
    {
        $result['operation'] = viewTable("operations", null, "start", true);
        $return[0] = 0;
        $now = new DateTime();
        
        for ($i = 1; $i <= $result['operation'][0]; $i++)
        {
            $operation = new Operation($result['operation'][$i]);
            if ($operation->start)
            {
                $file = new File();
                $file->fileID = $operation->file;
                $result['file'] = viewTable("files", $file);
                $file = new File($result['file'][1]);
                
                if (isset($file->patient))
                {
                    $identified = new Patient();
                    $identified->patientID = $file->patient;
                    $result['patient'] = viewTable("patients", $identified);
                }
                else
                {
                    $unidentified = new Patient();
                    $unidentified->file = $operation->file;
                    $result['patient'] = viewTable("unidentified", $unidentified);
                }
                
                $theater = new Theater();
                $theater->theaterID = $operation->theater;
                $result['theater'] = viewTable("theaters", $theater);
                
                $procedure = new Procedure();
                $procedure->procedureID = $operation->procedure;
                $result['procedure'] = viewTable("procedures", $procedure);
                
                $case['operation'] = $result['operation'][$i];
                $case['file'] = $result['file'][1];
                $case['patient'] = $result['patient'][1];
                $case['theater'] = $result['theater'][1];
                $case['procedure'] = $result['procedure'][1];
                $return[] = $case;
                $return[0]++;
            }
        }
        
        return $return;
    }
?>