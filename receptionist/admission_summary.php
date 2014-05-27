<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/recep_functions.php');
    require('../includes/functions.php');
    
    $append = isset($_POST['append']);
    $patient = new Patient($_POST);
    
    //Update patient details.
    if ($append)
    {
        $search = $patient;
        $mobilePhone = $patient->mobilePhone;
        $search->mobilePhone = null;
        $homePhone = $patient->homePhone;
        $search->homePhone = null;
        
        $result = viewTable("patients", $search);
        $search->patientID = $result[1]['patientID'];
        
        if (strlen($_POST['mobilePhone']) > 0)
        {
            $patient = updatePatient($search, "mobilePhone", $mobilePhone);
        }
        
        if (strlen($_POST['homePhone']) > 0)
        {
            $patient = updatePatient($search, "homePhone", $homePhone);
        }
        
        $address = new Address($_POST);
        
        if (   $address->house
            && $address->street
            && $address->suburb
            && $address->postcode
            && $address->region
            && $address->country)
        {
            $address = assignAddress($address);
            $patient = updatePatient($search, "address", $address->addressID);
        }
        
        //Add guardian information.
        
        $patient->identified = true;
    }
    
    $file = new File($_POST);
    $file->admission = timestamp();
    
    $file = createFile($file);
    
    $note = new Note($_POST);
    $note->file = $file->fileID;
    $note->type = "admission";
    $note->timestamp = $file->admission;
    $note->staff = $_SESSION['login'];
    
    $note = createNote($note);
    
    if ($patient->identified)
    {
        updateFile($file, "patient", $patient->patientID);
    }
    else
    {
        $patient->file = $file->fileID;
        createUnidentified($patient);
    }
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
                        <td><?php echo $patient->dateOfBirth ?></td>
                    </tr>
                </table>
                <h3>Case Information</h3>
                <table>
                    <tr>
                        <th>Case ID</th>
                        <th>Admission Time</th>
                        <th>Condition</th>
                    </tr>
                    <tr>
                        <td><?php echo $file->fileID ?></td>
                        <td><?php echo $file->admission ?></td>
                        <td><?php echo condition($file->state) ?></td>
                    </tr>
                </table>
                <h3>Case Notes</h3>
                <table>
                    <tr>
                        <th align="right">By Staff</th>
                        <td><?php echo $note->staff ?></td>
                    </tr>
                    <tr>
                        <th align="right">Created</th>
                        <td><?php echo $note->timestamp ?></td>
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