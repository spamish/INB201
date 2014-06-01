<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $i = 1;
    while (isset($_POST['staff' . $i]))
    {
        $staff = new Staff();
        $staff->username = $_POST['staff' . $i];
        $results = viewTable("staff", $staff);
        if ($results[0])
        {
            $staff = new Staff($results[1]);
            if ($staff->position == "technician")
            {
                $technicians[] = $staff->staffID;
            }
            else
            {
                $error = "A selected medical technician is assigned to a different role.";
                $check = false;
            }
        }
        else
        {
            $error = "A selected medical technician doesn't exist.";
            $check = false;
        }
        
        $i++;
    }
    
    $equipment = new Equipment($_POST);
    $equipment->technicians = serialize($technicians);
    
    if (!($check = checkCode($equipment)))
    {
        $error = "The equipment code is not unique.";
        $check = false;
    }
    
    $room = new Equipment();
    $room->roomNumber = $equipment->roomNumber;
    $results = viewTable("equipment", $room);
    
    if ($results[0])
    {
        $error = "The room is already in use.";
        $check = false;
    }
    
    if ($check)
    {
        createEquipment($equipment);
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
                <h2>Summary</h2>
                <?php if ($check)
                { ?>
                    <p>Adding of medical equipment successful.</p>
                    <table>
                        <tr>
                            <th>Equipment Room</th>
                            <th>Test Code</th>
                            <th>Test Duration</th>
                            <th>Cost of Test</th>
                            <th>Capable Technicians</th>
                            <th>Equipment Description</th>
                        </tr>
                        
                        <tr id="tableRowA">
                            <td><?php echo $equipment->roomNumber ?></td>
                            <td><?php echo $equipment->code ?></td>
                            <td><?php echo $equipment->duration->format('H:i') ?></td>
                            <td><?php echo $equipment->cost ?></td>
                            <td><?php $equipment->technicians = unserialize($equipment->technicians);
                            for ($i = 0; $i < count($equipment->technicians); $i++)
                            {
                                echo $equipment->technicians[$i] . "<br>";
                            } ?></td>
                            <td><?php echo $equipment->description ?></td>
                        </tr>
                    </table>
                <?php }
                else
                { ?>
                    <p><?php echo $error ?></p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
