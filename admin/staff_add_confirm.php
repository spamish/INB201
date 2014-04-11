<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    session_start();
    $_SESSION['layer'] = 1;
    include('../includes/functions.php');
    include_once('../lib/password.php');
    if (1 /*unique*/) {
        echo $username = $_POST['username'];
        echo $firstName = $_POST['firstName'];
        echo $surname = $_POST['surname'];
        echo $dateOfBirth = $_POST['dateOfBirth'];
        echo $phoneNumber = $_POST['phoneNumber'];
        echo $payGrade = $_POST['payGrade'];
        echo $position = $_POST['position'];
        echo $ward = $_POST['ward'];
        
        $password = "password"; //substr(md5(rand()), 0, 10);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        createStaff($username, $firstName, $surname, $dateOfBirth, $phoneNumber, $payGrade, $position, $ward, $hash);
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
                <?php if (1) { ?>
                    <p>Account creation successful.<br>
                    Temporary password is <?php echo $password?></p>
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
                        
                        <?php
                            $count = tally() - 1;
                            $staff = staff();
                        ?>
                        
                        <tr>
                            <td><?php echo $staff[$count][0]; ?></td>
                            <td><?php echo $staff[$count][1]; ?></td>
                            <td><?php echo $staff[$count][2]; ?></td>
                            <td><?php echo $staff[$count][3]; ?></td>
                            <td><?php echo $staff[$count][4]; ?></td>
                            <td><?php echo $staff[$count][5]; ?></td>
                            <td><?php echo $staff[$count][6]; ?></td>
                            <td><?php echo $staff[$count][7]; ?></td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <p>The username is already in use.</p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
