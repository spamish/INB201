<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $url[0] = "staff_view.php?order=";
    $url[1] = "&sort=";
    $order = (isset($_GET['order']) ? $_GET['order'] : null);
    $sort = (isset($_GET['sort']) ? ($_GET['sort'] ? true : false) : false);
    
    $table = viewTable("staff", null, $order, $sort);
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
                <form action="staff_view_details.php" method="get">
                    <table>
                        <tr>
                            <th><a href="<?php echo $url[0] . "username" . $url[1] . !$sort ?>">Username</th>
                            <th><a href="<?php echo $url[0] . "firstName" . $url[1] . !$sort ?>">First Name</th>
                            <th><a href="<?php echo $url[0] . "surname" . $url[1] . !$sort ?>">Surname</th>
                            <th><a href="<?php echo $url[0] . "gender" . $url[1] . !$sort ?>">Gender</th>
                            <th><a href="<?php echo $url[0] . "dateOfBirth" . $url[1] . !$sort ?>">Date ofBirth</th>
                            <th><a href="<?php echo $url[0] . "position" . $url[1] . !$sort ?>">Position</th>
                            <th><a href="<?php echo $url[0] . "ward" . $url[1] . !$sort ?>">Ward</th>
                            <td>
                                <input id="btnSubmit" type="submit" name="details"
                                    value="View Details" style="float: right;">
                            </td>
                        </tr>
                        <?php for ($i = 1; $i <= $table[0]; $i++) {
                            $staff = new Staff($table[$i]);
                            if ($i % 2 == 0)
                            { ?>
                                <tr id="tableRowA">
                            <?php }
                            else
                            { ?>
                                <tr id="tableRowB">
                            <?php } ?>
                                    <td><?php echo $staff->username ?></td>
                                    <td><?php echo $staff->firstName ?></td>
                                    <td><?php echo $staff->surname ?></td>
                                    <td><?php echo gender($staff->gender) ?></td>
                                    <td><?php echo $staff->dateOfBirth->format('g M Y') ?></td>
                                    <td><?php echo position($staff->position) ?></td>
                                    <td><?php echo $staff->ward ?></td>
                                    <td>
                                        <input id="radio" type="radio" name="id"
                                            value="<?php echo $staff->staffID ?>">
                                    </td>
                                </tr>
                        <?php } ?>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
