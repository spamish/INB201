<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $count = countTable("equipment");
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
                <form action="/inb201/admin/equipment_edit.php" method="post">
                    <table>
                        <tr>
                            <th>Equipment Room</th>
                            <th>Operator Staff ID</th>
                            <th>Equipment Tag</th>
                            <th>Equipment Name</th>
                            <td><input id="btnSubmit" type="submit" name="update"
                                value="Update" style="float:right;"></td>
                            <td><input id="btnSubmit" type="submit" name="remove"
                                value="Remove" style="float:right;"></td>
                            
                        </tr>
                        <?php for ($i = 1; $i <= $count; $i++) {
                            if ($i % 2 == 0)
                            { ?>
                                <tr id="tableRowA">
                            <?php }
                            else
                            { ?>
                                <tr id="tableRowB">
                            <?php } ?>
                                    <td><?php echo $equipment[$i]['roomNumber'] ?></td>
                                    <td><?php echo $equipment[$i]['staff'] ?></td>
                                    <td><?php echo strstr($equipment[$i]['type'], "-", true) ?></td>
                                    <td><?php echo substr($equipment[$i]['type'], strrpos($equipment[$i]['type'], "- ") + 1) ?></td>
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
