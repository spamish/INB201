<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    include('lib/password.php');
    include('includes/functions.php');
    
    function login($username, $password)
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con -> prepare("
            SELECT username, hash
            FROM employeeinfo
            WHERE username = '$username'
        ");
        $query -> bindValue(':username', $username);
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);
        
        $hash = $result[0]['hash'];
        return password_verify($password, $hash);
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
            
            <div id="content" style="margin-left:160px;"> <!-- All content goes here -->
                
                <?php
                    if (login($_POST['username'], $_POST['password'])) {
                        $employee = employeeInfoUsername($_POST['username']);
                        $_SESSION['id'] = $employee[0];
                        $_SESSION['firstName'] = $employee[2];
                        $_SESSION['position'] = $employee[7];
                    ?>
                    
                    <h2>Welcome <?php echo $_SESSION['firstName']; ?></h2>
                    <p>Creating your session and redirecting now.</p>
                <?php } else { ?>
                    <h2>Login Failed.</h2>
                    <p>Incorrect username or password</p>
                <?php } ?>
                
            </div> <!-- end #content -->
            
            <?php include('includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>

    <?php
        if (login($_POST['username'], $_POST['password'])) { 
            header( "refresh:1; url=home.php");
        } else {
            header( "refresh:1; url=index.php");
        }
        exit;
    ?>
</html>
