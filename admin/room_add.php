<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('../includes/start_session.php');
    include('../includes/functions.php');
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
                <h2>Add Room</h2>
                <form action="room_add_confirm.php" method="post" style="float:left;width=50%;">
                    <table>
                        <tr>
                            <td align="right">Ward</td>
                            <td align="left">Room Number</td>
                        </tr>
                        <tr>
                            <td align="right">
                                <select name="ward">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </td>
                            <td align="left"><input type="text" name="roomNumber" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Number of Beds</td>
                            <td align="left"><input type="text" name="roomCapacity" required/></td>
                        </tr>
                        <tr>
                            </td>
                            <td align="right"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="left">
                                <input type="submit" value="Save">
                            </td>
                        </tr>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
