<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $url[0] = "theater_view.php?order=";
    $url[1] = "&sort=";
    $order = (isset($_GET['order']) ? $_GET['order'] : null);
    $sort = (isset($_GET['sort']) ? ($_GET['sort'] ? true : false) : false);
    
    $table = viewTable("theaters", null, $order, $sort);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/table.css') ?>
        </style>
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
                            <th><a href="<?php echo $url[0] . "roomNumber" . $url[1] . !$sort ?>">Theater Room</th>
                            <td id="selection">
                                <input id="btnSubmit" type="submit" name="remove"
                                    value="Remove">
                                </td>
                        </tr>
                        <?php for ($i = 1; $i <= $table[0]; $i++) {
                            $theater = new Theater($table[$i]);
                            if ($i % 2 == 0)
                            { ?>
                                <tr id="tableRowA">
                            <?php }
                            else
                            { ?>
                                <tr id="tableRowB">
                            <?php } ?>
                                    <td><?php echo "g" . $theater->roomNumber ?></td>
                                    <td id="selection">
                                        <input type="radio" name="theaterID"
                                            value="<?php echo $theater->theaterID ?>">
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
