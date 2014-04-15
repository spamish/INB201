<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    session_start();
    include('lib/password.php');
    include('includes/functions.php');
    
    function checkPassword($password)
    {
        global $dbName, $dbUser, $dbPassword;
        $id = $_SESSION['id'];
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con -> prepare("
            SELECT id, hash
            FROM employeeinfo
            WHERE id = '$id'
        ");
        $query -> bindValue(':id', $id);
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);
        
        $hash = $result[0]['hash'];
        return password_verify($password, $hash);
    }
    
    function changePassword($hash)
    {
        global $dbName, $dbUser, $dbPassword;
        $id = $_SESSION['id'];
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con->prepare("
            UPDATE employeeinfo
            SET hash='$hash'
            WHERE id='$id'
        ");
        $query->bindValue(':id', $id);
        $query->execute();
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
                    if (   ($_POST['password_old'] == $_POST['confirm_old'])
                        && ($_POST['password_new'] == $_POST['confirm_new'])
                        && checkPassword($_POST['password_old']))
                    {
                        $hash = password_hash($_POST['password_new'], PASSWORD_DEFAULT);
                        changePassword($hash);
                        ?>
                        <h2>Password Change Successful</h2>
                    <?php }
                    else
                    { ?>
                        <h2>Password Change Failed</h2>
                        <?php
                        if ($_POST['password_old'] == $_POST['confirm_old']) {
                            echo "Old Match";
                        }
                        if ($_POST['password_new'] == $_POST['confirm_new']) {
                            echo "New Match";
                        }
                        if (checkPassword($_POST['password_old'])) {
                            echo "Passwords Match";
                        }
                    }
                ?>
            </div> <!-- end #content -->
            
            <?php include('includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
