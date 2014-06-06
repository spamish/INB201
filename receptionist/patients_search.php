<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
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

                <h2>Search for Patients</h2>
                <form action="patients_view.php" method="get">
                    
                    <fieldset style="height:184px">
                        <legend><h3>Patient Details</h3></legend>
                        <table>
                            <tr>
                                <th>Patient ID</th>
                                <td><input type="text" name="patientID" autofocus ></td>
                            </tr>
                            <tr>
                                <th>Case ID</th>
                                <td><input type="text" name="fileID"></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td><input type="text" name="firstName"></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td><input type="text" name="surname"></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    <input type="radio" name="gender" value="m">Male
                                    <input type="radio" name="gender" value="f">Female
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:184px">
                        <legend><h3>Doctor's Details</h3></legend>
                        <table>
                            <tr>
                                <th>Username</th>
                                <td><input type="text" name="username"></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td><input type="text" name="docFirstName"></td>
                            </tr>
                            <tr>
                                <th align="right">Surname</th>
                                <td><input type="text" name="docSurname"></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="width:93%">
                        <legend><h3>Room Details</h3></legend>
                        <table>
                            <tr>
                                <th>Room Number and/or Ward</th>
                                <td>
                                    <input type="text" name="roomNumber">
                                    <select id="ward" name="ward">
                                        <option value="-">-</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <h2><input id="btnSubmit" type="submit" name="submit" value="Submit"></h2>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
