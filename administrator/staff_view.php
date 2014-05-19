<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $order = isset($_GET['order']) ? $_GET['order'] : null;
    if (isset($_GET['sort']))
    {
        $sort = ($_GET['sort']) ? true : false;
    }
    else
    {
        $sort = false;
    }
    
    $table = viewTable("staff", $order, $sort);
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
                <form action="staff_view_details.php" method="post">
                    <table>
                        <tr>
                            <th><a href="staff_view.php?order=username&sort=<?php echo !$sort ?>">Username</th>
                            <th><a href="staff_view.php?order=firstName&sort=<?php echo !$sort ?>">First Name</th>
                            <th><a href="staff_view.php?order=surname&sort=<?php echo !$sort ?>">Surname</th>
                            <th><a href="staff_view.php?order=gender&sort=<?php echo !$sort ?>">Gender</th>
                            <th><a href="staff_view.php?order=dateOfBirth&sort=<?php echo !$sort ?>">Date ofBirth</th>
                            <th><a href="staff_view.php?order=position&sort=<?php echo !$sort ?>">Position</th>
                            <th><a href="staff_view.php?order=ward&sort=<?php echo !$sort ?>">Ward</th>
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
                                    <td><?php echo $staff->dateOfBirth ?></td>
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
