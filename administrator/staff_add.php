<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <script type="text/javascript" src="../includes/lib/calendar.js"></script>
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body onload="calendar.set('date')">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            <div id="content"> <!-- All content goes here -->
                <h2>Add Staff</h2>
                <div id="input">
                    <form action="staff_add_confirm.php" method="post" style="float:left;width=50%;">
                        <table>
                            <tr>
                                <!--
                                    Disables username input if yes is selected, will
                                    trigger server to generate the next lowest unique
                                    number available in the staff table.
                                -->
                                <td align="right">Generate Username</td>
                                <td align="left">
                                    <input id="checkbox" type="checkbox" name="generate" onchange="setUsername()">
                                </td>
                            </tr>
                            
                            <tr>
                                <td align="right">Username</td>
                                <td align="left"><input id="username" type="text" name="username" required/></td>
                            </tr>
                            
                            <tr>
                                <td align="right">First Name</td>
                                <td align="left"><input type="text" name="firstName" required/></td>
                            </tr>
                            
                            <tr>
                                <td align="right">Surname</td>
                                <td align="left"><input type="text" name="surname" required/></td>
                            </tr>
                            
                            <tr>
                                <td align="right">Date of Birth</td>
                                <td align="left"><input id="date" type="text" name="dateOfBirth" required/></td>
                            </tr>
                            
                            <tr>
                                <td align="right">Phone Number</td>
                                <td align="left"><input type="text" name="phoneNumber"/></td>
                            </tr>
                            
                            <td>Home Phone</td>
                            <td>Address</td>
                            <td>Roster</td>
                            <td>Salary</td>
                            
                            <tr>
                                <td align="right">Salary</td>
                                <td align="left">
                                    <select name="salary">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>
                                </td>
                                <td align="right">Ward</td>
                            </tr>
                            
                            <tr>
                                <td align="right">Position</td>
                                <td align="left">
                                    <select id="position" name="position" onchange="setWard()">
                                        <option value="inactive">Inactive</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="surgeon">Surgeon</option>
                                        <option value="nurse">Nurse</option>
                                        <option value="receptionist">Receptionist</option>
                                        <option value="technician">Medical Technician</option>
                                        <option value="administrator">System Administrator</option>
                                    </select>
                                </td>
                                <td align="right">
                                    <select id="ward" name="ward">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td align="left">
                                    <input id="btnSubmit" type="submit" name="save" value="Save">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                
                <div id="rules">
                    <h3>Instructions</h3>
                    <p>User ID is the 8 digit numeric component of staff ID (the alphabetic
                    prefix will be added automatically).<br>The phone number should be a local
                    home or mobile number (starting with '04' or '07').<br>Ward E and F are
                    for categorising Medical Technicians and System Administrators, this will
                    be automatically corrected.</p>
                </div>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
