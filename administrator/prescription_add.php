<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/info.css') ?>
        </style>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            <div id="content"> <!-- All content goes here -->
                <h2>Add Medicine Prescription</h2>
                <form action="prescription_add_confirm.php" method="post">
                    <fieldset style="width:90%;">
                        <legend><h3>Prescription Details</h3></legend>
                        <table>
                            <tr>
                                <th>Prescription Code</th>
                                <td><input type="text" name="code" required/></td>
                            </tr>
                            <tr>
                                <th>Cost of Prescription</th>
                                <td>$<input type="text" name="cost" required/></td>
                            </tr>
                            <tr>
                                <th valign="top">Prescription Description</th>
                                <td><textarea rows="4" cols="32" name="description"></textarea></td>
                            </tr>
                        </table>
                    </fieldset>
                    <h2 style="width:90%;"><input id="btnSubmit" type="submit" name="save" value="Save"/></h2>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
