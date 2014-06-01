<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (!isset($_POST['prescriptionID']))
    {
        header ("Location: prescription_view.php");
    }
    
    $results = viewTable("prescriptions", new Prescription($_POST));
    $prescription = new Prescription($results[1]);
    
    if (isset($_POST['remove']))
    {
        delete("prescriptions", "prescriptionID", $prescription->prescriptionID);
        header ("Location: prescription_view.php");
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
                <?php if (isset($_POST['update']))
                { ?>
                    <h2>Edit Prescription</h2>
                    <form action="prescription_edit_confirm.php" method="post" style="float:left;width=50%;">
                        <input type="hidden" name="prescriptionID" value="<?php echo $prescription->prescriptionID ?>">
                        <table>
                            <tr>
                                <td align="right">Prescription Code</td>
                                <td align="left"><?php echo $prescription->code ?></td>
                            </tr>
                            <tr>
                                <td align="right">Cost of Prescription</td>
                                <td align="left">$<input type="text" name="cost" 
                                    required value="<?php echo $prescription->cost ?>"></td>
                            </tr>
                            <tr>
                                <td align="right">Prescription Description</td>
                                <td align="left">
                                    <textarea rows="4" cols="32"
                                        name="description"><?php echo $prescription->description ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="left">
                                    <input id="btnSubmit" type="submit" name="save" value="Save">
                                </td>
                            </tr>
                        </table>
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
