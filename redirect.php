<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('includes/password_functions.php');
    require('includes/functions.php');
    
    $staff = new Staff();
    $staff = getStaffInfo($_POST['username']);
    
    if ($staff->staffID)
    {
        $check = verifyPassword($staff->staffID, $_POST['password']);
    }
    else
    {
        $check = false;
    }
    
    if ($check)
    {
        $date = new DateTime();
        
        $_SESSION['login'] = $staff->staffID;
        $_SESSION['firstName'] = $staff->firstName;
        $_SESSION['surname'] = $staff->surname;
        $_SESSION['position'] = $staff->position;
        $_SESSION['ward'] = $staff->ward;
        if ($staff->lastLogin)
        {
            $_SESSION['lastLogin'] = $staff->lastLogin->format('g:ia')
            . " on " . $staff->lastLogin->format('D jS M Y');
        }
        
        update("staff", "staffID", $staff->staffID, "lastLogin", $date->format('Y-m-d H:i:s'));
    }
    else
    {
        $_SESSION['login'] = null;
    }
    
    //Developer backdoor.
    if (($_POST['username'] == "0") && ($_POST['password'] == "admin"))
    {
        $date = new DateTime();
        $check = true;
        
        $_SESSION['login'] = 0.1;
        $_SESSION['firstName'] = "TeamTOUCH";
        $_SESSION['surname'] = "Administrator";
        $_SESSION['position'] = "";
        $_SESSION['ward'] = "";
        $_SESSION['lastLogin'] = $date->format('g:ia')
            . " on " . $date->format('D jS M Y');
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
                
                <?php if ($check)
                { ?>
                    <h2>Welcome
                        <?php echo $_SESSION['firstName'] ?>
                    </h2>
                    <p>Creating your session and redirecting now.</p>
                <?php } else { ?>
                    <h2>Login Failed.</h2>
                    <p>Incorrect username or password</p>
                <?php } ?>
                
            </div> <!-- end #login -->
            
            <?php include('includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>

    <?php
        if ($check)
        {
            header( "refresh:1; url=home.php");
        }
        else
        {
            //header( "refresh:1; url=index.php");
        }
        exit;
    ?>
</html>
