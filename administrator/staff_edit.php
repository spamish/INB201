<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if ($_GET['staffID'] == $_SESSION['login'])
    {
        header ("Location: staff_view.php");
    }
    
    $staff = new Staff($_GET);
    $results = viewTable("staff", $staff);
    $staff = new Staff($results[1]);
    
    $address = new Address();
    $address->addressID = $staff->address;
    $results = viewTable("addresses", $address);
    $address = new Address($results[1]);
    
    $roster = new Roster();
    $roster->rosterID = $staff->roster;
    $results = viewTable("rosters", $roster);
    $roster = new Roster($results[1]);
    
    $salary = new Salary();
    $salary->salaryID = $staff->salary;
    $results = viewTable("salaries", $salary);
    $salary = new Salary($results[1]);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/info.css') ?>
            <?php include('../styles/cal.css') ?>
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="../includes/lib/calendar.js"></script>
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <script type="text/javascript">
            function init()
            {
                calendar.set('date');
                calendar.set('pay');
                setWard();
            }
        </script>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body onload="init()">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>

            <div id="content"> <!-- All content goes here -->
                <h2>Edit Staff</h2>
                <form action="staff_edit_confirm.php" method="post">
                    <fieldset style="height:220px;">
                        <legend><h3>Staff Details</h3></legend>
                        <table>
                            <tr>
                                <th>Password</th>
                                <td>
                                    <input id="btnSubmit" type="submit" name="reset" value="Reset">
                                    <input type="hidden" name="staffID" value="<?php echo $staff->staffID ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?php echo $staff->username ?></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td>
                                    <input type="text" name="firstName" required
                                        value="<?php echo $staff->firstName ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td>
                                    <input type="text" name="surname" required
                                        value="<?php echo $staff->surname ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    <!-- Add gender -->
                                    <?php
                                        if ($staff->gender == "m")
                                        { ?>
                                        <input type="radio" name="gender"
                                            value="m" required checked>Male
                                        <input type="radio" name="gender" value="f">Female
                                        <?php }
                                        else
                                        { ?>
                                        <input type="radio" name="gender" value="m">Male
                                        <input type="radio" name="gender"
                                            value="f" required checked>Female
                                        <?php }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>
                                    <input id="date" type="date" name="dateOfBirth" required
                                        value="<?php echo $staff->dateOfBirth->format('Y-m-d') ?>"/>
                                    <img src="/inb201/calendar.gif" alt="Calendar Icon">
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
                                    <input type="text" name="unit" style="width: 20px;"
                                        value="<?php echo isset($address->unit) ? $address->unit : "" ?>"> / 
                                    <input type="text" name="house" style="width: 20px;"
                                        required value="<?php echo $address->house ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td>
                                    <input type="text" name="street" required
                                        value="<?php echo $address->street ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Suburb</th>
                                <td>
                                    <input type="text" name="suburb" required
                                        value="<?php echo $address->suburb ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td>
                                    <input type="text" name="postcode" required
                                        value="<?php echo $address->postcode ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>
                                    <input type="text" name="region" required
                                        value="<?php echo $address->region ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>
                                    <input type="text" name="country" required
                                        value="<?php echo $address->country ?>">
                                </td>
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
                                        <?php
                                            if ($staff->position == 'inactive') { ?>
                                            <option value="inactive" selected>Inactive</option>
                                            <?php }
                                            else
                                            { ?>
                                            <option value="inactive">Inactive</option>
                                            <?php }
                                            if ($staff->position == 'doctor')
                                            { ?>
                                            <option value="doctor" selected>Doctor</option>
                                            <?php }
                                            else
                                            { ?>
                                            <option value="doctor">Doctor</option>
                                            <?php }
                                            if ($staff->position == 'surgeon')
                                            { ?>
                                            <option value="surgeon" selected>Surgeon</option>
                                            <?php }
                                            else
                                            { ?>
                                            <option value="surgeon">Surgeon</option>
                                            <?php }
                                            if ($staff->position == 'nurse')
                                            { ?>
                                            <option value="nurse" selected>Nurse</option>
                                            <?php }
                                            else
                                            { ?>
                                            <option value="nurse">Nurse</option>
                                            <?php }
                                            if ($staff->position == 'receptionist')
                                            { ?>
                                            <option value="receptionist" selected>Receptionist</option>
                                            <?php }
                                            else
                                            { ?>
                                            <option value="receptionist">Receptionist</option>
                                            <?php }
                                            if ($staff->position == 'technician')
                                            { ?>
                                            <option value="technician" selected>Medical Technician</option>
                                            <?php }
                                            else
                                            { ?>
                                            <option value="technician">Medical Technician</option>
                                            <?php }
                                            if ($staff->position == 'administrator')
                                            { ?>
                                            <option value="administrator" selected>System Administrator</option>
                                            <?php }
                                            else
                                            { ?>
                                            <option value="administrator">System Administrator</option>
                                            <?php }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Ward</th>
                                <td>
                                    <select id="ward" name="ward">
                                        <?php if ($staff->ward == 'A') { ?>
                                            <option value="A" selected>A</option>
                                        <?php } else { ?>
                                            <option value="A">A</option>
                                        <?php }
                                        if ($staff->ward == 'B') { ?>
                                            <option value="B" selected>B</option>
                                        <?php } else { ?>
                                            <option value="B">B</option>
                                        <?php }
                                        if ($staff->ward == 'C') { ?>
                                            <option value="C" selected>C</option>
                                        <?php } else { ?>
                                            <option value="C">C</option>
                                        <?php }
                                        if ($staff->ward == 'D') { ?>
                                            <option value="D" selected>D</option>
                                        <?php } else { ?>
                                            <option value="D">D</option>
                                        <?php }
                                        if ($staff->ward == 'E') { ?>
                                            <option value="E" selected>E</option>
                                        <?php } else { ?>
                                            <option value="E">E</option>
                                        <?php }
                                        if ($staff->ward == 'F') { ?>
                                            <option value="F" selected>E</option>
                                        <?php } else { ?>
                                            <option value="F">F</option>
                                        <?php }
                                        if ($staff->ward == 'G') { ?>
                                            <option value="G" selected>G</option>
                                        <?php } else { ?>
                                            <option value="G">G</option>
                                        <?php } ?>
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
                                <td>
                                    <input type="text" name="mobilePhone"
                                        value="<?php echo isset($staff->mobilePhone) ? $staff->mobilePhone : "" ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Home Phone</th>
                                <td>
                                    <input type="text" name="homePhone"
                                        value="<?php echo isset($staff->homePhone) ? $staff->homePhone : "" ?>"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Roster</h3></legend>
                        <table>
                            <tr>
                                <th>Start Time</th>
                                <td>
                                    <input type="text" name="start" required
                                        value="<?php echo $roster->start ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Finish Time</th>
                                <td>
                                    <input type="text" name="finish" required
                                        value="<?php echo $roster->finish ?>">
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Salary</h3></legend>
                        <table>
                            <tr>
                                <th>Pay Rate</th>
                                <td>
                                    <input type="text" name="payRate" required
                                        value="<?php echo $salary->payRate ?>">/hour
                                </td>
                            </tr>
                            <tr>
                                <th>Next Pay Date</th>
                                <td>
                                    <input id="pay" type="text" name="nextDate" required
                                        value="<?php echo $salary->nextDate->format('Y-m-d') ?>">
                                    <img src="/inb201/calendar.gif" alt="Calendar Icon">
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <h2><input id="btnSubmit" type="submit" name="update" value="Save"/></h2>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>