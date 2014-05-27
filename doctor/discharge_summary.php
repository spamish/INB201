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
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <title>T.O.U.C.H. Online System</title>
    </head>
    
    <body>
        <div id="wrapper">
            
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <h2>Summary</h2>
                <h3>Patient Information</h3>
                <table>
                    <tr>
                        <th>Patient ID</th>
                        <th>First Name</th>
                        <th>Surname</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                    </tr>
                    <tr>
                        <td><?php echo ($patient->identified ? $patient->patientID : "") ?></td>
                        <td><?php echo $patient->firstName ?></td>
                        <td><?php echo $patient->surname ?></td>
                        <td><?php echo gender($patient->gender) ?></td>
                        <td><?php echo (isset($patient->dateOfBirth) ? $patient->dateOfBirth->format('jS M Y') : "") ?></td>
                    </tr>
                </table>
                <h3>Case Information</h3>
                <table>
                    <tr>
                        <th>Case ID</th>
                        <th>Admission Time</th>
                        <th>Discharge Time</th>
                    </tr>
                    <tr>
                        <td><?php echo $file->fileID ?></td>
                        <td><?php echo $file->admission->format('g:ia jS M Y') ?></td>
                        <td><?php echo $file->discharge->format('g:ia jS M Y') ?></td>
                    </tr>
                </table>
                <h3>Discharge Notes</h3>
                <table>
                    <tr>
                        <th align="right">By Staff</th>
                        <td>
                            <?php echo $staff->firstName
                               . " " . $staff->surname?>
                        </td>
                    </tr>
                    <tr>
                        <th align="right">Created</th>
                        <td><?php echo $note->timestamp->format('g:ia jS M Y') ?></td>
                    </tr>
                    <tr>
                        <th align="right">Details</th>
                        <td><?php echo $note->details ?></td>
                    </tr>
                </table>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>