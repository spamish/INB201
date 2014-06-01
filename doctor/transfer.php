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
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
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
                <div id="patientDetails">
                <?php
                    if ($patient->identified)
                    { ?>
                        <h3>Patient Details</h3>
                        <p>Patient ID: <?php echo $patient->patientID ?><br>
                    <?php }
                    else
                    { ?>
                        <h3>Patient Details</h3>
                        <p>
                    <?php }
                    ?>
                    First Name: <?php echo $patient->firstName ?><br>
                    Surname: <?php echo $patient->surname ?><br>
                    Gender: <?php echo gender($patient->gender) ?>
                    <?php
                        if ($patient->identified)
                        { ?>
                            <br>Date of Birth: <?php echo $patient->dateOfBirth->format('jS M Y') ?>
                        <?php }
                    ?>
                    </p>
                </div> <!-- end #patientDetails -->
                
                <div id="fileDetails">
                    <h3>Case File Details</h3>
                    <p>Case Number: <?php echo $file->fileID ?><br>
                    Admission: <?php echo $file->admission->format('g:i a D jS M Y') ?></p>
                </div> <!-- end #fileDetails -->
                
                <div id="transfer">
                    <h3>Transfer Options</h3>
                    <form action="summary.php" method="post">
                        <input type="hidden" name="fileID" value="<?php echo $file->fileID ?>">
                        <input type="hidden" name="function" value="transfer">
                        <input type="hidden" name="file" value="<?php echo $file->fileID ?>">
                        
                        <input type="radio" name="transfer" id="radRoom" required
                            value="room" onchange="selectInputs();">Change Room<br>
                        <input type="radio" name="transfer" id="radWard"
                            value="ward" onchange="selectInputs();">Change Ward<br>
                        <input type="radio" name="transfer" id="radDoctor"
                            value="doctor" onchange="selectInputs();">Change Doctor<br>
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
                        <input id="btnSubmit" type="submit" name="submit" value="Confirm">
                    </form>
                    <p>*Need to add search option*</p>
                </div> <!-- end #discharge -->
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>