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
    
    $room = new Room();
    if ($file->room)
    {
        $room->roomID = $file->room;
        $results = viewTable("rooms", $room);
        $room = new Room($results[1]);
    }
    
    $staff = new Staff();
    if ($file->doctor)
    {
        $staff->staffID = $file->doctor;
        $results = viewTable("staff", $staff);
        $staff = new Staff($results[1]);
    }
    
    if (isset($_GET['failed']))
    {
        switch ($_GET['failed'])
        {
            case "room":
                $error = "Patient is still in admission, please change ward first.";
                break;
            
            case "ward":
                $error = "Doctor and room are not in the same ward or do not exist.";
                break;
            
            case "doctor":
                $error = "Doctor is not in the same ward as patient.";
                break;
            
            case "full":
                $error = "Room is full.";
                break;
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
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body onload="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                
                <h2>Transfer Patient</h2>
                <?php
                    if (isset($_GET['failed']))
                    {
                        echo "<h3>" . $error . "</h3>";
                    }
                ?>
                
				<fieldset style="height:180px;">
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
                
                <fieldset style="height:180px;">
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
                        </tr>
                    </table>
				</fieldset>
                
                <form action="summary.php" method="post">
                    <fieldset style="width:93%;">
                        <legend><h3>Transfer Options</h3></legend>
                        <input type="hidden" name="fileID" value="<?php echo $file->fileID ?>">
                        <input type="hidden" name="function" value="transfer">
                        <input type="hidden" name="file" value="<?php echo $file->fileID ?>">
                        <table style="margin-left:60px;">
                            <tr>
                                <td><input type="radio" name="transfer" id="radRoom" required
                                    value="room" onchange="selectInputs();"></td>
                                <th>Change Room</th>
                            </tr>
                            <tr>
                                <td><input type="radio" name="transfer" id="radWard"
                                    value="ward" onchange="selectInputs();"></td>
                                <th>Change Ward</th>
                            </tr>
                            <tr>
                                <td><input type="radio" name="transfer" id="radDoctor"
                                    value="doctor" onchange="selectInputs();"></td>
                                <th>Change Doctor</th>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th>Room Number</th>
                                <td>
                                    <input id="room" type="text" name="roomNumber" disabled
                                        required value="<?php echo $room->roomNumber ?>">
                                </td>
                                <th>Ward</th>
                                <td><select id="ward" name="ward" disabled>
                                    <?php if (!$file->room) { ?>
                                        <option value="-" selected>-</option>
                                    <?php } else { ?>
                                    <option value="">-</option>
                                    <?php }
                                    if ($room->ward == 'B') { ?>
                                        <option value="B" selected>B</option>
                                    <?php } else { ?>
                                        <option value="B">B</option>
                                    <?php }
                                    if ($room->ward == 'C') { ?>
                                        <option value="C" selected>C</option>
                                    <?php } else { ?>
                                        <option value="C">C</option>
                                    <?php }
                                    if ($room->ward == 'D') { ?>
                                        <option value="D" selected>D</option>
                                    <?php } else { ?>
                                        <option value="D">D</option>
                                    <?php } ?>
                                </select></td>
                            </tr>
                            <tr>
                                <th>Doctor Username</th>
                                <td>
                                    <input id="doctor" type="text" name="username" disabled
                                        required value="<?php echo $staff->username ?>">
                                </td>
                                <td><?php echo $staff->firstName ?></td>
                                <td><?php echo $staff->surname ?></td>
                            </tr>
                        </table>
                        <h2><input id="btnSubmit" type="submit" name="submit" value="Confirm"></h2>
                    </fieldset>
                </form>
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>