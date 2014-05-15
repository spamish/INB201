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
    $rooms = viewTable("rooms");
    
    if (isset($_POST['remove']) && ($rooms[$id]['occupiedBeds'] == 0))
    {
        deleteRoom("rooms", $rooms[$id]['roomNumber']);
        header ("Location: room_view.php");
    }
    elseif (isset($_POST['update']))
    {
        $roomNumber = $rooms[$id]['roomNumber'];
        $ward = $rooms[$id]['ward'];
        $roomCapacity = $rooms[$id]['roomCapacity'];
        $occupiedBeds = $rooms[$id]['occupiedBeds'];
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
                    <form action="room_edit_confirm.php" method="post" style="float:left;width=50%;">
                        <table>
                            <tr>
                                <td align="right">Ward</td>
                                <td align="left">Room Number</td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <?php echo $ward ?>
                                </td>
                                <td align="left">
                                    <?php echo $roomNumber ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Number of Beds</td>
                                <td align="left"><input type="text" name="roomCapacity" 
                                    required value="<?php echo $roomCapacity ?>"/></td>
                            </tr>
                            <tr>
                                <td align="right">Occupied Beds</td>
                                <td align="left">
                                    <?php echo $occupiedBeds ?>
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
