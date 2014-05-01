<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('includes/start_session.php');
    include('lib/password.php');
    include('includes/functions.php');
    require_once('includes/connect_database.php');
    
    function checkPassword($password)
    {
        global $resource;
        $id = $_SESSION['login'];
        
        $sql = "SELECT staffID, hash
                FROM staff
                WHERE staffID = '$id'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        
        $resuts = mysql_fetch_array($records);
        $hash = $resuts["hash"];
        
        return password_verify($password, $hash);
    }
    
    $check = (
           ($_POST['password_old'] == $_POST['confirm_old'])
        && ($_POST['password_new'] == $_POST['confirm_new'])
        && checkPassword($_POST['password_old'])
    );
    
    if ($check)
    {
        $hash = password_hash($_POST['password_new'], PASSWORD_DEFAULT);
        changePassword($_SESSION['login'], $hash);
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
            <?php include('includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <?php
                    if ($check)
                    { ?>
                        <h2>Password Change Successful</h2>
                        <a id="btnSubmit" href="home.php">Return to home</a>
                    <?php }
                    else
                    { ?>
                        <h2>Password Change Failed</h2>
                        <p>Either new passwords do not match, old passwords
                           do not match or the old password is incorrect.</p>
                        <a id="btnSubmit" href="change_password.php">Try Again</a>
                    <?php }
                ?>
            </div> <!-- end #content -->
            
            <?php include('includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
