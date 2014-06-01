<?php
    require('../includes/start_session.php');
    require('../includes/doc_functions.php');
    require('../includes/functions.php');
    
    switch ($_POST['function'])
    {
        case "note":
            $note = new Note($_POST);
            $note->type = "note";
            
            break;
        
        case "order":
            $file = new File($_POST);
            $results = viewTable("files", $file);
            $file = new File($results[1]);
            
            $note = new Note();
            $note->type = "order";
            $note->file = $file->fileID;
            
            $prescription = new Prescription($_POST);
            $results = viewTable("prescriptions", $prescription);
            $prescription = new Prescription($results[1]);
            
            $note->details = "Patient prescribed " . $prescription->code;
            $file->balance = $file->balance + $prescription->cost;
            
            update("files", "fileID", $file->fileID, "balance", $file->balance);
            
            break;
        
        case "test":
            $file = new File($_POST);
            $results = viewTable("files", $file);
            $file = new File($results[1]);
            
            $note = new Note();
            $note->type = "test";
            $note->file = $file->fileID;
            
            $equipment = new Equipment($_POST);
            $results = viewTable("equipment", $equipment);
            $equipment = new Equipment($results[1]);
            
            $test = new Test();
            $test->file = $file->fileID;
            $test->equipment = $equipment->equipmentID;
            
            $test = bookTest($test);
            
            if ($test)
            {
                $note->details = $equipment->code . " booked at "
                    . $test->start->format('h:ia') . " on "
                    . $test->start->format('jS M Y') . " in e"
                    . $equipment->roomNumber . ".";
            }
            else
            {
                header ("refresh:0; url=transfer.php?fileID="
                    . $file->fileID . "&failed=test");
            }
            
            break;
        
        case "operation":
            $file = new File($_POST);
            $results = viewTable("files", $file);
            $file = new File($results[1]);
            
            $note = new Note();
            $note->type = "operation";
            $note->file = $file->fileID;
            
            $procedure = new procedure($_POST);
            $results = viewTable("procedures", $procedure);
            $procedure = new procedure($results[1]);
            
            $operation = new Operation();
            $operation->file = $file->fileID;
            $operation->procedure = $procedure->procedureID;
            
            $operation = bookOperation($operation);
            
            if ($operation)
            {
                $theater = new Theater();
                $theater->theaterID = $operation->theater;
                $results = viewTable("theaters", $theater);
                $theater = new Theater($results[1]);
                
                $note->details = $procedure->code . " booked at "
                    . $operation->start->format('h:ia') . " on "
                    . $operation->start->format('jS M Y') . " in g"
                    . $theater->roomNumber . ".";
            }
            else
            {
                header ("refresh:0; url=transfer.php?fileID="
                    . $file->fileID . "&failed=operation");
            }
            
            break;
        
        case "transfer":
            $file = new File($_POST);
            $results = viewTable("files", $file);
            $file = new File($results[1]);
            
            $note = new Note();
            $note->type = "transfer";
            $note->file = $file->fileID;
            
            if ($file->doctor)
            {
                $doctor = new Staff();
                $doctor->staffID = $file->doctor;
                $results = viewTable("staff", $doctor);
                $doctor = new Staff($results[1]);
            }
            
            if ($file->room)
            {
                $room = new Room();
                $room->roomID = $file->room;
                $results = viewTable("rooms", $room);
                $room = new Room($results[1]);
            }
            
            switch ($_POST['transfer'])
            {
                case "doctor":
                    $staff = new Staff($_POST);
                    $results = viewTable("staff", $staff);
                    $staff = new Staff($results[1]);
                    
                    if ($file->room && ($room->ward == $staff->ward))
                    {
                        update("files", "fileID", $file->fileID, "doctor", $staff->staffID);
                        
                        $note->details = "Patient assigned to doctor "
                            . $staff->firstName . " " . $staff->surname . ".";
                    }
                    else
                    {
                        header ("refresh:0; url=transfer.php?fileID="
                            . $file->fileID . "&failed=doctor");
                    }
                    break;
            
                case "room":
                    if ($file->room)
                    {
                        $relocate = new Room($_POST);
                        $relocate->ward = $room->ward;
                        $results = viewTable("rooms", $relocate);
                        $relocate = new Room($results[1]);
                        
                        if ($file->room != $relocate->roomID)
                        {
                            if ($relocate->capacity > $relocate->occupied)
                            {
                                update("files", "fileID", $file->fileID, "room", $relocate->roomID);
                                update("rooms", "roomID", $relocate->roomID, "occupied", ++$relocate->occupied);
                                
                                if ($file->room)
                                {
                                    update("rooms", "roomID", $room->roomID, "occupied", --$room->occupied);
                                }
                                
                                $note->details = "Patient transferred to room "
                                    . strtolower($relocate->ward) . $relocate->roomNumber . ".";
                            }
                            else
                            {
                                header ("refresh:0; url=transfer.php?fileID="
                                    . $file->fileID . "&failed=full");
                            }
                        }
                    }
                    else
                    {
                        header ("refresh:0; url=transfer.php?fileID="
                            . $file->fileID . "&failed=room");
                    }
                    break;
                
                case "ward":
                    //Possible future adaptation for automatic allocation.
                    //SELECT doctor,COUNT(*) as count FROM files GROUP BY doctor ORDER BY count ASC;
                    //SELECT * FROM rooms WHERE  `occupied` <  `capacity` ORDER BY  `occupied` ASC;
                    
                    $staff = new Staff($_POST);
                    $results = viewTable("staff", $staff);
                    $staff = new Staff($results[1]);
                    
                    $relocate = new Room($_POST);
                    $results = viewTable("rooms", $relocate);
                    $relocate = new Room($results[1]);
                    
                    if ($staff->ward && ($staff->ward == $relocate->ward))
                    {
                        if ($relocate->capacity > $relocate->occupied)
                        {
                            update("files", "fileID", $file->fileID, "doctor", $staff->staffID);
                            update("files", "fileID", $file->fileID, "room", $relocate->roomID);
                            update("rooms", "roomID", $relocate->roomID, "occupied", ++$relocate->occupied);
                            
                            if ($file->room)
                            {
                                update("rooms", "roomID", $room->roomID, "occupied", --$room->occupied);
                            }
                            
                            $note->details = "Patient transferred to room "
                                . strtolower($relocate->ward) . $relocate->roomNumber
                                . " and assigned to doctor "
                                . $staff->firstName . " " . $staff->surname . ".";
                        }
                        else
                        {
                            header ("refresh:0; url=transfer.php?fileID="
                                . $file->fileID . "&failed=full");
                        }
                    }
                    else
                    {
                        header ("refresh:0; url=transfer.php?fileID="
                            . $file->fileID . "&failed=ward");
                    }
                    break;
            }
            break;
    }
    
    $note->staff = $_SESSION['login'];
    $note->timestamp = new DateTime();
    
    createNote($note);
    
    header ("refresh:0; url=patients_view_details.php?fileID=" . $file->fileID);
?>