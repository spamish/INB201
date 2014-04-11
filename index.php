<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    if (session_status() != PHP_SESSION_NONE)
    {
        session_destroy();
    }
    session_start();
    $_SESSION['layer'] = -1;
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
            
            <div id="content" style="margin-left:160px;"> <!-- All content goes here -->
                
                <h2>Please enter your email and password to begin.</h2>
                
                <form action="redirect.php" method="post">
                    <table>
                        <tr>
                            <td>Username</td>
                            <td><input type="text" name="username" autofocus ></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" ></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Submit"></td>
                        </tr>
                    </table>
                </form>
                
            </div> <!-- end #content -->
            
            <?php include('includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
