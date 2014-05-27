<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    if (!isset($_GET['id']))
    {
        header ("Location: staff_view.php");
    }
    
    $staff = viewTable("staff");
    $staff = new Staff($staff[$_GET['id']]);
    
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
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->

                <h2>Staff Details</h2>
                <form action="staff_edit.php" method="post">
                    <input id="btnSubmit" type="submit"
                        name="update" value="Update"><br>
                    <input type="hidden" name="id"
                        value="<?php echo $staff->staffID ?>">
                    <table>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $staff->username ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $staff->firstName ?></td>
                        </tr>
                        <tr>
                            <td>Surname</td>
                            <td><?php echo $staff->surname ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?php echo gender($staff->gender) ?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><?php echo $staff->dateOfBirth->format('j M Y') ?></td>
                        </tr>
                        <tr>
                            <td>Position</td>
                            <td><?php echo position($staff->position) ?></td>
                        </tr>
                        <tr>
                            <td>Ward</td>
                            <td><?php echo $staff->ward ?></td>
                        </tr>
                        <?php if ($staff->mobilePhone)
                        { ?>
                        <tr>
                            <td>Mobile Phone</td>
                            <td><?php echo $staff->mobilePhone ?></td>
                        </tr>
                        <?php }
                        if ($staff->homePhone)
                        { ?>
                        <tr>
                            <td>Home Phone</td>
                            <td><?php echo $staff->homePhone ?></td>
                        </tr>
                        <?php } ?>
                        <tr><th>Address Details</th></tr>
                        <tr>
                            <?php if ($address->unit)
                            { ?>
                            <td>Unit</td>
                            <?php } ?>
                            <td>Number</td>
                            <td>Street</td>
                        </tr>
                        <tr>
                            <?php if ($address->unit)
                            { ?>
                            <td><?php echo $address->unit ?></td>
                            <?php } ?>
                            <td><?php echo $address->house ?></td>
                            <td><?php echo $address->street ?></td>
                        </tr>
                        <tr>
                            <td>Suburb</td>
                            <td><?php echo $address->suburb ?></td>
                        </tr>
                        <tr>
                            <td>Postcode</td>
                            <td>State</td>
                        </tr>
                        <tr>
                            <td><?php echo $address->postcode ?></td>
                            <td><?php echo $address->region ?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><?php echo $address->country ?></td>
                        </tr>
                        <tr><th>Roster</th></tr>
                        <tr>
                            <td>Start Time</td>
                            <td><?php echo $roster->start ?></td>
                        </tr>
                        <tr>
                            <td>Finish Time</td>
                            <td><?php echo $roster->finish ?></td>
                        </tr>
                        <tr><th>Salary</th></tr>
                        <tr>
                            <td>Pay Rate (p/h)</td>
                            <td><?php echo "$" . $salary->payRate ?></td>
                        </tr>
                        <tr>
                            <td>Next Pay Date</td>
                            <td><?php echo $salary->nextDate->format('j M Y') ?></td>
                        </tr>
                    </table>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
