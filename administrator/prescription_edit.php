<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (!isset($_GET['prescriptionID']))
    {
        header ("Location: prescription_view.php");
    }
    
    $results = viewTable("prescriptions", new Prescription($_GET));
    $prescription = new Prescription($results[1]);
    
    if (isset($_GET['remove']))
    {
        delete("prescriptions", "prescriptionID", $prescription->prescriptionID);
        header ("Location: prescription_view.php");
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
                <?php if (isset($_GET['update']))
                { ?>
                    <h2>Edit Prescription</h2>
                    <form action="prescription_edit_confirm.php" method="post">
                        <input type="hidden" name="prescriptionID" value="<?php echo $prescription->prescriptionID ?>"/>
                        <fieldset style="width:90%;">
                            <legend><h3>Prescription Details</h3></legend>
                            <table>
                                <tr>
                                    <th>Prescription Code</th>
                                    <td><?php echo $prescription->code ?></td>
                                </tr>
                                <tr>
                                    <th>Cost of Prescription</th>
                                    <td>$<input type="text" name="cost" 
                                        required value="<?php echo $prescription->cost ?>"/></td>
                                </tr>
                                <tr>
                                    <th valign="top">Prescription Description</th>
                                    <td>
                                        <textarea rows="4" cols="32"
                                            name="description"><?php echo $prescription->description ?></textarea>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <h2 style="width:90%;"><input id="btnSubmit" type="submit" name="save" value="Save"/></h2>
                    </form>
                <?php }
                else
                { ?>
                    <h2>Error Removing Room</h2>
                    <p>There are still occupied beds listed.</p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
