<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('includes/start_session.php');
    require('includes/password_functions.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('styles/style.css') ?>
            <?php include('styles/main.css') ?>
        </style>
        <title>T.O.U.C.H. Online System</title>
    </head>
    
    <body>
        <div id="wrapper">
            
            <?php include('includes/header.php'); ?>
            <?php include('includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <div id="home">
                    <h2>Welcome <?php echo $_SESSION['firstName'] . " " . $_SESSION['surname'] ?></h2>
                    <?php if (isset($_SESSION['lastLogin']))
                    { ?>
                        <p>You last logged in at <?php echo $_SESSION['lastLogin'] ?></p>
                    <?php } ?>
                </div> <!-- end #home -->
            </div> <!-- end #content -->
            
            <?php include('includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>
