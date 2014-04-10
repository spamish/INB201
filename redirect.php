<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    include('includes/login.php');
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
                
                <?php if (login($_POST['email'], $_POST['password'])) {
                    $_SESSION['id'] = id($_POST['email']);
                    $_SESSION['firstname'] = firstname($_POST['email']);
                    $_SESSION['surname'] = surname($_POST['email']);
                    $_SESSION['role'] = role($_POST['email']); ?>
                    
                    <h2>Welcome <?php echo $_SESSION['firstname']; ?></h2>
                    <p>Creating your session and redirecting now.</p>
                <?php } else { ?>
                    <h2>Login Failed.</h2>
                    <p>Incorrect email or password</p>
                <?php } ?>
                
            </div> <!-- end #content -->
            
            <?php include('includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>

    <?php
        if (login($_POST['email'], $_POST['password'])) {
            header( "refresh:1; url=home.php");
        } else {
            header( "refresh:1; url=index.php");
        }
        exit;
    ?>
</html>
