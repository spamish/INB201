<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('../includes/start_session.php');
    include('../includes/functions.php');
    
    $count = countTable("patients");
    $patient = viewTable("patients");
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

                <h2>View Patients</h2>
                <form action="/inb201/admin/room_edit.php" method="post">
                    <table>
                        <tr id="tableRowHeader">
                            <th id="tableHeader">Patient ID</th>
                            <th id="tableHeader">First Name</th>
                            <th id="tableHeader">Surname</th>
                            <th id="tableHeader">Room</th>
                            <th id="tableHeader"></th>
                            <td><input id="btnSubmit" type="submit"
                                value="Edit" style="float:right;"></td>
                            <td><input id="btnSubmit" type="submit"
                                value="Delete" style="float:right;"></td>
                        </tr>
                        <?php for ($i = 0; $i < $count; $i++) {
                            if ($i % 2 == 0)
                            { ?>
                                <tr id="tableRowA">
                            <?php }
                            else
                            { ?>
                                <tr id="tableRowB">
                            <?php } ?>
                                    <td id="tableCell"><?php echo $patient[$i]["roomNumber"]; ?></td>
                                    <td id="tableCell"><?php echo $patient[$i]["ward"]; ?></td>
                                    <td id="tableCell"><?php echo $patient[$i]["roomCapacity"]; ?></td>
                                    <td id="tableCell"><?php echo $patient[$i]["occupiedBeds"]; ?></td>
                                    <td>
                                        <input id="radio" type="radio" name="edit"
                                            value="<?php echo $i ?>">
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
