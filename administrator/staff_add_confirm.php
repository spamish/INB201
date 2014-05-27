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
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
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
                    <p>Account creation successful.<br>
                    Temporary password is "<?php echo $password ?>"</p>
                    <table>
                        <tr id="tableRowHeader">
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Position</th>
                            <th>Ward</th>
                        </tr>
                        
                        <tr id="tableRowA">
                            <td><?php echo $staff->username ?></td>
                            <td><?php echo $staff->firstName ?></td>
                            <td><?php echo $staff->surname ?></td>
                            <td><?php echo gender($staff->gender) ?></td>
                            <td><?php echo $staff->dateOfBirth->format('j M Y') ?></td>
                            <td><?php echo position($staff->position) ?></td>
                            <td><?php echo $staff->ward ?></td>
                        </tr>
                    </table>
                <?php }
                else
                { ?>
                    <p>The username is already in use.</p>
                    <a id="btnSubmit" href="staff_add.php">Try Again</a>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
