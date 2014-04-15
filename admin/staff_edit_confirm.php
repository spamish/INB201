<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    session_start();
    include('../includes/functions.php');
    include_once('../lib/password.php');
    $check = checkIfExists($_POST['username']);
    if ($check[0]) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $firstName = $_POST['firstName'];
        $surname = $_POST['surname'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $phoneNumber = $_POST['phoneNumber'];
        $payGrade = $_POST['payGrade'];
        $position = $_POST['position'];
        $ward = $_POST['ward'];
        
        editStaff($id, $username, $firstName, $surname, $dateOfBirth, $phoneNumber, $payGrade, $position, $ward);
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
                <?php $check = checkIfExists($_POST['username']);
                if ($check[0]) {
                    $staff = staff();
                    $id = $id - 1; ?>
                    <p>Account edit successful.</p>
                    <table id="">
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Date of Birth</th>
                            <th>Phone Number</th>
                            <th>Pay Grade</th>
                            <th>Position</th>
                            <th>Ward</th>
                        </tr>
                        <tr>
                            <td><?php echo $staff[$id][0]; ?></td>
                            <td><?php echo $staff[$id][1]; ?></td>
                            <td><?php echo $staff[$id][2]; ?></td>
                            <td><?php echo $staff[$id][3]; ?></td>
                            <td><?php echo $staff[$id][4]; ?></td>
                            <td><?php echo $staff[$id][5]; ?></td>
                            <td><?php echo $staff[$id][6]; ?></td>
                            <td><?php echo $staff[$id][7]; ?></td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <p>The username is already in use.</p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
    
    <?php
        $check = checkIfExists($_POST['username']);
        if (!$check[0]) {
            header( "refresh:1; url=staff_view.php");
        }
        exit;
    ?>
</html>
