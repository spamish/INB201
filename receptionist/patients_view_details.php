<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $results = viewTable("files", new File($_GET));
    $file = new File($results[1]);
    $patient = new Patient();
    
    $discharge = new Note();
    $discharge->type = "discharge";
    $discharge->file = $file->fileID;
    $results = viewTable("notes", $discharge);
    $discharge = $results[0];
    
    //Select related patient details.
    if($file->patient)
    {
        $patient->patientID = $file->patient;
        $results = viewTable("patients", $patient);
        $patient = new Patient($results[1]);
        
        if ($patient->address)
        {
            $address = new Address();
            $address->addressID = $patient->address;
            $results = viewTable("addresses", $address);
            $address = new Address($results[1]);
        }
        
        $patient->identified = true;
    }
    else
    {
        $patient->file = $file->fileID;
        $results = viewTable("unidentified", $patient);
        $patient = new Patient($results[1]);
        $patient->identified = false;
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
                
                <?php
                    if ($patient->identified)
                    { ?>
                        <div id="contactDetails">
                            <h3>Contact Details <a id="btnSubmit" href="">Update</a></h3>
                            <p>Mobile Phone: <?php echo $patient->mobilePhone ?><br>
                            Home Phone: <?php echo $patient->homePhone ?><br>
                            <?php
                                if($patient->address)
                                { ?>
                                    Address: <?php echo ($address->unit ? ($address->unit . " /") : "") ?>
                                    <?php echo $address->house ?>
                                    <?php echo $address->street ?><br>
                                    Suburb: <?php echo $address->suburb ?><br>
                                    Postcode: <?php echo $address->postcode ?><br>
                                    State: <?php echo $address->region ?><br>
                                    Country: <?php echo $address->country ?><br>
                                <?php }
                                else
                                {
                                    echo "No address set.";
                                }
                            ?></p>
                        </div> <!-- end #contactDetails -->
                        
                        <div id="insuranceDetails">
                            <h3>Insurance Details <a id="btnSubmit" href="">Update</a></h3>
                            
                            <p><?php
                                if($patient->insurance)
                                {
                                    echo "Insurance.";
                                }
                                else
                                {
                                    echo "No insurance.";
                                }
                            ?></p>
                        </div> <!-- end #insuranceDetails -->
                        
                        <div id="guardianDetails">
                            <h3>Parent, Guardian or Next of Kin Details <a id="btnSubmit" href="">Update</a></h3>
                            <p><?php
                                if($patient->insurance)
                                {
                                    echo "Guardian.";
                                }
                                else
                                {
                                    echo "No details entered.";
                                }
                            ?></p>
                        </div> <!-- end #guardianDetails -->
                    <?php }
                ?>
                
                <div id="fileDetails">
                    <h3>Case File Details <?php
                        if ($discharge)
                        { ?>
                            <a id="btnSubmit" href="">Process Discharge</a>
                        <?php }
                    ?></h3>
                    <p>Case Number: <?php echo $file->fileID ?><br>
                    Admission: <?php echo $file->admission->format('g:i a D jS M Y') ?><br>
                    Primary Doctor: <?php
                        if($file->doctor)
                        {
                            echo "Doctor.";
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
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
