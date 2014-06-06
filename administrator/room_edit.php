<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (!isset($_POST['roomID']))
    {
        header ("Location: room_view.php");
    }
    
    $results = viewTable("rooms", new Room($_POST));
    $room = new Room($results[1]);
    
    if (isset($_POST['remove']) && ($room->occupied == 0))
    {
        delete("rooms", "roomID", $room->roomID);
        header ("Location: room_view.php");
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
                <?php if (isset($_POST['update']))
                { ?>
                    <h2>Edit Room</h2>
                    <form action="room_edit_confirm.php" method="post">
                        <input type="hidden" name="roomID" value="<?php echo $room->roomID ?>"/>
                        <fieldset style="width:90%;">
                            <legend><h3>Room Details</h3></legend>
                            <table>
                                <tr>
                                    <th>Ward</th>
                                    <th align="left">Room Number</th>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <?php echo $room->ward ?>
                                    </td>
                                    <td>
                                        <?php echo $room->roomNumber ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Number of Beds</th>
                                    <td><input type="text" name="capacity" 
                                        required value="<?php echo $room->capacity ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Occupied Beds</th>
                                    <td>
                                        <?php echo $room->occupied ?>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <h2 style="width:90%;"><input id="btnSubmit" type="submit" name="update" value="Update"/></h2>
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
