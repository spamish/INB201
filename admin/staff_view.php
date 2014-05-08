<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $count = countTable("staff");
    $staff = viewTable("staff");
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

                <h2>Staff Members</h2>
                <form action="/inb201/admin/staff_edit.php" method="post">
                    <table>
                        <tr id="tableRowHeader">
                            <th id="tableHeader">Username</th>
                            <th id="tableHeader">First Name</th>
                            <th id="tableHeader">Surname</th>
                            <th id="tableHeader">Date of Birth</th>
                            <th id="tableHeader">Phone Number</th>
                            <th id="tableHeader">Salary</th>
                            <th id="tableHeader">Position</th>
                            <th id="tableHeader">Ward</th>
                            <td><input id="btnSubmit" type="submit" name="edit"
                                value="Edit" style="float:right;"></td>
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
<<<<<<< HEAD
                                    <td id="tableCell"><?php echo $staff[$i]['username'] ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]['firstName'] ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]['surname'] ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]['dateOfBirth'] ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]['phoneNumber'] ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]['salary'] ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]['position'] ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]['ward'] ?></td>
                                    <td><?php if ($i != $_SESSION['login']) { ?>
                                        <input id="radio" type="radio" name="id"
                                            value="<?php echo $staff[$i]['staffID'] ?>">
=======
                                    <td id="tableCell"><?php echo $staff[$i]["username"]; ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]["firstName"]; ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]["surname"]; ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]["dateOfBirth"]; ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]["phoneNumber"]; ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]["salary"]; ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]["position"]; ?></td>
                                    <td id="tableCell"><?php echo $staff[$i]["ward"]; ?></td>
                                    <td><?php if ($i != $_SESSION['login'] - 1) { ?>
                                        <input id="radio" type="radio" name="edit"
                                            value="<?php echo $i ?>">
>>>>>>> master
                                    <?php } ?></td>
                                </tr>
                        <?php } ?>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
