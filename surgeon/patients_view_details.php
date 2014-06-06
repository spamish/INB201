<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $results = viewTable("files", new File($_GET));
    $file = new File($results[1]);
    $patient = new Patient();
    
    //Select related patient details.
    if($file->patient)
    {
        $patient->patientID = $file->patient;
        $results = viewTable("patients", $patient);
        $patient = new Patient($results[1]);
        $patient->identified = true;
    }
    else
    {
        $patient->file = $file->fileID;
        $results = viewTable("unidentified", $patient);
        $patient = new Patient($results[1]);
        $patient->identified = false;
    }
    $note = new Note();
    $note->file = $file->fileID;
    $notes = viewTable("notes", $note, "timestamp", false);
    
    if ($file->doctor)
    {
        $staff = new Staff();
        $staff->staffID = $file->doctor;
        $results = viewTable("staff", $staff);
        $staff = new Staff($results[1]);
    }
    
    if ($file->room)
    {
        $room = new Room();
        $room->roomID = $file->room;
        $results = viewTable("rooms", $room);
        $room = new Room($results[1]);
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/actions.css') ?>
            <?php include('../styles/info.css') ?>
        </style>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <h2>Patient Information</h2>
                <div id="actions">
                    <a id="btnAction" href="add_postop.php?fileID=<?php echo $file->fileID ?>">Add Post-op Notes</a>
		        </div>
                   
				<fieldset style="height:200px;">
                    <legend><h3>Patient Details</h3></legend>
                    <table>
                        <?php if ($patient->identified)
                        { ?>
                            <tr>
                                <th>Patient ID</th>
                                <td><?php echo $patient->patientID ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th>First Name</th>
                            <td><?php echo $patient->firstName ?></td>
                        </tr>
                        <tr>
                            <th>Surname</th>
                            <td><?php echo $patient->surname ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo gender($patient->gender) ?></td>
                        </tr>
                        <?php if ($patient->identified)
                        { ?>
                            <tr>
                                <th>Date of Birth</th>
                                <td><?php echo $patient->dateOfBirth->format('jS M Y') ?></td>
                            </tr>
                        <?php } ?>
                    </table>
				</fieldset>

                <fieldset style="height:200px;">
                    <legend><h3>Case File Details</h3></legend>
                    <table>
                        <tr>
                            <th>Case Number</th>
                            <td><?php echo $file->fileID ?></td>
                        </tr>
                        <tr>
                            <th>Admission</th>
                            <td><?php echo $file->admission->format('g:i a D jS M Y') ?></td>
                        </tr>
                        <tr>
                            <th>Primary Doctor</th> 
                            <?php if($file->doctor)
                            { ?>
                                <td><?php echo $staff->firstName . " " . $staff->surname ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?php echo $staff->username ?></td>
                            <?php }
                            else
                            { ?>
                                <td>None assigned.</td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <th>Room</th>
                            <?php if($file->room)
                            { ?>
                                <td><?php echo $room->roomNumber ?></td>
                            </tr>
                            <tr>
                                <th>Ward</th>
                                <td><?php echo $room->ward ?></td>
                            <?php }
                            else
                            { ?>
                                <td>None assigned.</td>
                            <?php } ?>
                        </tr>
                    </table>
				</fieldset>
                
                <fieldset style="width:93%;">
                    <legend><h3>Patient Notes</h3></legend>
                    <?php $count = 0;
                    for ($i = 1; $i <= $notes[0]; $i++)
                    {
                        $note = new Note($notes[$i]);
                        
                        if (   ($note->type == "operation")
                            || ($note->type == "post-op"))
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
                                    <th valign="top">Details</th>
                                    <td><?php echo $note->details ?></td>
                                </tr>
                            </table>
                            <br>
                        <?php $count++;
                        }
                    }
                    
                    if (!$count)
                    { ?>
                        <p>No notes to display.</p>
                    <?php } ?>
                </fieldset>
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
