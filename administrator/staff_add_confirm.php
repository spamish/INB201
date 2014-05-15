<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/password_functions.php');
    require('../includes/functions.php');
    
    if(isset($_POST['generate']))
    {
        $username = 0;
        while(!getStaffInfo($username))
        {
            $username++;
        }
    }
    else
    {
        $username = $_POST['username'];
        $check = !getStaffInfo($username);
    }
    
    if ($check)
    {
        $firstName = $_POST['firstName'];
        $surname = $_POST['surname'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $phoneNumber = $_POST['phoneNumber'];
        
        $salary = $_POST['salary'];
        $position = $_POST['position'];
        $ward = $_POST['ward'];
        $password = substr(md5(rand()), 0, 10);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        createStaff($username, $firstName, $surname, $dateOfBirth, $phoneNumber, $salary, $position, $ward, $hash);
        
        $staff = getStaffInfo($username);
        $id = $staff['staffID'];
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
                            <th>Date of Birth</th>
                            <th>Phone Number</th>
                            <th>Salary</th>
                            <th>Position</th>
                            <th>Ward</th>
                        </tr>
                        
                        <tr id="tableRowA">
                            <td><?php echo $staff['username'] ?></td>
                            <td><?php echo $staff['firstName'] ?></td>
                            <td><?php echo $staff['surname'] ?></td>
                            <td><?php echo $staff['dateOfBirth'] ?></td>
                            <td><?php echo $staff['phoneNumber'] ?></td>
                            <td><?php echo $staff['salary'] ?></td>
                            <td><?php echo position($staff['position']) ?></td>
                            <td><?php echo $staff['ward'] ?></td>
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
