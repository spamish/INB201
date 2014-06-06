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
    
    $list = viewTable("procedures", null, "code");
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/info.css') ?>
            <?php include('../styles/lists.css') ?>
        </style>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                
                <h2>Add Operation</h2>
                
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
                        <legend><h3>Operation Details</h3></legend>
                        <input type="hidden" name="function" value="operation">
                        <input type="hidden" name="fileID" value="<?php echo $file->fileID ?>">
                        <h2>
                            <select name="code">
                                <option value="" selected>-</option>
                                <?php for ($i = 1; $i <= $list[0]; $i++) {
                                    $operation = new Procedure($list[$i]) ?>
                                    <option value="<?php echo $operation->code?>">
                                        <?php echo $operation->code ?></option>
                                <?php } ?>
                            </select><br>
                            <input id="btnSubmit" type="submit" name="submit" value="Confirm">
                        </h2>
                    </fieldset>
                </form>
                
                <fieldset style="width:93%;">
                    <legend><h3>Procedures</h3></legend>
                    <table id="lists" style="border-collapse:collapse;">
                        <?php for ($i = 1; $i <= $list[0]; $i++)
                        {
                            $operation = new Procedure($list[$i]) ?>
                            <tr>
                                <th>Code</th>
                                <th>Description</th>
                            </tr>
                            <tr>
                                <td align="right" valign="top"><?php echo $operation->code ?></td>
                                <td><?php echo $operation->description ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </fieldset>
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>