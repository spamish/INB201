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
                <h2>Add Room</h2>
                <form action="room_add_confirm.php" method="post">
                    <fieldset style="width:90%;">
                        <legend><h3>Room Details</h3></legend>
                        <table>
                            <tr>
                                <th>Ward</th>
                                <th align="left">Room Number</th>
                            </tr>
                            <tr>
                                <td align="right">
                                    <select name="ward">
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </td>
                                <td><input type="text" name="roomNumber" required/></td>
                            </tr>
                            <tr>
                                <th>Number of Beds</th>
                                <td><input type="text" name="capacity" required/></td>
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
