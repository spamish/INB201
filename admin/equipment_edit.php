<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (!isset($_POST['id']))
    {
        header ("Location: room_view.php");
    }
    $id = $_POST['id'];
    $equipment = viewTable("equipment");
    
    if (isset($_POST['remove'])) //Check for populated schedule.
    {
        deleteRoom("equipment", $equipment[$id]['roomNumber']);
        header ("Location: room_view.php");
    }
    elseif (isset($_POST['update']))
    {
        $roomNumber = $equipment[$id]['roomNumber'];
        $type = $equipment[$id]['type'];
        $schedule = $equipment[$id]['schedule'];
        $staff = $equipment[$id]['staff'];
        
        editEquipment($id, $type, $staff);
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
                    <h2>Edit Room</h2>
                    <form action="equipment_edit_confirm.php" method="post" style="float:left;width=50%;">
                        <table>
                            <tr>
                                <td align="right">Room Number</td>
                                <td align="left">
                                    <?php echo $roomNumber ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Schedule ID</td>
                                <td align="left">
                                    <?php echo $schedule ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Operator Staff ID</td>
                                <td align="left"><input type="text" name="staff" 
                                    required value="<?php echo $staff ?>"/></td>
                            </tr>
                            <tr>
                                <td align="right">Equipment Description</td>
                                <td align="left">
                                    <textarea rows="4" cols="32" name="type"><?php echo $type ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                </td>
                                <td align="right"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="left">
                                    <input id="btnSubmit" type="submit" name="save" value="Save">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
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
