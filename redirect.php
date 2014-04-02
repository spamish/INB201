<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php include('variables/variables.php');
    include('includes/login.php');
    session_start(); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <meta name="description" content="" />

        <meta name="keywords" content="" />

        <meta name="author" content="" />

        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />

        <title>T.O.U.C.H. Online System</title>

    </head>

    <body>

        <div id="wrapper">

            <?php include('includes/header.php'); ?>

            <div id="content" style="width:80%;margin-left:10%;"> <!-- All content goes here -->
                <?php if(login($_POST['username'], $_POST['password'])) {
                    $_SESSION['id'] = id($_POST['username']);
                    $_SESSION['firstname'] = firstname($_POST['username']);
                    $_SESSION['surname'] = surname($_POST['username']);
                    $_SESSION['role'] = role($_POST['username']); ?>
                <h2>Welcome <?php echo $_SESSION['firstname'];
                    echo " "; echo $_SESSION['surname']; ?></h2>
                <p>Creating your session and redirecting now.</p>
                <?php } else { ?>
                    <h2>Login Failed.</h2>
                    <p>Incorrect username or password</p>
                <?php } ?>
                
                <!-- Diplay on successful login -->

            </div> <!-- end #content -->

            <?php include('includes/footer.php'); ?>

        </div> <!-- End #wrapper -->

    </body>

    <?php if(login($_POST['username'], $_POST['password'])) {
        header( "refresh:2; url=home.php");
    } else {
        header( "refresh:2; url=index.php");
    }
    exit; ?>

</html>