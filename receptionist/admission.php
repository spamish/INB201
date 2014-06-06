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
            <?php include('../styles/cal.css') ?>
        </style>
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
                <form id="admission" action="admission_extended.php" method="post">
                    <h2>Admit Patient</h2>
                    <p>If date of birth is unknown, submit as unidentified but fill in name details.</p>
                    <fieldset style="width:90%;">
                        <legend><h3>Patient Details</h3></legend>
                        <!-- Deselect checkbox if unable to identify patient -->
                        <table>
                            <tr>
                                <th>ID available</th>
                                <td><input id="identified" type="checkbox" checked
                                    name="identified" onchange="setID()"/></td>
                            </tr>
                            <tr>
                                <!-- Sets patient with psedu ID or first name
                                and surname fields depending on checkbox selection -->
                                <th>First Name</th>
                                <td><input id="firstName" type="text" name="firstName" required autofocus/></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td><input id="surname" type="text" name="surname" required/></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>
                                    <input id="date" type="text" name="dateOfBirth" required/>
                                    <img src="/inb201/calendar.gif" name="Calendar Icon"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    <input type="radio" name="gender" value="m" required/>Male
                                    <input type="radio" name="gender" value="f"/>Female
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="width:90%;">
                        <legend><h3>Admission Details</h3></legend>
                        <table>
                            <tr>
                                <th>Condition</th>
                                <td><select name="state">
                                    <option value="0.5">Stable</option>
                                    <option value="0.7">Urgent</option>
                                    <option value="0.9">Critical</option>
                                </select></td>
                            </tr>
                        </table>
                        <b>Notes</b><br>
                        <textarea rows="6" cols="60" name="details"></textarea>
                    </fieldset>
                    <h2 style="width:90%;"><input id="btnSubmit" type="submit" name="submit" value="Submit"/></h2>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>