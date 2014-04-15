<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    session_start();
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
                <h2>Add Staff</h2>
                <form action="staff_add_confirm.php" method="post" style="float:left;width=50%;">
                    <table>
                        <tr>
                            <td align="right">Username</td>
                            <td align="left"><input type="text" name="username" required/></td>
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
                            <td align="left"><input type="date" name="dateOfBirth" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Phone Number</td>
                            <td align="left"><input type="text" name="phoneNumber"/></td>
                        </tr>
                        <tr>
                            <td align="right">Pay Grade</td>
                            <td align="left">
                                <select name="payGrade">
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
                                <select name="position">
                                    <option value="inactive">Inactive</option>
                                    <option value="doctor">Doctor</option>
                                    <option value="nurse">Nurse</option>
                                    <option value="receptionist">Receptionist</option>
                                    <option value="technician">Medical Technician</option>
                                    <option value="administrator">System Administrator</option>
                                </select>
                            </td>
                            <td align="right">
                                <select name="ward">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
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
                <div id="rules" style="float:right;width:50%;">
                    <h3>Instructions</h3>
                    <p>User ID is the 8 digit numeric component of staff ID (the alphabetic prefix will be added automatically).<br>The phone number should be a local home or mobile number (starting with '04' or '07').<br>Ward E and F are for categorising Medical Technicians and System Administrators, this will be automatically corrected.</p>
                </div>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
