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
    $notes = viewTable("notes", $note);
    
    if ($file->doctor)
    {
        $staff = new Staff();
        $staff->staffID = $file->doctor;
        $results = viewTable("staff", $staff);
        $staff = new Staff($results[1]);
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
                
                <h2>Patient Information</h2>
                <div id="actions">
                    <a id="btnAction" href="">Transfer to Ward</a>
                    <a id="btnAction" href="add_operation.php?fileID=<?php echo $file->fileID ?>">Book Operation</a>
                    <a id="btnAction" href="add_test.php?fileID=<?php echo $file->fileID ?>">Book Test</a>
                    <a id="btnAction" href="add_order.php?fileID=<?php echo $file->fileID ?>">Add Order</a>
                    <a id="btnAction" href="add_note.php?fileID=<?php echo $file->fileID ?>">Add Note</a>
                    <a id="btnAction" href="discharge.php?fileID=<?php echo $file->fileID ?>">Discharge Patient</a>
                </div> <!-- end #actions -->
                
                <div id="patientDetails">
                <?php
                    if ($patient->identified)
                    { ?>
                        <h3>Patient Details</h3>
                        <p>Patient ID: <?php echo $patient->patientID ?><br>
                    <?php }
                    else
                    { ?>
                        <h3>Patient Details <a id="btnSubmit" href="">Update</a></h3><p>
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
                    Admission: <?php echo $file->admission->format('g:i a D jS M Y') ?><br>
                    Primary Doctor: <?php
                        if($file->doctor)
                        {
                            echo $staff->firstName . " " . $staff->surname;
                            echo "<br>Username: " . $staff->username;
                        }
                        else
                        {
                            echo "None assigned.";
                        }
                    ?><br>
                    Room: <?php
                        if($file->room)
                        {
                            echo "Room."; ?>
                            Ward: <br>
                            <?php
                        }
                        else
                        {
                            echo "None assigned.";
                        }
                    ?></p>
                </div> <!-- end #fileDetails -->
                
                <div id="notes">
                    <h3>Patient Notes</h3>
                    <?php
                        for ($i = 1; $i <= $notes[0]; $i++)
                        {
                            $note = new Note($notes[$i]);
                            ?>
                            <p><?php echo ucfirst($note->type) ?><br>
                            <?php echo $note->timestamp->format('h:ia D, jS M Y') ?><br>
                            <?php echo $note->staff ?><br>
                            <?php echo $note->details ?><br>
                        <?php }
                    ?>
                </div> <!-- end #notes -->
                
                <div id="history">
                    <h3>Patient History</h3>
                    
                </div> <!-- end #history -->
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
