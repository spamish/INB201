<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if ($_POST['id'] == $_SESSION['login'])
    {
        header ("Location: staff_view.php");
    }
    
    $staff = viewTable("staff");
    $staff = new Staff($staff[$_POST['id']]);
    
    $address = viewTable("addresses");
    $address = new Address($address[$staff->address]);
    
    $roster = viewTable("rosters");
    $roster = new Roster($roster[$staff->roster]);
    
    $salary = viewTable("salaries");
    $salary = new Salary($salary[$staff->salary]);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
                <h2>Edit Staff</h2>
                <form action="staff_edit_confirm.php" method="post" style="float:left;width=50%;">
                    <table>
                        <tr>
                            <td align="right">Password</td>
                            <td align="left">
                                <input id="btnSubmit" type="submit" name="reset" value="Reset">
                                <input type="hidden" name="staffID" value="<?php echo $staff->staffID ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Username</td>
                            <td><?php echo $staff->username ?></td>
                        </tr>
                        <tr>
                            <td align="right">First Name</td>
                            <td>
                                <input type="text" name="firstName" required
                                    value="<?php echo $staff->firstName ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Surname</td>
                            <td>
                                <input type="text" name="surname" required
                                    value="<?php echo $staff->surname ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Gender</td>
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
                            <td align="right">Date of Birth</td>
                            <td>
                                <img src="/inb201/calendar.gif" alt="Calendar Icon">
                                <input id="date" type="date" name="dateOfBirth" required
                                    value="<?php echo $staff->dateOfBirth->format('Y-m-d') ?>"/>
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
                            <td align="right">
                                <select name="ward">
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
                                        <option value="G" selected>F</option>
                                    <?php } else { ?>
                                        <option value="G">G</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td><br></td></tr>
                        <tr><th>Contact Details</th></tr>
                        <tr>
                            <td align="right">Mobile Phone</td>
                            <td>
                                <input type="text" name="mobilePhone"
                                    value="<?php echo isset($staff->mobilePhone) ? $staff->mobilePhone : "" ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Home Phone</td>
                            <td>
                                <input type="text" name="homePhone"
                                    value="<?php echo isset($staff->homePhone) ? $staff->homePhone : "" ?>"/>
                            </td>
                        </tr>
                        <tr><th>Address</th></tr>
                        <tr>
                            <td align="right">Unit / Number</td>
                            <td>
                                <input type="text" name="unit" style="width: 20px;"
                                    value="<?php echo isset($address->unit) ? $address->unit : "" ?>"> / 
                                <input type="text" name="house" style="width: 20px;"
                                    required value="<?php echo $address->house ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Street</td>
                            <td>
                                <input type="text" name="street" required
                                    value="<?php echo $address->street ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Suburb</td>
                            <td>
                                <input type="text" name="suburb" required
                                    value="<?php echo $address->suburb ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Postcode</td>
                            <td>
                                <input type="text" name="postcode" required
                                    value="<?php echo $address->postcode ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">State</td>
                            <td>
                                <input type="text" name="region" required
                                    value="<?php echo $address->region ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Country</td>
                            <td>
                                <input type="text" name="country" required
                                    value="<?php echo $address->country ?>">
                            </td>
                        </tr>
                        <tr><td><br></td></tr>
                        <tr><th>Roster</th></tr>
                        <tr>
                            <td align="right">Start Time</td>
                            <td>
                                <input type="text" name="start" required
                                    value="<?php echo $roster->start ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Finish Time</td>
                            <td>
                                <input type="text" name="finish" required
                                    value="<?php echo $roster->finish ?>">
                            </td>
                        </tr>
                        <tr><td><br></td></tr>
                        <tr><th>Salary</th></tr>
                        <tr>
                            <td align="right">Pay Rate</td>
                            <td>
                                <input type="text" name="payRate" required
                                    value="<?php echo $salary->payRate ?>">/hour
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Next Pay Date</td>
                            <td>
                                <img src="/inb201/calendar.gif" alt="Calendar Icon">
                                <input id="pay" type="text" name="nextDate" required
                                    value="<?php echo $salary->nextDate->format('Y-m-d') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="left">
                                <input id="btnSubmit" type="submit" name="update" value="Save"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>