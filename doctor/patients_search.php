<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
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

                <h2>Search for Patients</h2>
                <form action="patients_view.php" method="get">
                    <table>
                        <tr>
                            <td align="right">Patient ID</td>
                            <td><input type="text" name="patient" autofocus ></td>
                        </tr>
                        <tr>
                            <td align="right">Case ID</td>
                            <td><input type="text" name="file"></td>
                        </tr>
                        <tr>
                            <td align="right">First Name or Forename</td>
                            <td><input type="text" name="firstName"></td>
                        </tr>
                        <tr>
                            <td align="right">Surname or Postname</td>
                            <td><input type="text" name="surname"></td>
                        </tr>
                        <tr>
                            <td align="right">Room Number</td>
                            <td><input type="text" name="roomNumber"></td>
                        </tr>
                        <tr>
                            <td align="right">Ward</td>
                            <td><input type="text" name="ward"></td>
                        </tr>
                        <tr>
                            <td align="right">Primary Doctor</td>
                            <td><input type="text" name="staff"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input id="btnSubmit" type="submit"
                                    name="submit" value="Submit">
                            <td>
                        </tr>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
