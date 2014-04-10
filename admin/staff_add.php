<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('../includes/functions.php');
    session_start();
    $_SESSION['layer'] = 2;
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
                <h2>Add Staff</h2>
                <form action="staff_add_confirm.php" method="post">
                    <table>
                        <tr>
                            <td align="right">First Name</td>
                            <td align="left"><input type="text" name="firstname" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Surname</td>
                            <td align="left"><input type="text" name="surname" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Role</td>
                            <td align="left">
                                <select name="role">
                                    <option value="doctor">Doctor</option>
                                    <option value="nurse">Nurse</option>
                                    <option value="receptionist">Receptionist</option>
                                    <option value="technician">Medical Technician</option>
                                    <option value="administrator">System Administrator</option>
                                </select>
                            </td>
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
            
            <?php include('../includes/page_actions.php'); ?>
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
