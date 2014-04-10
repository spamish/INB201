<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('../includes/functions.php');
    session_start();
    $_SESSION['layer'] = 1;
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
                <table id="">
                    <tr>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Surname</th>
                        <th>Role</th>
                    </tr>
                    <?php
                        $count = tally();
                        $staff = staff();
                        for ($i = 0; $i < $count; $i++) {
                            if ($i % 2 == 0) { ?>
                                <tr id="">
                            <?php } else { ?>
                                <tr>
                            <?php } ?>
                            <td id=""><?php echo $staff[$i][0]; ?></td>
                            <td id=""><?php echo $staff[$i][1]; ?></td>
                            <td id=""><?php echo $staff[$i][2]; ?></td>
                            <td id=""><?php echo $staff[$i][3]; ?></td>
                        </tr>
                    <?php } ?>
                </table>

            </div> <!-- end #content -->
            
            <?php include('../includes/page_actions.php'); ?>
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
