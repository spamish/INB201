<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('../includes/start_session.php');
    include('../includes/functions.php');
    include_once('../lib/password.php');
    $check = checkIfExists($_POST['username']);
    if ($check) {
        $username = $_POST['username'];
        $firstName = $_POST['firstName'];
        $surname = $_POST['surname'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $phoneNumber = $_POST['phoneNumber'];
        $payGrade = $_POST['payGrade'];
        $position = $_POST['position'];
        $ward = $_POST['ward'];
        
        $password = substr(md5(rand()), 0, 10);
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
                <?php if ($check)
                { ?>
                    <p>Adding of room successful.</p>
                    <table>
                        <tr id="tableRowHeader">
                            <th id="tableHeader">Username</th>
                            <th id="tableHeader">First Name</th>
                            <th id="tableHeader">Surname</th>
                            <th id="tableHeader">Date of Birth</th>
                            <th id="tableHeader">Phone Number</th>
                            <th id="tableHeader">Pay Grade</th>
                            <th id="tableHeader">Position</th>
                            <th id="tableHeader">Ward</th>
                        </tr>
                        
                        <?php
                            $count = tallyRooms() - 1;
                            $staff = viewStaff();
                        ?>
                        
                        <tr id="tableRowA">
                            <td id="tableCell"><?php echo $staff[$count][0]; ?></td>
                            <td id="tableCell"><?php echo $staff[$count][1]; ?></td>
                            <td id="tableCell"><?php echo $staff[$count][2]; ?></td>
                            <td id="tableCell"><?php echo $staff[$count][3]; ?></td>
                            <td id="tableCell"><?php echo $staff[$count][4]; ?></td>
                            <td id="tableCell"><?php echo $staff[$count][5]; ?></td>
                            <td id="tableCell"><?php echo $staff[$count][6]; ?></td>
                            <td id="tableCell"><?php echo $staff[$count][7]; ?></td>
                        </tr>
                    </table>
                <?php }
                else
                { ?>
                    <p>The username is already in use.</p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
    
    <?php
        if (!$check) {
            header( "refresh:1; url=staff_add.php");
        }
        exit;
    ?>
</html>
