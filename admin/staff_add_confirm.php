<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('../includes/functions.php');
    include('../lib/password.php');
    session_start();
    $_SESSION['layer'] = 1;
    if (1 /*unique*/) {
        $email = $_POST['firstname'] . ".";
        $email .= $_POST['surname'] . "@touch.com";
        $email = strtolower($email);
        
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $role = $_POST['role'];
        
        $password = substr(md5(rand()), 0, 10);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        createStaff($email, $firstname, $surname, $role, $hash);
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
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Role</th>
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
                        </tr>
                    </table>
                <?php } else { ?>
                    <p>Passwords didn't match.</p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
