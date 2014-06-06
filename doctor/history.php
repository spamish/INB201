<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $results = viewTable("patients", new Patient($_GET));
    $patient = new Patient($results[1]);
    $patient->identified = true;
    
    $file = new File();
    $file->patient = $patient->patientID;
    $files = viewTable("files", $file);
    
    for ($i = 1; $i <= $files[0]; $i++)
    {
        $file = new File($files[$i]);
        $note = new Note();
        $note->file = $file->fileID;
        $notes[$i] = viewTable("notes", $note, "timestamp", true);
        
        if ($file->doctor)
        {
            $staff = new Staff();
            $staff->staffID = $file->doctor;
            $staffs[$i] = viewTable("staff", $staff);
        }
        
        if ($file->room)
        {
            $room = new Room();
            $room->roomID = $file->room;
            $rooms[$i] = viewTable("rooms", $room);
        }
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/info.css') ?>
        </style>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <h2>Patient History</h2>
                
				<fieldset style="width:93%;">	
                    <legend><h3>Patient Details</h3></legend>
                    <table>
                        <tr>
                            <th>Patient ID</th>
                            <td><?php echo $patient->patientID ?></td>
                       </tr>
                        <tr>
                            <th>First Name</th>
                            <td><?php echo $patient->firstName ?></td>
                            <th>Surname</th>
                            <td><?php echo $patient->surname ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo gender($patient->gender) ?></td>
                            <th>Date of Birth</th>
                            <td><?php echo $patient->dateOfBirth->format('jS M Y') ?></td>
                        </tr>
                    </table>
				</fieldset>
                
                <?php for ($i = 1; $i <= $files[0]; $i++)
                {
                    $file = new File($files[$i]);
                    
                    if ($file->doctor)
                    {
                        $staff = new Staff($staffs[$i][1]);
                    }
                    
                    if ($file->room)
                    {
                        $room = new Room($rooms[$i][1]);
                    } ?>
                    <fieldset style="width:93%;">
                        <legend><h3>Case File Details</h3></legend>
                        <table>
                            <tr>
                                <th>Case Number</th>
                                <td><?php echo $file->fileID ?></td>
                            <tr>
                                <th>Admission</th>
                                <td><?php echo $file->admission->format('g:i a D jS M Y') ?></td>
                            <tr>
                                <th>Primary Doctor</th>
                                <td>
                                    <?php if($file->doctor)
                                    {
                                        echo $staff->firstName . " " . $staff->surname ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td><?php echo $staff->username;
                                    }
                                    else
                                    {
                                        echo "None assigned.";
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Room</th>
                                <td>
                                    <?php if($file->room)
                                    {
                                        echo strtolower($room->ward) . $room->roomNumber;
                                    }
                                    else
                                    {
                                        echo "None assigned.";
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="width:93%;">
                        <legend><h3>Patient Notes</h3></legend>
                        <?php for ($j = 1; $j <= $notes[$i][0]; $j++)
                        {
                            $note = new Note($notes[$i][$j]);
                            if ($note->type != "payment")
                            { ?>
                                <table>
                                    <tr>
                                        <th>Type of Action</th>
                                        <td><?php echo ucfirst($note->type) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Timestamp</th>
                                        <td><?php echo $note->timestamp->format('h:ia D, jS M Y') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td><?php echo $note->staff ?></td>
                                    </tr>
                                    <tr>
                                        <th>Details</th>
                                        <td><?php echo $note->details ?></td>
                                    </tr>
                                </table>
                            <?php }
                        } ?>
                    </fieldset>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
