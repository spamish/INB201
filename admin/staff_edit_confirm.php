<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/password_functions.php');
    require('../includes/functions.php');
    
    $id = $_POST['id'];
    if (isset($_POST['reset']))
    {
        $password = substr(md5(rand()), 0, 10);
        
        changePassword($id, $password);
    }
    elseif (isset($_POST['update']))
    {
        $firstName = $_POST['firstName'];
        $surname = $_POST['surname'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $phoneNumber = $_POST['phoneNumber'];
        $salary = $_POST['salary'];
        $position = $_POST['position'];
        $ward = $_POST['ward'];
        
        editStaff($id, $firstName, $surname, $dateOfBirth, $phoneNumber, $salary, $position, $ward);
        
        $staff = viewTable("staff");
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
                            <th id="tableHeader">Username</th>
                            <th id="tableHeader">First Name</th>
                            <th id="tableHeader">Surname</th>
                            <th id="tableHeader">Date of Birth</th>
                            <th id="tableHeader">Phone Number</th>
                            <th id="tableHeader">Salary</th>
                            <th id="tableHeader">Position</th>
                            <th id="tableHeader">Ward</th>
                        </tr>
                        <tr id="tableRowA">
                            <td id="tableCell"><?php echo $staff[$id]['username'] ?></td>
                            <td id="tableCell"><?php echo $staff[$id]['firstName'] ?></td>
                            <td id="tableCell"><?php echo $staff[$id]['surname'] ?></td>
                            <td id="tableCell"><?php echo $staff[$id]['dateOfBirth'] ?></td>
                            <td id="tableCell"><?php echo $staff[$id]['phoneNumber'] ?></td>
                            <td id="tableCell"><?php echo $staff[$id]['salary'] ?></td>
                            <td id="tableCell"><?php echo $staff[$id]['position'] ?></td>
                            <td id="tableCell"><?php echo $staff[$id]['ward'] ?></td>
                        </tr>
                    </table>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
