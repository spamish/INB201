<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $policy = viewTable("insurance");
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

                <h2>Insurance Policies</h2>
                <form action="" method="post">
                    <table>
                        <tr>
                            <th>Policy Name</th>
                            <th>Provider</th>
                            <th>Benefit Description</th>
                            <th>Rebate Percent</th>
                            <th>Maximum Rebate</th>
                            <td><input id="btnSubmit" type="submit" name="edit" value="Edit" style="float:right;"></td>
                            <td><input id="btnSubmit" type="submit" name="delete" value="Delete" style="float:right;"></td>
                            
                        </tr>
                        <?php for ($i = 1; $i <= $policy[0]; $i++) {
                            if ($i % 2 == 0)
                            { ?>
                                <tr id="tableRowA">
                            <?php }
                            else
                            { ?>
                                <tr id="tableRowB">
                            <?php } ?>
                                    <td><?php echo $policy[$i]['policyName'] ?></td>
                                    <td><?php echo $policy[$i]['provider'] ?></td>
                                    <td><?php echo $policy[$i]['benefit'] ?></td>
                                    <td><?php echo $policy[$i]['rebatePercent'] ?></td>
                                    <td><?php echo $policy[$i]['rebateMaximum'] ?></td>
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
