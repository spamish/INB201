<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $results = viewTable("procedures", new Procedure($_GET));
    $procedure = new Procedure($results[1]);
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

                <h2>Operation Procedure Details</h2>
                <table id="table">
                    <tr>
                        <td align="right">Procedure Code</td>
                        <td><?php echo $procedure->code ?></td>
                    </tr>
                    <tr>
                        <td align="right">Procedure Duration</td>
                        <td><?php echo $procedure->duration->format('H:i') ?></td>
                    </tr>
                    <tr>
                        <td align="right">Cost of Procedure</td>
                        <td>$<?php echo $procedure->cost ?></td>
                    </tr>
                    <tr>
                        <td align="right">Number of Surgeons Required</td>
                        <td><?php echo $procedure->required ?></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">Procedure Description</td>
                        <td><p><?php echo $procedure->description ?></p></td>
                    </tr>
                    <tr>
                        <td align="right">Capable Surgeons</td>
                    </tr>
                    <?php $procedure->surgeons = unserialize($procedure->surgeons);
                    for ($i = 0; $i < count($procedure->surgeons); $i++)
                    { ?>
                        <tr>
                            <td>Username <?php echo ($i + 1) ?></td>
                            <td><?php echo $procedure->surgeons[$i] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
