<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/recep_functions.php');
    require('../includes/functions.php');
    
    $append = isset($_POST['append']);
    $unidentified = isset($_POST['unidentified']) || (strlen($_POST['dateOfBirth']) == 0);
    
    if ($append)
    {
        $patient['mobileNumber'] = isset($_POST['mobileNumber']) ? $_POST['mobileNumber'] : null;
        $address['homePhone'] = isset($_POST['homePhone']) ? $_POST['homePhone'] : null;
        $address['unit'] = isset($_POST['unit']) ? $_POST['unit'] : null;
        $address['houseNumber'] = $_POST['houseNumber'];
        $address['street'] = $_POST['street'];
        $address['suburb'] = $_POST['suburb'];
        $address['postcode'] = $_POST['postcode'];
        $address['region'] = $_POST['region'];
        $address['country'] = $_POST['country'];
        
        if (  ($address['houseNumber']
            && $address['street']
            && $address['suburb']
            && $address['postcode']
            && $address['region']
            && $address['country'])
            || $address['homePhone'])
        {
            $address = searchAddress($address);
        }
    }
    
    $file['admission'] = timestamp();
    $file['state'] = $_POST['state'];
    
    $file = createFile($file);
    
    $note['file'] = $file['fileID'];
    $note['type'] = "admission";
    $note['staff'] = $_SESSION['login'];
    $note['details'] = $_POST['notes'];
    
    createNote($note);
    $note = viewNotes($file['fileID']);
    
    $patient['gender'] = $_POST['gender'];
    
    if ($unidentified)
    {
        $patient['firstName'] = isset($_POST['firstName']) ? $_POST['firstName'] : null;
        $patient['surname'] = isset($_POST['surname']) ? $_POST['surname'] : null;
        $patient['file'] = $file['fileID'];
        
        $patient = createUnidentified($patient);
    }
    else
    {
        $patient['dateOfBirth'] = $_POST['dateOfBirth'];
        $patient['firstName'] = $_POST['firstName'];
        $patient['surname'] = $_POST['surname'];
        
        $patient = createPatient($patient);
        
        echo var_dump($patient);
        
        assignPatient($file, $patient);
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
                        <?php if ($unidentified)
                        { ?>
                            <th>Forename</th>
                            <th>Postname</th>
                            <th>Gender</th>
                        <?php }
                        else
                        { ?>
                            <th>Patient ID</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <td>View Details</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php if ($unidentified)
                        { ?>
                            <td><?php echo $patient['forename'] ?></td>
                            <td><?php echo $patient['postname'] ?></td>
                            <td><?php echo gender($patient['gender']) ?></td>
                        <?php }
                        else
                        { ?>
                            <td><?php echo $patient[1]['patientID'] ?></td>
                            <td><?php echo $patient[1]['firstName'] ?></td>
                            <td><?php echo $patient[1]['surname'] ?></td>
                            <td><?php echo gender($patient[1]['gender']) ?></td>
                            <td><?php echo $patient[1]['dateOfBirth'] ?></td>
                            <td><?php echo $patient[1]['patientID'] ?></td>
                        <?php } ?>
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
                        <td><?php echo $file['fileID'] ?></td>
                        <td><?php echo $file['admission'] ?></td>
                        <td><?php echo condition($file['state']) ?></td>
                    </tr>
                </table>
                <h3>Case Notes</h3>
                <table>
                    <tr>
                        <th align="right">Type of Note</th>
                        <td><?php echo $note[0]['type'] ?></td>
                    </tr>
                    <tr>
                        <th align="right">By Staff</th>
                        <td><?php echo $note[0]['staff'] ?></td>
                    </tr>
                    <tr>
                        <th align="right">Created</th>
                        <td><?php echo $note[0]['time'] ?></td>
                    </tr>
                    <tr>
                        <th align="right">Details</th>
                        <td><?php echo $note[0]['details'] ?></td>
                    </tr>
                </table>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>