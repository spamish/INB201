<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $id = $_POST['id'];
    $equipment = viewTable("equipment");
    $check = 1;
    
    if ($check)
    {
        $code = $_POST['code'];
        $duration = $_POST['duration'];
        $description = $_POST['description'];
        
        editEquipment($id, $code, $duration, $description);
    }
    
    $equipment = viewTable("equipment");
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
                    <p>Updating of medical equipment successful.</p>
                    <table>
                        <tr>
                            <th>Room Number</th>
                            <th>Test Code</th>
                            <th>Test Duration</th>
                            <th>Test Description</th>
                        </tr>
                        
                        <tr>
                            <td><?php echo $equipment[$id]['roomNumber'] ?></td>
                            <td><?php echo $equipment[$id]['code'] ?></td>
                            <td><?php echo $equipment[$id]['duration'] ?></td>
                            <td><?php echo $equipment[$id]['description'] ?></td>
                        </tr>
                    </table>
                <?php }
                else
                { ?>
                    <p></p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
