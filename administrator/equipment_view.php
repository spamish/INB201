<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $url[0] = "equipment_view.php?order=";
    $url[1] = "&sort=";
    $order = (isset($_GET['order']) ? $_GET['order'] : null);
    $sort = (isset($_GET['sort']) ? ($_GET['sort'] ? true : false) : false);
    
    $table = viewTable("equipment", null, $order, $sort);
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

                <h2>Medical Equipment</h2>
                <form action="equipment_view_details.php" method="get">
                    <table>
                        <tr>
                            <th><a href="<?php echo $url[0] . "roomNumber" . $url[1] . !$sort ?>">Equipment Room</th>
                            <th><a href="<?php echo $url[0] . "code" . $url[1] . !$sort ?>">Test Code</th>
                            <th><a href="<?php echo $url[0] . "duration" . $url[1] . !$sort ?>">Test Duration</th>
                            <th><a href="<?php echo $url[0] . "cost" . $url[1] . !$sort ?>">Cost of Test</th>
                            <td id="selection">
                                <input id="btnSubmit" type="submit" name="details"
                                    value="View Details"/>
                            </td>
                        </tr>
                        <?php
                            for ($i = 1; $i <= $table[0]; $i++)
                            {
                                $equipment = new Equipment($table[$i]);
                                
                                if ($i % 2 == 0)
                                { ?>
                                    <tr id="tableRowA">
                                <?php }
                                else
                                { ?>
                                    <tr id="tableRowB">
                                <?php } ?>
                                        <td><?php echo "e" . $equipment->roomNumber ?></td>
                                        <td><?php echo $equipment->code ?></td>
                                        <td><?php echo $equipment->duration->format('H:i') ?></td>
                                        <td><?php echo $equipment->cost ?></td>
                                        <td id="selection">
                                            <input type="radio" name="equipmentID"
                                                value="<?php echo $equipment->equipmentID ?>"/>
                                        </td>
                                    </tr>
                            <?php }
                        ?>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
