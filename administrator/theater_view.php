<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $theaters = viewTable("theaters");
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

                <h2>Operating Theaters</h2>
                <form action="theater_add.php" method="post">
                    <table>
                        <tr>
                            <th><a href="theater_view.php?order=roomNumber">Theater Room</th>
                            <td><input id="btnSubmit" type="submit" name="remove"
                                value="Remove" style="float:right;"></td>
                            
                        </tr>
                        <?php for ($i = 1; $i <= $theaters[0]; $i++) {
                            if ($i % 2 == 0)
                            { ?>
                                <tr id="tableRowA">
                            <?php }
                            else
                            { ?>
                                <tr id="tableRowB">
                            <?php } ?>
                                    <td><?php echo "g" . roomNumber($theaters[$i]['roomNumber']) ?></td>
                                    <td>
                                        <input id="radio" type="radio" name="id"
                                            value="<?php echo $theaters[$i]['theaterID'] ?>">
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
