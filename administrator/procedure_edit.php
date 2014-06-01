<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (!isset($_POST['procedureID']))
    {
        header ("Location: procedure_view.php");
    }
    
    $results = viewTable("procedures", new Procedure($_POST));
    $procedure = new Procedure($results[1]);
    $procedure->surgeons = unserialize($procedure->surgeons);
    
    if (isset($_POST['remove'])) //CHECK FOR POPULATED SCHEDULE!
    {
        delete("procedure", "procedureID", $procedure->procedureID);
        header ("Location: procedure_view.php");
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            <div id="content"> <!-- All content goes here -->
                <?php if (isset($_POST['update']))
                { ?>
                    <h2>Edit Procedure</h2>
                    <form action="procedure_edit_confirm.php" method="post" style="float:left;width=50%;">
                        <input type="hidden" name="procedureID" value="<?php echo $procedure->procedureID ?>">
                        <input type="hidden" name="code" value="<?php echo $procedure->code ?>">
                        <table>
                            <tr>
                                <td align="right">Procedure Code</td>
                                <td align="left"><?php echo $procedure->code ?></td>
                            </tr>
                            <tr>
                                <td align="right">Procedure Duration</td>
                                <td align="left"><input type="text" name="duration" 
                                    required value="<?php echo $procedure->duration->format('H:i') ?>"></td>
                            </tr>
                            <tr>
                                <td align="right">Cost of Procedure</td>
                                <td align="left"><input type="text" name="cost" 
                                    required value="<?php echo $procedure->cost ?>"></td>
                            </tr>
                            <tr>
                                <td align="right">Surgeons Required</td>
                                <td align="left"><input type="text" name="required" 
                                    required value="<?php echo $procedure->required ?>"></td>
                            </tr>
                            <tr>
                                <td align="right">Procedure Description</td>
                                <td align="left">
                                    <textarea rows="4" cols="32"
                                        name="description"><?php echo $procedure->description ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Capable Surgeons</td>
                                <td>
                                    <button type="button" onclick="incStaff()">+</button>
                                    <input id="count" style="width:40px" disabled
                                        value="<?php echo count($procedure->surgeons) ?>">
                                    <button type="button" onclick="decStaff()">-</button>
                                </td>
                            </tr>
                            <?php 
                            for ($i = 1; $i <= count($procedure->surgeons); $i++)
                            { ?>
                                <tr>
                                    <td>Username <?php echo $i ?></td>
                                    <td>
                                        <input type="text" name="staff<?php echo $i ?>" required
                                            value="<?php echo $procedure->surgeons[$i - 1] ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td></td>
                                <td align="left">
                                    <input id="btnSubmit" type="submit" name="save" value="Save">
                                </td>
                            </tr>
                        </table>
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
