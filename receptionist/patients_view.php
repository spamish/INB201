<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $url = "patients_view.php?";
    
    if (isset($_GET['patient']) && strlen($_GET['patient']) > 0)
    {
        $search['patient'] = $_GET['patient'];
        $url .= "patient=" . $search['patient'] . "&";
    }
    if (isset($_GET['file']) && strlen($_GET['file']) > 0)
    {
        $search['file'] = $_GET['file'];
        $url .= "file=" . $search['file'] . "&";
    }
    if (isset($_GET['firstName']) && strlen($_GET['firstName']) > 0)
    {
        $search['firstName'] = $_GET['firstName'];
        $url .= "firstName=" . $search['firstName'] . "&";
    }
    if (isset($_GET['surname']) && strlen($_GET['surname']) > 0)
    {
        $search['surname'] = $_GET['surname'];
        $url .= "surname=" . $search['surname'] . "&";
    }
    if (isset($_GET['roomNumber']) && strlen($_GET['roomNumber']) > 0)
    {
        $search['roomNumber'] = $_GET['roomNumber'];
        $url .= "roomNumber=" . $search['roomNumber'] . "&";
    }
    if (isset($_GET['ward']) && strlen($_GET['ward']) > 0)
    {
        $search['ward'] = $_GET['ward'];
        $url .= "ward=" . $search['ward'] . "&";
    }
    
    //$optons = isset($_GET[]);
        
    $patients = viewCurrent(isset($search) ? $search : null);
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

                <h2>Search Results</h2>
                <form action="patients_view_details.php" method="post">
                    <table>
                        <tr>
                            <th><a href="<?php echo $url . "order=patient"?>">Patient ID</th>
                            <th><a href="<?php echo $url . "order=file"?>">Case ID</th>
                            <th><a href="<?php echo $url . "order=firstName"?>">First Name</th>
                            <th><a href="<?php echo $url . "order=surname"?>">Surname</th>
                            <th><a href="<?php echo $url . "order=roomNumber"?>">Room Number</th>
                            <th><a href="<?php echo $url . "order=ward"?>">Ward</th>
                            <td>
                                <input id="btnSubmit" type="submit" name="details"
                                    value="View Details" style="float: right;">
                            <td>
                        </tr>
                        <?php for ($i = 1; $i <= $patients[0]; $i++)
                        {
                            $firstName = isset($patients[$i]['firstName']) ? $patients[$i]['firstName'] : $patients[$i]['forename'];
                            $surname = isset($patients[$i]['surname']) ? $patients[$i]['surname'] : $patients[$i]['postname'];
                            $patientID = isset($patients[$i]['patientID']) ? $patients[$i]['patientID'] : "";
                            $roomNumber = isset($patients[$i]['roomNumber']) ? $patients[$i]['roomNumber'] : "";
                            $ward = isset($patients[$i]['ward']) ? $patients[$i]['ward'] : "";
                            
                            if ($i % 2 == 0)
                            { ?>
                                <tr id="tableRowA">
                            <?php }
                            else
                            { ?>
                                <tr id="tableRowB">
                            <?php } ?>
                                    <td><?php echo $patientID ?></td>
                                    <td><?php echo $patients[$i]['file'] ?></td>
                                    <td><?php echo $firstName ?></td>
                                    <td><?php echo $surname ?></td>
                                    <td><?php echo $roomNumber ?></td>
                                    <td><?php echo $ward ?></td>
                                    <td>
                                        <input id="radio" type="radio" name="id"
                                            value="<?php echo $i ?>">
                                    </td>
                                </tr>
                        <?php } ?>
                    </table>
                    <?php if($patients[0] == 0)
                    { ?>
                            <p>No results to display.</p>
                    <?php } ?>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
