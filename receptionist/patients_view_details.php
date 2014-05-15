<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    
    if (!isset($_POST['id']))
    {
        header ("Location: patients_view.php");
    }
    
    $id = $_POST['id'];
    $staff = viewTable("staff");
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
                        value="<?php echo $id ?>">
                    <table>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $staff[$id]['username'] ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $staff[$id]['firstName'] ?></td>
                        </tr>
                        <tr>
                            <td>Surname</td>
                            <td><?php echo $staff[$id]['surname'] ?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><?php echo $staff[$id]['dateOfBirth'] ?></td>
                        </tr>
                        <tr>
                            <td>Mobile Phone</td>
                            <td><?php echo $staff[$id]['mobileNumber'] ?></td>
                        </tr>
                        <tr>
                            <td>Home Phone</td>
                            <td>Address</td>
                            <td>Roster</td>
                            <td>Salary</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo position($staff[$id]['position']) ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo ward($staff[$id]['ward']) ?></td>
                        </tr>
                    </table>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
