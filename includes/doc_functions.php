<?php
    require_once('classes.php');
    
    /*
        Book a test.
    */
    function bookTest($test)
    {
        $equipment = new Equipment();
        $equipment->equipmentID = $test->equipment;
        $results = viewTable("equipment", $equipment);
        $equipment = new Equipment($results[1]);
        $equipment->technicians = unserialize($equipment->technicians);
        
        $check = new Test();
        $check->file = $test->file;
        $results = viewTable("tests", $check, "finish", false);
        
        //Find next time for patient.
        if ($results)
        {
            $compare = new Test($results[1]);
            $compare = new DateTime($compare->finish->format('Y-m-d H:i:s'));
            
            if ($compare < new DateTime())
            {
                $available = new DateTime();
            }
            else
            {
                $available = $compare;
            }
        }
        else
        {
            $available = new DateTime();
        }
        
        $results = viewTable("operations", $check, "finish", false);
        
        if ($results)
        {
            $compare = new Operation($results[1]);
            $compare = new DateTime($compare->finish->format('Y-m-d H:i:s'));
            
            if ($available < $compare)
            {
                $available = $compare;
            }
        }
        
        $check->file = null;
        $check->equipment = $test->equipment;
        $results = viewTable("tests", $check, "finish", false);
        
        //Find next time for equipment.
        if ($results)
        {
            $compare = new Test($results[1]);
            $compare = new DateTime($compare->finish->format('Y-m-d H:i:s'));
            
            if ($compare < new DateTime())
            {
                $compare = new DateTime();
            }
            
            $available = (($available > $compare) ? $compare : $available);
        }
        
        $check->equipment = null;
        
        //Find next time for technician.
        for ($i = 0; $i < count($equipment->technicians); $i++)
        {
            $check->technician = $equipment->technicians[$i];
            $results = viewTable("tests", $check, "finish", false);
            
            if ($results)
            {
                $compare = new Test($results[1]);
                $compare = new DateTime($compare->finish->format('Y-m-d H:i:s'));
                
                if (!isset($best))
                {
                    $best = $compare;
                    $test->technician = $check->technician;
                }
                
                if ($compare < $best)
                {
                    $best = $compare;
                    $test->technician = $check->technician;
                }
            }
            else
            {
                $test->technician = $check->technician;
                break;
            }
        }
        
        if (isset($best) && ($best > $available))
        {
            $available = $best;
        }
        
        if ($available < $compare)
        {
            $available = $compare;
        }
        
        $test->start = new DateTime($available->format('Y-m-d H:i:s'));
        $test->finish = new DateTime($test->start->format('H:i:s'));
        $test->finish->add(new DateInterval($equipment->duration->format('\P0\D\T0\HHi\M0\S')));
        
        createTest($test);
        
        return $test;
    }
    
    /*
        Add test to database.
    */
    function createTest($test)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $records = viewTable("tests");
        $test->testID = $records[0] + 1;
        
        $sql = "INSERT INTO tests (testID, file, equipment, start, finish, technician)
                VALUES ('" . $test->testID . "', '"
                           . $test->file . "', '"
                           . $test->equipment . "', '"
                           . $test->start->format('Y-m-d H:i:s') . "', '"
                           . $test->finish->format('Y-m-d H:i:s') . "', '"
                           . $test->technician . "')";
        $records = mysql_query($sql, $resource);
    }
    
    /*
        Book an operation.
    */
    function bookOperation($operation)
    {
        $procedure = new Procedure();
        $procedure->procedureID = $operation->procedure;
        $results = viewTable("procedures", $procedure);
        $procedure = new Procedure($results[1]);
        $procedure->surgeons = unserialize($procedure->surgeons);
        
        $check = new Operation();
        $check->file = $operation->file;
        $results = viewTable("operations", $check, "finish", false);
        
        //Find next time for patient.
        if ($results)
        {
            $compare = new Operation($results[1]);
            $compare = new DateTime($compare->finish->format('Y-m-d H:i:s'));
            
            if ($compare < new DateTime())
            {
                $available = new DateTime();
            }
            else
            {
                $available = $compare;
            }
        }
        else
        {
            $available = new DateTime();
        }
        
        $results = viewTable("tests", $check, "finish", false);
        
        if ($results)
        {
            $compare = new Test($results[1]);
            $compare = new DateTime($compare->finish->format('Y-m-d H:i:s'));
            
            if ($available < $compare)
            {
                $available = $compare;
            }
        }
        
        $check->file = null;
        $theaters = viewTable("theaters");
        
        //Find next time for theater.
        for ($i = 1; $i <= $theaters[0]; $i++)
        {
            $theater = new Theater($theaters[$i]);
            $check->theater = $theater->theaterID;
            $results = viewTable("operations", $check, "finish", false);
            
            if ($results)
            {
                $compare = new Operation($results[1]);
                $compare = new DateTime($compare->finish->format('Y-m-d H:i:s'));
                
                if (!isset($best))
                {
                    $best = $compare;
                    $operation->theater = $check->theater;
                }
                
                if ($compare < $best)
                {
                    $best = $compare;
                    $operation->theater = $check->theater;
                }
            }
            else
            {
                $operation->theater = $check->theater;
                break;
            }
        }
        
        if (isset($best) && ($best > $available))
        {
            $available = $best;
        }
        
        //Find next time for surgeons.
        $list = compileList($procedure->surgeons);
        
        //Best scenario of surgeons being free.
        for ($i = 0; $i < $procedure->required; $i++)
        {
            $operation->surgeons[$i] = 0;
            
            for ($j = count($procedure->surgeons) - 1; $j >= 0; $j--)
            {
                if (   !array_key_exists($procedure->surgeons[$j], $list)
                    && !array_key_exists($procedure->surgeons[$j], $operation->surgeons))
                {
                    $operation->surgeons[$i] = $procedure->surgeons[$j];
                    unset($procedure->surgeons[$j]);
                    break;
                }
            }
        }
        
        //Need to add compatabiltiy for finding next lot of surgeons.
        $operation->surgeons = serialize($operation->surgeons);
        $operation->start = new DateTime($available->format('Y-m-d H:i:s'));
        $operation->finish = new DateTime($operation->start->format('H:i:s'));
        $operation->finish->add(new DateInterval($procedure->duration->format('\P0\D\T0\HHi\M0\S')));
        
        createOperation($operation);
        
        return $operation;
    }
    
    /*
        Add operation to database.
    */
    function createOperation($operation)
    {
        $resource = new Connection();
        $resource = $resource->Connect();
        
        $records = viewTable("operations");
        $operation->operationID = $records[0] + 1;
        
        $sql = "INSERT INTO operations (`operationID`, `file`, `theater`, `start`, `finish`, `procedure`, `surgeons`)
                VALUES ('" . $operation->operationID . "', '"
                           . $operation->file . "', '"
                           . $operation->theater . "', '"
                           . $operation->start->format('Y-m-d H:i:s') . "', '"
                           . $operation->finish->format('Y-m-d H:i:s') . "', '"
                           . $operation->procedure . "', '"
                           . addslashes($operation->surgeons) . "')";
        $records = mysql_query($sql, $resource);
    }

    /*
    
    */
    function compileList($surgeons)
    {
        $list = array();
        $results = viewTable("operations", null, "finish", true);
        
        for ($i = 1; $i <= $results[0]; $i++)
        {
            $check = unserialize($results[$i]['surgeons']);
            $time = new DateTime($results[$i]['finish']);
            
            for ($j = 0; $j < count($surgeons); $j++)
            {
                for ($k = 0; $k < count($check); $k++)
                {
                    if ($check[$k] == $surgeons[$j])
                    {
                        if (!isset($list[$check[$k]]) || ($list[$check[$k]] < $time))
                        {
                            $list[$check[$k]] = $time;
                        }
                    }
                }
            }
        }
        
        return $list;
    }
?>
