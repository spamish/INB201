<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
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

                <h2>Medical Equipment</h2>
                <form action="equipment_edit.php" method="post">
                    <table>
                        <tr>
                            <th><a href="equipment_view.php?order=roomNumber">Equipment Room</th>
                            <th><a href="equipment_view.php?order=code">Test Code</th>
                            <th><a href="equipment_view.php?order=duration">Test Duration</th>
                            <th>Test Description</th>
                            <td><input id="btnSubmit" type="submit" name="update"
                                value="Update" style="float:right;"></td>
                            <td><input id="btnSubmit" type="submit" name="remove"
                                value="Remove" style="float:right;"></td>
                            
                        </tr>
                        <?php for ($i = 1; $i <= $equipment[0]; $i++) {
                            if ($i % 2 == 0)
                            { ?>
                                <tr id="tableRowA">
                            <?php }
                            else
                            { ?>
                                <tr id="tableRowB">
                            <?php } ?>
                                    <td><?php echo "e" . roomNumber($equipment[$i]['roomNumber']) ?></td>
                                    <td><?php echo $equipment[$i]['code'] ?></td>
                                    <td><?php echo $equipment[$i]['duration'] ?></td>
                                    <td><?php echo $equipment[$i]['description'] ?></td>
                                    <td>
                                        <input id="radio" type="radio" name="id"
                                            value="<?php echo $equipment[$i]['equipmentID'] ?>">
                                    </td>
                                <tr>
                        <?php } ?>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
