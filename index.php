<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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

                <h2>Please enter your username and password to begin.</h2>

                <form action="redirect.php" method="post">
                    <p><label for="username"> Username: </label>
                    <input type="text" name="username" autofocus required></p>
                    <p><label for="password"> Password: </label>
                    <input type="password" name="password" required></p>
                    <input type="submit" value="Submit">
                </form>

            </div> <!-- end #content -->

            <?php include('includes/footer.php'); ?>

        </div> <!-- End #wrapper -->

    </body>

</html>