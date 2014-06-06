<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (!isset($_GET['procedureID']))
    {
        header ("Location: procedure_view.php");
    }
    
    $results = viewTable("procedures", new Procedure($_GET));
    $procedure = new Procedure($results[1]);
    $procedure->surgeons = unserialize($procedure->surgeons);
    
    if (isset($_GET['remove'])) //CHECK FOR POPULATED SCHEDULE!
    {
        delete("procedure", "procedureID", $procedure->procedureID);
        header ("Location: procedure_view.php");
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/info.css') ?>
        </style>
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            <div id="content"> <!-- All content goes here -->
                <?php if (isset($_GET['update']))
                { ?>
                    <h2>Edit Procedure</h2>
                    <form action="procedure_edit_confirm.php" method="post">
                        <input type="hidden" name="procedureID" value="<?php echo $procedure->procedureID ?>"/>
                        <input type="hidden" name="code" value="<?php echo $procedure->code ?>"/>
                        <fieldset style="height:270px;">
                            <legend><h3>Procedure Details</h3></legend>
                            <table>
                                <tr>
                                    <th>Procedure Code</th>
                                    <td><?php echo $procedure->code ?></td>
                                </tr>
                                <tr>
                                    <th>Procedure Duration</th>
                                    <td><input type="text" name="duration" 
                                        required value="<?php echo $procedure->duration->format('H:i') ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Cost of Procedure</th>
                                    <td><input type="text" name="cost" 
                                        required value="<?php echo $procedure->cost ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Surgeons Required</th>
                                    <td><input type="text" name="required" 
                                        required value="<?php echo $procedure->required ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Procedure Description</th>
                                    <td>
                                        <textarea rows="4" cols="32"
                                            name="description"><?php echo $procedure->description ?></textarea>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        
                        <fieldset style="height:270px;">
                            <legend><h3>Capable Surgeons</h3></legend>
                            <table id="table">
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="button" onclick="incStaff()">+</button>
                                        <input id="count" style="width:40px" disabled
                                            value="<?php echo count($procedure->surgeons) ?>"/>
                                        <button type="button" onclick="decStaff()">-</button>
                                    </td>
                                </tr>
                                <?php 
                                for ($i = 1; $i <= count($procedure->surgeons); $i++)
                                { ?>
                                    <tr>
                                        <th>Username <?php echo $i ?></th>
                                        <td>
                                            <input type="text" name="staff<?php echo $i ?>" required
                                                value="<?php echo $procedure->surgeons[$i - 1] ?>"/>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </fieldset>
                        <h2><input id="btnSubmit" type="submit" name="save" value="Save"/></h2>
                    </form>
                <?php }
                else
                { ?>
                    <h2>Error Removing Room</h2>
                    <p>There are still occupied beds listed.</p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
