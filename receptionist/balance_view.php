<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/recep_functions.php');
    require('../includes/functions.php');
    
    $url[0] = "balance_view.php?order=";
    $url[1] = "&sort=";
    $order = (isset($_GET['order']) ? $_GET['order'] : null);
    $sort = (isset($_GET['sort']) ? ($_GET['sort'] ? true : false) : false);
    
    $patients = viewBalances();
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/table.css') ?>
        </style>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <h2>Patients with Outstanding Balances</h2>
                <form action="patients_view_details.php" method="get">
                    <table>
                        <tr>
                            <th><a href="<?php echo $url[0] . "patientID" . $url[1] . !$sort ?>">Patient ID</th>
                            <th><a href="<?php echo $url[0] . "fileID" . $url[1] . !$sort ?>">Case ID</th>
                            <th><a href="<?php echo $url[0] . "firstName" . $url[1] . !$sort ?>">First Name</th>
                            <th><a href="<?php echo $url[0] . "surname" . $url[1] . !$sort ?>">Surname</th>
                            <th><a href="<?php echo $url[0] . "gender" . $url[1] . !$sort ?>">Gender</th>
                            <th><a href="<?php echo $url[0] . "balance" . $url[1] . !$sort ?>">Balance</th>
                            <td>
                                <input id="btnSubmit" type="submit" name="details"
                                    value="View Details" style="float: right;">
                            </td>
                        </tr>
                        <?php if ($patients)
                        {
                            for ($i = 1; $i <= $patients[0]; $i++)
                            {
                                $file = new File($patients[$i]['file']);
                                $patient = new Patient($patients[$i]['patient']);
                                
                                if ($i % 2 == 0)
                                { ?>
                                    <tr id="tableRowA">
                                <?php }
                                else
                                { ?>
                                    <tr id="tableRowB">
                                <?php } ?>
                                        <td><?php echo $patient->patientID ?></td>
                                        <td><?php echo $file->fileID ?></td>
                                        <td><?php echo $patient->firstName ?></td>
                                        <td><?php echo $patient->surname ?></td>
                                        <td><?php echo gender($patient->gender) ?></td>
                                        <td>$<?php echo $file->balance ?></td>
                                        <td id="selection">
                                            <input type="radio" name="fileID"
                                                value="<?php echo $file->fileID ?>">
                                        </td>
                                    </tr>
                            <?php }
                        }
                        else
                        { ?>
                            <div id="message">
                                <p>No results to display.</p>
                            </div>
                        <?php } ?>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
