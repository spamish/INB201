
            <?php include('../styles/info.css') ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $prescription = new Prescription($_POST);
    
    $check = checkCode($prescription);
    if ($check)
    {
        createPrescription($prescription);
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
                <h2>Summary</h2>
                <?php if ($check)
                { ?>
                    <div id="message">
                        <p>Adding of medicine prescription successful.</p>
                    </div>
                    
                    <fieldset>
                        <legend><h3>Prescription Details</h3></legend>
                        <table>
                            <tr>
                                <th>Prescription Code</th>
                                <td><?php echo $prescription->code ?></td>
                            </tr>
                            <tr>
                                <th>Cost of Prescription</th>
                                <td><?php echo $prescription->cost ?></td>
                            </tr>
                            <tr>
                                <th>Prescription Description</th>
                                <td><?php echo $prescription->description ?></td>
                            </tr>
                        </table>
                    </fieldset>
                <?php }
                else
                { ?>
                    <div id="message">
                        <p>The code is not unique.</p>
                    </div>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
