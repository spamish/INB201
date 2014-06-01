<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $results = viewTable("equipment", new Equipment($_GET));
    $equipment = new Equipment($results[1]);
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

                <h2>Medical Equipment Details</h2>
                <table id="table">
                    <tr>
                        <td align="right">Room Number</td>
                        <td><?php echo $equipment->roomNumber ?></td>
                    </tr>
                    <tr>
                        <td align="right">Test Code</td>
                        <td><?php echo $equipment->code ?></td>
                    </tr>
                    <tr>
                        <td align="right">Test Duration</td>
                        <td><?php echo $equipment->duration->format('H:i') ?></td>
                    </tr>
                    <tr>
                        <td align="right">Cost of Test</td>
                        <td>$<?php echo $equipment->cost ?></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Equipment Description</td>
                        <td><p><?php echo $equipment->description ?></p></td>
                    </tr>
                    <tr>
                        <td align="right">Capable Technicians</td>
                    </tr>
                    <?php $equipment->technicians = unserialize($equipment->technicians);
                    for ($i = 0; $i < count($equipment->technicians); $i++)
                    { ?>
                        <tr>
                            <td>Username <?php echo ($i + 1) ?></td>
                            <td><?php echo $equipment->technicians[$i] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
