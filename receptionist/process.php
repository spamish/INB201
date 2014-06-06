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
        $patient->identified = true;
        
    }
    else
    {
        $patient->file = $file->fileID;
        $results = viewTable("unidentified", $patient);
        $patient = new Patient($results[1]);
        $patient->identified = false;
    }
    
    if ($patient->insurance)
    {
        $insurance = new Insurance();
        $insurance->insuranceID = $patient->insurance;
        $results = viewTable("insurance", $insurance);
        $insurance = new Insurance($results[1]);
        
        $remainder = 0;
        $due = $file->balance;
        
        if ($insurance->maximum)
        {
            if ($file->balance > $insurance->maximum)
            {
                $due = $file->balance - $insurance->maximum;
            }
            else
            {
                $due = 0;
            }
        }
        
        if ($insurance->percent)
        {
            $due = $due - ($due * ($insurance->percent / 100));
            
            if ($due < 0)
            {
                $due = 0;
            }
        }
    }
    else
    {
        $due = $file->balance;
    }
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
                <h2>Process Payment</h2>
                
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
                            <th>Balance</th>
                            <td>$<?php echo $file->balance ?></td>
                        </tr>
                        <tr>
                            <th>Admission</th>
                            <td><?php echo $file->admission->format('g:i a D jS M Y') ?></td>
                        </tr>
                        <?php if ($file->discharge)
                        { ?>
                            <tr>
                                <th>Discharge</th>
                                <td><?php echo $file->discharge->format('g:i a D jS M Y') ?></td>
                            </tr>
                        <?php } ?>
                    </table>
				</fieldset>
                
                <fieldset style="width:93%;">
                    <legend><h3>Insurance Details</h3></legend>
                    <?php
                    if($patient->insurance)
                    { ?>
                        <table>
                            <tr>
                                <th>Provider</th>
                                <td><?php echo $insurance->provider ?></td>
                            <tr>
                            </tr>
                                <th>Policy</th>
                                <td><?php echo $insurance->policy ?></td>
                            <tr>
                            <?php if ($insurance->percent)
                            { ?>
                                <tr>
                                    <th>Rebate Percentage</th>
                                    <td><?php echo $insurance->percent ?>%</td>
                                </tr>
                            <? }
                            if ($insurance->maximum)
                            { ?>
                                <tr>
                                    <th>Maximum Rebate</th>
                                    <td>$<?php echo $insurance->maximum ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php }
                    else
                    {
                        echo "No insurance.";
                    } ?>
                </fieldset>
                
                <form id="process" action="summary.php" method="post">
                    <input type="hidden" name="fileID" value="<?php echo $file->fileID?>"/>
                    <input type="hidden" name="function" value="payment"/>
                    <input type="hidden" name="due" value="<?php echo $due ?>"/>
                    <fieldset style="width:93%;">
                        <legend><h3>Payment Details</h3></legend>
                        <table>
                            <tr>
                                <th>Amount due</th>
                                <td>$<?php echo $due ?></td>
                            </tr>
                            <tr>
                                <th>Amount to pay</th>
                                <td>$<input type="text" name="amount" style="width:50px;"
                                    <?php echo (($due == 0) ? "disabled" : "required") ?>/></td>
                            </tr>
                        </table>
                        <h2><input id="btnSubmit" type="submit" name="submit" value="Submit"></h2>
                    </fieldset>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
