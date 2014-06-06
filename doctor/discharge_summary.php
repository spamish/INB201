<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $date = new DateTime();
    
    $file = new File($_POST);
    update("files", "fileID", $file->fileID, "discharge", $date->format('Y-m-d H:i:s'));
    
    $results = viewTable("files", $file);
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
    
    $note = new Note($_POST);
    $date = new DateTime();
    $note->file = $file->fileID;
    $note->type = "discharge";
    $note->timestamp = $file->discharge;
    $note->staff = $_SESSION['login'];
    
    createNote($note);
    
    $staff = new Staff();
    $staff->staffID = $_SESSION['login'];
    $results = viewTable("staff", $staff);
    $staff = new Staff($results[1]);
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
                <h2>Summary</h2>
                
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
                        <tr>
                            <th>Discharge</th>
                            <td><?php echo $file->discharge->format('g:i a D jS M Y') ?></td>
                        </tr>
                    </table>
				</fieldset>
                
                <fieldset style="width:93%;">
                    <legend><h3>Discharge Notes</h3></legend>
                    <table>
                        <tr>
                            <th>By Staff</th>
                            <td>
                                <?php echo $staff->firstName
                                   . " " . $staff->surname?>
                            </td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td><?php echo $note->timestamp->format('g:ia jS M Y') ?></td>
                        </tr>
                        <tr>
                            <th>Details</th>
                            <td><?php echo $note->details ?></td>
                        </tr>
                    </table>
                </fieldset>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>