<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $url[0] = "procedure_view.php?order=";
    $url[1] = "&sort=";
    $order = (isset($_GET['order']) ? $_GET['order'] : null);
    $sort = (isset($_GET['sort']) ? ($_GET['sort'] ? true : false) : false);
    
    $table = viewTable("procedures", null, $order, $sort);
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

                <h2>Operation Procedures</h2>
                <form action="procedure_edit.php" method="post">
                    <table>
                        <tr>
                            <th><a href="<?php echo $url[0] . "code" . $url[1] . !$sort ?>">Procedure Code</th>
                            <th><a href="<?php echo $url[0] . "duration" . $url[1] . !$sort ?>">Procedure Duration</th>
                            <th><a href="<?php echo $url[0] . "cost" . $url[1] . !$sort ?>">Cost of Procedure</th>
                            <td>
                                <input id="btnSubmit" type="submit" name="update"
                                    value="Update" style="float:right;">
                            </td>
                            <td>
                                <input id="btnSubmit" type="submit" name="remove"
                                    value="Remove" style="float:right;">
                            </td>
                            
                        </tr>
                        <?php
                            for ($i = 1; $i <= $table[0]; $i++)
                            {
                                $procedure = new Procedure($table[$i]);
                                
                                if ($i % 2 == 0)
                                { ?>
                                    <tr id="tableRowA">
                                <?php }
                                else
                                { ?>
                                    <tr id="tableRowB">
                                <?php } ?>
                                        <td><?php echo $procedure->code ?></td>
                                        <td><?php echo $procedure->duration->format('H:i') ?></td>
                                        <td><?php echo $procedure->cost ?></td>
                                        <td>
                                            <input id="radio" type="radio" name="procedureID"
                                                value="<?php echo $procedure->procedureID ?>">
                                        </td>
                                        <td>
                                            <a id="btnSubmit"
                                                href="procedure_view_details.php?procedureID=<?php
                                                echo $procedure->procedureID ?>">View Details</a>
                                        </td>
                                    <tr>
                            <?php }
                        ?>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
