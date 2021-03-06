<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $id = $_POST['id'];
    $roomCapacity = $_POST['roomCapacity'];
    $rooms = viewTable("rooms");
    $check = ($roomCapacity >= $rooms[$id]['occupiedBeds']);
    
    if ($check)
    {
        editRoom($id, $roomCapacity);
    }
    
    $rooms = viewTable("rooms");
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
                            <th id="tableHeader">Room Number</th>
                            <th id="tableHeader">Ward</th>
                            <th id="tableHeader">Room Capacity</th>
                            <th id="tableHeader">Occupied Beds</th>
                        </tr>
                        
                        <tr id="tableRowA">
                            <td id="tableCell"><?php echo $rooms[$id]['roomNumber'] ?></td>
                            <td id="tableCell"><?php echo $rooms[$id]['ward'] ?></td>
                            <td id="tableCell"><?php echo $rooms[$id]['roomCapacity'] ?></td>
                            <td id="tableCell"><?php echo $rooms[$id]['occupiedBeds'] ?></td>
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
