<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <script type="text/javascript" src="../includes/lib/calendar.js"></script>
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <script type="text/javascript">
            function init()
            {
                calendar.set('date');
            }
        </script>
        <title>T.O.U.C.H. Online System</title>
    </head>
    
    <body onload="init()">
        <div id="wrapper">
            
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <h2>Admit Patient</h2>
                <p>If date of birth is unknown, submit as unidentified but fill in name details.</p>
                <form id="admission" action="admission_extended.php" method="post">
                    <table>
                        <tr>
                            <!-- Deselect checkbox if unable to identify patient -->
                            <td>
                                ID available
                                <input id="identified" type="checkbox"
                                    name="identified" onchange="setID()" checked>
                            </td>
                            <!-- Sets patient with psedu ID or first name
                            and surname fields depending on checkbox selection -->
                            <td align="right">First Name</td>
                            <td><input id="firstName" type="text" name="firstName" required autofocus ></td>
                            <td align="right">Surname</td>
                            <td><input id="surname" type="text" name="surname" required></td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                            <td align="right">Date of Birth</td>
                            <td><input id="date" type="text" name="dateOfBirth" required></td>
                        </tr>
                        <tr>
                            <td align="right">Gender</td>
                            <td><input type="radio" name="gender" value="m" required>Male</td>
                            <td><input type="radio" name="gender" value="f">Female</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td align="right">Condition</td>
                            <td><select id="state" name="state">
                                    <option value="0.5">Stable</option>
                                    <option value="0.7">Urgent</option>
                                    <option value="0.9">Critical</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">Admission Notes</td>
                            <td><textarea rows="6" cols="60" name="details"></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input id="btnSubmit" type="submit" name="submit" value="Submit"></td>
                            <!-- If patient ID is provided, then continue on to the extended patient details
                            form to add extra data like address, phone and insurance details. If patient is
                            unidentified or en route then display list of unidentified patients with newly added one
                            highlighted -->
                        </tr>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>