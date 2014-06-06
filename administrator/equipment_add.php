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
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            <div id="content"> <!-- All content goes here -->
                <h2>Add Medical Equipment</h2>
                <form action="equipment_add_confirm.php" method="post">
                    <fieldset style="height:250px;">
                        <legend><h3>Equipment Details</h3></legend>
                        <table>
                            <tr>
                                <th>Room Number</th>
                                <td><input type="text" name="roomNumber" required/></td>
                            </tr>
                            <tr>
                                <th>Test Code</th>
                                <td><input type="text" name="code" required/></td>
                            </tr>
                            <tr>
                                <th>Test Duration</th>
                                <td><input type="text" name="duration" required/></td>
                            </tr>
                            <tr>
                                <th>Cost of Test</th>
                                <td><input type="text" name="cost" required/></td>
                            </tr>
                            <tr>
                                <th valign="top">Equipment Description</th>
                                <td><textarea rows="4" cols="32" name="description"></textarea></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:250px;">
                        <legend><h3>Capable Technicians</h3></legend>
                        <table id="table">
                            <tr>
                                <td></td>
                                <td>
                                    <button type="button" onclick="incStaff()">+</button>
                                    <input id="count" style="width:40px" disabled value="1"/>
                                    <button type="button" onclick="decStaff()">-</button>
                                </td>
                            </tr>
                            <tr>
                                <th>Username 1</th>
                                <td><input type="text" name="staff1" required/></td>
                            </tr>
                        </table>
                    </fieldset>
                    <h2><input id="btnSubmit" type="submit" name="save" value="Save"/></h2>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
