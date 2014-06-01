<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $prescription = new Prescription($_POST);
    
    if ($prescription->cost)
    {
        update("prescriptions", "prescriptionID", $prescription->prescriptionID, "cost", $prescription->cost);
    }
    
    if ($prescription->description)
    {
        update("prescriptions", "prescriptionID", $prescription->prescriptionID, "description", $prescription->description);
    }
    
    $results = viewTable("prescriptions");
    $prescription = new Prescription($results[1]);
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
                <h2>Summary</h2>
                <p>Updating of medicine prescription successful.</p>
                <table>
                    <tr>
                        <th>Prescription Code</th>
                        <th>Cost of Prescription</th>
                        <th>Prescription Description</th>
                    </tr>
                    
                    <tr>
                        <td><?php echo $prescription->code ?></td>
                        <td><?php echo $prescription->cost ?></td>
                        <td><?php echo $prescription->description ?></td>
                    </tr>
                </table>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>