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
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <form>
					<fieldset>
						<legend><h2>Patient Information</h2></legend></legend>
							<div id="actions">
								<table>
								<tr id="tableRowB">
								<td><a id="btnAction" href="transfer.php?fileID=<?php echo $file->fileID ?>">Transfer</a></td>
								<td><a id="btnAction" href="add_operation.php?fileID=<?php echo $file->fileID ?>">Book Operation</a></td>
								<td><a id="btnAction" href="add_test.php?fileID=<?php echo $file->fileID ?>">Book Test</a></td>
								<td><a id="btnAction" href="add_order.php?fileID=<?php echo $file->fileID ?>">Add Order</a></td>
								<td><a id="btnAction" href="add_note.php?fileID=<?php echo $file->fileID ?>">Add Note</a></td>
								<td><a id="btnAction" href="discharge.php?fileID=<?php echo $file->fileID ?>">Discharge Patient</a></td>
								</tr>
								</table>
							</div> <!-- end #actions -->
					</fieldset>
				</form>
                
                <div id="patientDetails">
				<form>
					<fieldset>	
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
                </div> <!-- end #patientDetails -->
				</fieldset>
				</form>
                
                <div id="fileDetails">
				<form>
					<fieldset>
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
                </div> <!-- end #fileDetails -->
				</fieldset>
				</form>
                
                <div id="notes">
                    <h3>Patient Notes</h3>
                    <?php
                        for ($i = 1; $i <= $notes[0]; $i++)
                        {
                            $note = new Note($notes[$i]);
                            ?>
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
                            <br>
                        <?php }
                    ?>
                </div> <!-- end #notes -->
                
                <div id="history">
                <?php if ($file->patient) { ?>
                    <h3>Patient History</h3>
                    <p>Link to patient history</p>
                <?php } ?>
                </div> <!-- end #history -->
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
