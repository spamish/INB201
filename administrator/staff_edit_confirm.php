<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/password_functions.php');
    require('../includes/functions.php');
    
    $staff = new Staff($_POST);
    
    if (isset($_POST['reset']))
    {
        $password = substr(md5(rand()), 0, 10);
        
        changePassword($staff->staffID, $password);
    }
    elseif (isset($_POST['update']))
    {
        //Check if address, roster or salary have been changed.
        $address = assignAddress(new Address($_POST));
        $roster = assignRoster(new Roster($_POST));
        $salary = assignSalary(new Salary($_POST));
        $staff->address = $address->addressID;
        $staff->roster = $roster->rosterID;
        $staff->salary = $salary->salaryID;
        
        $staff = editStaff($staff);
    }
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
                <h2>Summary</h2>
                <?php if (isset($_POST['reset']))
                { ?>
                    <p>Password reset, temporary password is "<?php echo $password ?>"</p>
                <?php }
                else if (isset($_POST['update']))
                { ?>
                    <p>Account edit successful.</p>
                    <table>
                        <tr id="tableRowHeader">
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Date of Birth</th>
                            <th>Mobile Phone</th>
                            <th>Salary</th>
                            <th>Position</th>
                            <th>Ward</th>
                        </tr>
                        <tr id="tableRowA">
                            <td><?php echo $staff->username ?></td>
                            <td><?php echo $staff->firstName ?></td>
                            <td><?php echo $staff->surname ?></td>
                            <td><?php echo $staff->dateOfBirth ?></td>
                            <td><?php echo $staff->mobilePhone ?></td>
                            <td><?php echo $staff->salary ?></td>
                            <td><?php echo position($staff->position) ?></td>
                            <td><?php echo $staff->ward ?></td>
                        </tr>
                    </table>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
