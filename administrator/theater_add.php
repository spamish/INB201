<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (isset($_POST['remove']))
    {
        if(isset($_POST['theaterID'])) //CHECK FOR POPULATED SCHEDULE!
        {
            delete("theaters", "theaterID", $_POST['theaterID']);
        }
        header ("Location: theater_view.php");
    }
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
                <h2>Add Operating Theater</h2>
                <form action="theater_add_confirm.php" method="post" style="float:left;width=50%;">
                    <table>
                        <tr>
                            <td align="right">Room Number</td>
                            <td><input type="text" name="roomNumber" required/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="left">
                                <input id="btnSubmit" type="submit" name="save" value="Save">
                            </td>
                        </tr>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
