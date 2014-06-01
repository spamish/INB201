<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->

                <h2>Search for Patients</h2>
                <form action="patients_view.php" method="get">
                    <?php
                        if (isset($_GET['staffID']))
                        { ?>
                            <input type="hidden" name="staffID" value="<?php echo $_GET['staffID'] ?>">
                        <?php }
                    ?>
                    <table>
                        <tr>
                            <td align="right">Patient ID</td>
                            <td><input type="text" name="patientID" autofocus ></td>
                        </tr>
                        <tr>
                            <td align="right">Case ID</td>
                            <td><input type="text" name="fileID"></td>
                        </tr>
                        <tr>
                            <td align="right">First Name</td>
                            <td><input type="text" name="firstName"></td>
                        </tr>
                        <tr>
                            <td align="right">Surname</td>
                            <td><input type="text" name="surname"></td>
                        </tr>
                        <tr>
                            <td align="right">Gender</td>
                            <td>
                                <input type="radio" name="gender" value="m">Male
                                <input type="radio" name="gender" value="f">Female
                            </td>
                        </tr>
                        <?php
                            if (!isset($_GET['staffID']))
                            { ?>
                                <tr>
                                    <td align="right">Doctor Username</td>
                                    <td><input type="text" name="username"></td>
                                </tr>
                                <tr>
                                    <td align="right">Doctor First Name (work in progress)</td>
                                    <td><input type="text" name="docFirstName"></td>
                                </tr>
                                <tr>
                                    <td align="right">Doctor Surname (work in progress)</td>
                                    <td><input type="text" name="docSurname"></td>
                                </tr>
                            <? }
                        ?>
                        <tr>
                            <td>Room Number and/or Ward</td>
                            <td>
                                <input type="text" name="roomNumber">
                                <select id="ward" name="ward">
                                    <option value="-">-</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input id="btnSubmit" type="submit"
                                    name="submit" value="Submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
