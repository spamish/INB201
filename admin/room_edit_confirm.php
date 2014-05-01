<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('../includes/start_session.php');
    include('../includes/functions.php');
    include_once('../lib/password.php');
    
    if (isset($_POST['btnReset']))
    {
        $id = $_POST['id'];
        $password = substr(md5(rand()), 0, 10);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        resetPassword($id, $hash);
    }
    else if (isset($_POST['btnUpdate']))
    {
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $surname = $_POST['surname'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $phoneNumber = $_POST['phoneNumber'];
        $salary = $_POST['salary'];
        $position = $_POST['position'];
        $ward = $_POST['ward'];
        
        editStaff($id, $firstName, $surname, $dateOfBirth, $phoneNumber, $salary, $position, $ward);
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
                <?php if (isset($_POST['btnReset']))
                { ?>
                    <p>Password reset, temporary password is "<?php echo $password;?>"</p>
                <?php }
                else if (isset($_POST['btnUpdate']))
                {
                    $staff = viewStaff();
                    $id = $id - 1; ?>
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
                            <td id="tableCell"><?php echo $staff[$id][0]; ?></td>
                            <td id="tableCell"><?php echo $staff[$id][1]; ?></td>
                            <td id="tableCell"><?php echo $staff[$id][2]; ?></td>
                            <td id="tableCell"><?php echo $staff[$id][3]; ?></td>
                            <td id="tableCell"><?php echo $staff[$id][4]; ?></td>
                            <td id="tableCell"><?php echo $staff[$id][5]; ?></td>
                            <td id="tableCell"><?php echo $staff[$id][6]; ?></td>
                            <td id="tableCell"><?php echo $staff[$id][7]; ?></td>
                        </tr>
                    </table>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
