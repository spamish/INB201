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
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/actions.css') ?>
            <?php include('../styles/info.css') ?>
        </style>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->

                <h2>Operation Procedure Information</h2>
                <form id="actions" action="procedure_edit.php" method="get">
                    <input id="btnAction" type="submit" name="update" value="Update"/>
                    <input id="btnAction" type="submit" name="remove" value="Remove"/>
                    <input type="hidden" name="procedureID" value="<?php echo $procedure->procedureID ?>"/>
                </form> <!-- end #actions -->
                
                <fieldset>
                    <legend><h3>Procedure Details</h3></legend>
                    <table>
                        <tr>
                            <th>Procedure Code</th>
                            <td><?php echo $procedure->code ?></td>
                        </tr>
                        <tr>
                            <th>Procedure Duration</th>
                            <td><?php echo $procedure->duration->format('H:i') ?></td>
                        </tr>
                        <tr>
                            <th>Cost of Procedure</th>
                            <td>$<?php echo $procedure->cost ?></td>
                        </tr>
                        <tr>
                            <th>No. Surgeons Req</th>
                            <td><?php echo $procedure->required ?></td>
                        </tr>
                        <tr>
                            <th valign="top">Procedure Description</th>
                            <td><p><?php echo $procedure->description ?></p></td>
                        </tr>
                    </table>
                </fieldset>
                    
                <fieldset>
                    <legend><h3>Capable Surgeons</h3></legend>
                    <table>
                        <tr>
                            <?php $procedure->surgeons = unserialize($procedure->surgeons);
                            for ($i = 0; $i < count($procedure->surgeons); $i++)
                            { ?>
                                <td style="padding-right:5px" width="20px" align="right">
                                    <?php echo $procedure->surgeons[$i] ?>
                                </td>
                                <?php if (!(($i + 1) % 5)) 
                                { ?>
                                    </tr><tr>
                                <?php }
                            } ?>
                        </tr>
                    </table>
                </fieldset>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
