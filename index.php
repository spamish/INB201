<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    if(isset($_SESSION))
    {
        require('includes/lib/end_session.php');
    }
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
            
            <div id="login"> <!-- All login content goes here -->
                
                <h2>Please enter your email and password to begin.</h2>
                
                <form action="redirect.php" method="post">
                    <table id="loginTable">
                        <tr>
                            <td id="loginCell">Username</td>
                            <td id="loginCell"><input type="text" name="username" required autofocus ></td>
                        </tr>
                        <tr>
                            <td id="loginCell">Password</td>
                            <td id="loginCell"><input type="password" name="password" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input id="btnSubmit" type="submit" name="submit" value="Submit"></td>
                        </tr>
                    </table>
                </form>
                
            </div> <!-- end #content -->
            
            <?php include('includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
