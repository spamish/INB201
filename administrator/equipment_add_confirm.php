<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $check = !searchAllRooms($_POST['roomNumber']);
    
    if ($check) {
        $roomNumber = $_POST['roomNumber'];
        $type = $_POST['type'];
        $schedule = $roomNumber;
        //Need to add schedule creation here.
        $staff = $_POST['staff'];
        //Search for staff member.
        
        createEquipment($roomNumber, $type, $schedule, $staff);
    }
    
    $equipment = searchAllRooms($roomNumber);
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
                    <p>Adding of medical equipment successful.</p>
                    <table>
                        <tr>
                            <th>Equipment Room</th>
                            <th>Schedule ID</th>
                            <th>Operating Staff Member</th>
                            <th>Equipment Description</th>
                        </tr>
                        
                        <tr id="tableRowA">
                            <td><?php echo $equipment['roomNumber'] ?></td>
                            <td><?php echo $equipment['schedule'] ?></td>
                            <td><?php echo $equipment['staff'] ?></td>
                            <td><?php echo $equipment['type'] ?></td>
                        </tr>
                    </table>
                <?php }
                else
                { ?>
                    <p>The room already exists.</p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
    
    <?php
        if (!$check) {
            header( "refresh:1; url=staff_add.php");
        }
        exit;
    ?>
</html>
