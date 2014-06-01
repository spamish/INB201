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
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                
                <h2>Add Operation</h2>
                
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
                
                <div id="operation">
                    <h3>Operation Details</h3>
                    <form action="summary.php" method="post">
                        <input type="hidden" name="function" value="operation">
                        <input type="hidden" name="fileID" value="<?php echo $file->fileID ?>">
                        <select name="code">
                            <option value="" selected>-</option>
                            <?php for ($i = 1; $i <= $list[0]; $i++) {
                                $operation = new Procedure($list[$i]) ?>
                                <option value="<?php echo $operation->code?>">
                                    <?php echo $operation->code ?></option>
                            <?php } ?>
                        </select><br>
                        <input id="btnSubmit" type="submit" name="submit" value="Confirm"><br>
                        <table>
                            <?php for ($i = 1; $i <= $list[0]; $i++) {
                                $operation = new Procedure($list[$i]) ?>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                </tr>
                                <tr>
                                    <td><?php echo $operation->code ?></td>
                                    <td><?php echo $operation->description ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </form>
                </div> <!-- end #discharge -->
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>