<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $new = new Room($_POST);
    
    $check = new Room();
    $check->roomID = $new->roomID;
    
    $results = viewTable("rooms", $check);
    $old = new Room($results[1]);
    
    if ($check = ($old->occupied <= $new->capacity))
    {
        update("rooms", "roomID", $new->roomID, "capacity", $new->capacity);
    }
    
    $results = viewTable("rooms", $new);
    $room = new Room($results[1]);
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
                <?php if ($check)
                { ?>
                    <p>Updating of room successful.</p>
                    <table>
                        <tr id="tableRowHeader">
                            <th>Room Number</th>
                            <th>Ward</th>
                            <th>Room Capacity</th>
                            <th>Occupied Beds</th>
                        </tr>
                        
                        <tr id="tableRowA">
                            <td><?php echo $room->roomNumber ?></td>
                            <td><?php echo $room->ward ?></td>
                            <td><?php echo $room->capacity ?></td>
                            <td><?php echo $room->occupied ?></td>
                        </tr>
                    </table>
                <?php }
                else
                { ?>
                    <p>Updating of room unsuccessful. Would result in insufficient beds.</p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
