<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    session_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
        <title>T.O.U.C.H. Online System</title>
    </head>
    
    <body>
        <div id="wrapper">
            <?php include('includes/header.php'); ?>
            <?php include('includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <form action="change_password_summary.php" method="post">
                    <table>
                        <tr>
                            <td align="right">Current Password</td>
                            <td align="left"><input type="password" name="password_old" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Confirm Current Password</td>
                            <td align="left"><input type="password" name="confirm_old" required/></td>
                        </tr>
                        <tr>
                            <td align="right">New Password</td>
                            <td align="left"><input type="password" name="password_new" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Confirm New Password</td>
                            <td align="left"><input type="password" name="confirm_new" required/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="left">
                                <input type="submit" value="Save">
                            </td>
                        </tr>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
