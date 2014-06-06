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
            <?php include('../styles/cal.css') ?>
        </style>
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
                <form action="staff_add_confirm.php" method="post">
                    <fieldset style="height:220px;">
                        <legend><h3>Staff Details</h3></legend>
                        <table>
                            <tr>
                                <th>Generate Username</th>
                                <td>
                                    <input id="checkbox" type="checkbox" name="generate" onchange="setUsername()"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><input id="username" type="text" name="username" required/></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td><input type="text" name="firstName" required/></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td><input type="text" name="surname" required/></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    <input type="radio" name="gender" value="m" required/>Male
                                    <input type="radio" name="gender" value="f"/>Female
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>
                                    <input id="date" type="text" name="dateOfBirth" required/>
                                    <img src="/inb201/calendar.gif" name="Calendar Icon"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:220px;">
                        <legend><h3>Address</h3></legend>
                        <table>
                            <tr>
                                <th>Unit / Number</th>
                                <td>
                                    <input type="text" name="unit" style="width: 20px;"/> / 
                                    <input type="text" name="house" style="width: 20px;" required/>
                                </td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td><input type="text" name="street" required/></td>
                            </tr>
                            <tr>
                                <th>Suburb</th>
                                <td><input type="text" name="suburb" required/></td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td><input type="text" name="postcode" required/></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><input type="text" name="region" value="Queensland" required/></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><input type="text" name="country" value="Australia" required/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Position</h3></legend>
                        <table>
                            <tr>
                                <th>Role</th>
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
                            </tr>
                            <tr>
                                <th>Ward</th>
                                <td>
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
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Contact Details</h3></legend>
                        <table>
                            <tr>
                                <th>Mobile Phone</th>
                                <td><input type="text" name="mobilePhone"/></td>
                            </tr>
                            <tr>
                                <th>Home Phone</th>
                                <td><input type="text" name="homePhone"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Roster</h3></legend>
                        <table>
                            <tr>
                                <th>Start Time</th>
                                <td><input type="text" name="start" required/></td>
                            </tr>
                            <tr>
                                <th>Finish Time</th>
                                <td><input type="text" name="finish" required/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Salary</h3></legend>
                        <table>
                            <tr>
                                <th>Pay Rate</th>
                                <td><input type="text" name="payRate" required/>/hour</td>
                            </tr>
                            <tr>
                                <th>Next Pay Date</th>
                                <td>
                                    <input id="pay" type="text" name="nextDate" required/>
                                    <img src="/inb201/calendar.gif" name="Calendar Icon"/>
                                </td>
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
