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
        <script type="text/javascript">
            function init()
            {
                calendar.set('date');
                calendar.set('pay');
            }
        </script>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body onload="init()">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            <div id="content"> <!-- All content goes here -->
                <h2>Add Staff</h2>
                <div id="input">
                    <form action="staff_add_confirm.php" method="post" style="float:left;width=50%;">
                        <table>
                            <tr><th>Staff Details</th></tr>
                            <tr>
                                <!--
                                    Disables username input if yes is selected, will
                                    trigger server to generate the next lowest unique
                                    number available in the staff table.
                                -->
                                <td align="right">Generate Username</td>
                                <td>
                                    <input id="checkbox" type="checkbox" name="generate" onchange="setUsername()">
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Username</td>
                                <td><input id="username" type="text" name="username" required/></td>
                            </tr>
                            <tr>
                                <td align="right">First Name</td>
                                <td><input type="text" name="firstName" required/></td>
                            </tr>
                            <tr>
                                <td align="right">Surname</td>
                                <td><input type="text" name="surname" required/></td>
                            </tr>
                            <tr>
                                <td align="right">Gender</td>
                                <td>
                                    <input type="radio" name="gender" value="m" required>Male
                                    <input type="radio" name="gender" value="f">Female
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Date of Birth</td>
                                <td>
                                    <img id="imgDate" src="/inb201/calendar.gif" alt="Calendar Icon">
                                    <input id="date" type="text" name="dateOfBirth" required/>
                                </td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <th>Role</th>
                                <td></td>
                                <td align="right">Ward</td>
                            </tr>
                            <tr>
                                <td align="right">Position</td>
                                <td>
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
                            <tr><td><br></td></tr>
                            <tr><th>Contact Details</th></tr>
                            <tr>
                                <td align="right">Mobile Phone</td>
                                <td><input type="text" name="mobilePhone"/></td>
                            </tr>
                            <tr>
                                <td align="right">Home Phone</td>
                                <td><input type="text" name="homePhone"/></td>
                            </tr>
                            <tr><th>Address</th></tr>
                            <tr>
                                <td align="right">Unit / Number</td>
                                <td>
                                    <input type="text" name="unit" style="width: 20px;"> / 
                                    <input type="text" name="house" style="width: 20px;" required>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Street</td>
                                <td><input type="text" name="street" required></td>
                            </tr>
                            <tr>
                                <td align="right">Suburb</td>
                                <td><input type="text" name="suburb" required></td>
                            </tr>
                            <tr>
                                <td align="right">Postcode</td>
                                <td><input type="text" name="postcode" required></td>
                            </tr>
                            <tr>
                                <td align="right">State</td>
                                <td><input type="text" name="region" value="Queensland" required></td>
                            </tr>
                            <tr>
                                <td align="right">Country</td>
                                <td><input type="text" name="country" value="Australia" required></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr><th>Roster</th></tr>
                            <tr>
                                <td align="right">Start Time</td>
                                <td><input type="text" name="start" required></td>
                            </tr>
                            <tr>
                                <td align="right">Finish Time</td>
                                <td><input type="text" name="finish" required></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr><th>Salary</th></tr>
                            <tr>
                                <td align="right">Pay Rate</td>
                                <td><input type="text" name="payRate" required>/hour</td>
                            </tr>
                            <tr>
                                <td align="right">Next Pay Date</td>
                                <td>
                                    <img id="imgPay" src="/inb201/calendar.gif" alt="Calendar Icon">
                                    <input id="pay" type="text" name="nextDate" required>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
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
