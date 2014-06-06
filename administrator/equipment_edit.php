<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (!isset($_GET['equipmentID']))
    {
        header ("Location: equipment_view.php");
    }
    
    $results = viewTable("equipment", new Equipment($_GET));
    $equipment = new Equipment($results[1]);
    $equipment->technicians = unserialize($equipment->technicians);
    
    if (isset($_GET['remove'])) //CHECK FOR POPULATED SCHEDULE!
    {
        delete("equipment", "equipmentID", $equipment->equipmentID);
        header ("Location: equipment_view.php");
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/info.css') ?>
        </style>
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            <div id="content"> <!-- All content goes here -->
                <?php if (isset($_GET['update']))
                { ?>
                    <h2>Edit Room</h2>
                    <form action="equipment_edit_confirm.php" method="post">
                        <input type="hidden" name="equipmentID" value="<?php echo $equipment->equipmentID ?>">
                        <input type="hidden" name="roomNumber" value="<?php echo $equipment->roomNumber ?>">
                        <input type="hidden" name="code" value="<?php echo $equipment->code ?>">
                        <fieldset style="height:250px;">
                            <legend><h3>Equipment Details</h3></legend>
                            <table>
                                <tr>
                                    <th>Room Number</th>
                                    <td>
                                        <?php echo $equipment->roomNumber ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Test Code</th>
                                    <td><?php echo $equipment->code ?></td>
                                </tr>
                                <tr>
                                    <th>Test Duration</th>
                                    <td><input type="text" name="duration" 
                                        required value="<?php echo $equipment->duration->format('H:i') ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Cost of Test</th>
                                    <td><input type="text" name="cost" 
                                        required value="<?php echo $equipment->cost ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Equipment Description</th>
                                    <td>
                                        <textarea rows="4" cols="32"
                                            name="description"><?php echo $equipment->description ?></textarea>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        
                        <fieldset style="height:250px;">
                            <legend><h3>Capable Technicians</h3></legend>
                            <table id="table">
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="button" onclick="incStaff()">+</button>
                                        <input id="count" style="width:40px" disabled value="1"/>
                                        <button type="button" onclick="decStaff()">-</button>
                                    </td>
                                </tr>
                                <?php 
                                for ($i = 1; $i <= count($equipment->technicians); $i++)
                                { ?>
                                    <tr>
                                        <th>Username <?php echo $i ?></th>
                                        <td>
                                            <input type="text" name="staff<?php echo $i ?>" required
                                                value="<?php echo $equipment->technicians[$i - 1] ?>"/>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </fieldset>
                        <h2><input id="btnSubmit" type="submit" name="save" value="Save"/></h2>
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
