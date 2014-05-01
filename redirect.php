<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include('lib/password.php');
    include('includes/functions.php');
    require_once('includes/connect_database.php');
    
    function login($username, $password)
    {
        global $resource;
        
        $sql = "SELECT username, hash
                FROM staff
                WHERE username = '$username'";
        $records = mysql_query($sql, $resource)
            or die("Problem reading table: " . mysql_error());
        
        $resuts = mysql_fetch_array($records);
        $hash = $resuts["hash"];
        
        return password_verify($password, $hash);
    }
    
    $check = login($_POST['username'], $_POST['password']);
    if ($check)
    {
        session_start();
        $staff = staffInfoUsername($_POST['username']);
        $_SESSION['login'] = $staff[0];
        $_SESSION['firstName'] = $staff[2];
        $_SESSION['position'] = $staff[7];
    }
    else
    {
        session_start();
        $_SESSION['login'] = "";
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
                    <h2>Welcome <?php echo $_SESSION['firstName']; ?></h2>
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
            header( "refresh:1; url=index.php");
        }
        exit;
    ?>
</html>
