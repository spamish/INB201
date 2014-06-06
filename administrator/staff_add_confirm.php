<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/password_functions.php');
    require('../includes/functions.php');
    
    $staff = new Staff($_POST);
    
    //Check if username already exists or generates a new one.
    if(isset($_POST['generate']))
    {
        $staff->username = uniqueUsername();
        $check = true;
    }
    else
    {
        $check = new Staff();
        $check->username = $staff->username;
        
        $results = viewTable("staff", $check);
        $check = ($results[0] ? false : true);
    }
    
    //Creates staff member.
    if ($check)
    {
        $address = assignAddress(new Address($_POST));
        $roster = assignRoster(new Roster($_POST));
        $salary = assignSalary(new Salary($_POST));
        $staff->address = $address->addressID;
        $staff->roster = $roster->rosterID;
        $staff->salary = $salary->salaryID;
        
        //Assigns wards to positions where ward is dedicated.
        switch ($staff->position)
        {
            case "receptionist":
                $staff->ward = "A";
                break;
            case "technician":
                $staff->ward = "E";
                break;
            case "administrator":
                $staff->ward = "F";
                break;
            case "surgeon":
                $staff->ward = "G";
                break;
            default:
                break;
        }
        
        //Generate a temporary password.
        $password = substr(md5(rand()), 0, 10);
        $staff->hash = password_hash($password, PASSWORD_DEFAULT);
        
        //Create staff member.
        $staff = createStaff($staff);
    }
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
                <h2>Summary</h2>
                <?php if ($check)
                { ?>
                    <div id="message">
                        <p>Account creation successful.<br>
                        Temporary password is "<?php echo $password ?>"</p>
                    </div>
                    
                    <fieldset style="height:220px;">
                        <legend><h3>Staff Details</h3></legend>
                        <table>
                            <tr>
                                <th>Username</th>
                                <td><?php echo $staff->username ?></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td><?php echo $staff->firstName ?></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td><?php echo $staff->surname ?></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td><?php echo gender($staff->gender) ?></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td><?php echo $staff->dateOfBirth->format('j M Y') ?></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:220px;">
                        <legend><h3>Address Details</h3></legend>
                        <table>
                            <tr>
                                <?php echo ($address->unit ? "<th>Unit/Number</th>" : "<th>Number</th>") ?>
                                <?php echo ($address->unit
                                    ? "<td>" . $address->unit .
                                         "/" . $address->house . "</td>"
                                    : "<td>" . $address->house . "</td>") ?>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td><?php echo $address->street ?></td>
                            </tr>
                            <tr>
                                <th>Suburb</th>
                                <td><?php echo $address->suburb ?></td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td><?php echo $address->postcode ?></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><?php echo $address->region ?></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><?php echo $address->country ?></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Position</h3></legend>
                        <table>
                            <tr>
                                <th>Role</th>
                                <td><?php echo position($staff->position) ?></td>
                            </tr>
                            <tr>
                                <th>Ward</th>
                                <td><?php echo $staff->ward ?></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Contact Details</h3></legend>
                        <table>
                            <?php if ($staff->mobilePhone)
                            { ?>
                            <tr>
                                <th>Mobile Phone</th>
                                <td><?php echo $staff->mobilePhone ?></td>
                            </tr>
                            <?php }
                            if ($staff->homePhone)
                            { ?>
                            <tr>
                                <th>Home Phone</th>
                                <td><?php echo $staff->homePhone ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Roster</h3></legend>
                        <table>
                            <tr>
                                <th>Start Time</th>
                                <td><?php echo $roster->start ?></td>
                            </tr>
                            <tr>
                                <th>Finish Time</th>
                                <td><?php echo $roster->finish ?></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:120px;">
                        <legend><h3>Salary</h3></legend>
                        <table>
                            <tr>
                                <th>Pay Rate (p/h)</th>
                                <td>$<?php echo $salary->payRate ?></td>
                            </tr>
                            <tr>
                                <th>Next Pay Date</th>
                                <td><?php echo $salary->nextDate->format('j M Y') ?></td>
                            </tr>
                        </table>
                    </fieldset>
                <?php }
                else
                { ?>
                    <div id="message">
                        <p>The username is already in use.</p>
                        <a id="btnSubmit" href="staff_add.php">Try Again</a>
                    </div>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
