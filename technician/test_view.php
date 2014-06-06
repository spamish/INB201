<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/tech_functions.php');
    require('../includes/functions.php');
    
    $url[0] = "test_view.php?";
    $url[1] = "order=";
    $url[2] = "&sort=";
    
    $order = (isset($_GET['order']) ? $_GET['order'] : null);
    $sort = (isset($_GET['sort']) ? ($_GET['sort'] ? true : false) : false);
    
    $tests = viewTests();
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
                <h2>Upcoming Tests</h2>
                <div id="viewPatients">
                    <form action="patients_view_details.php" method="get">
                        <table>
                            <tr>
                                <th><a href="<?php echo $url[0] . $url[1] . "patientID" . $url[2] . !$sort ?>">Patient ID</th>
                                <th><a href="<?php echo $url[0] . $url[1] . "fileID" . $url[2] . !$sort ?>">Case ID</th>
                                <th><a href="<?php echo $url[0] . $url[1] . "firstName" . $url[2] . !$sort ?>">First Name</th>
                                <th><a href="<?php echo $url[0] . $url[1] . "surname" . $url[2] . !$sort ?>">Surname</th>
                                <th><a href="<?php echo $url[0] . $url[1] . "gender" . $url[2] . !$sort ?>">Gender</th>
                                <th><a href="<?php echo $url[0] . $url[1] . "code" . $url[2] . !$sort ?>">Test Code</th>
                                <th><a href="<?php echo $url[0] . $url[1] . "roomNumber" . $url[2] . !$sort ?>">Equipment Room</th>
                                <th><a href="<?php echo $url[0] . $url[1] . "start" . $url[2] . !$sort ?>">Start</th>
                                <th><a href="<?php echo $url[0] . $url[1] . "finish" . $url[2] . !$sort ?>">Finish</th>
                                <td>
                                    <input id="btnSubmit" type="submit" name="details"
                                        value="View Details" style="float: right;">
                                </td>
                            </tr>
                            <?php
                                for ($i = 1; $i <= $tests[0]; $i++)
                                {
                                    $file = new File($tests[$i]['file']);
                                    $patient = new Patient($tests[$i]['patient']);
                                    $test = new Test($tests[$i]['test']);
                                    $equipment = new Equipment($tests[$i]['equipment']);
                                    
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
                                            <td><?php echo $equipment->code ?></td>
                                            <td><?php echo $equipment->roomNumber ?></td>
                                            <td><?php echo $test->start->format('Y-m-d H:i:s') ?></td>
                                            <td><?php echo $test->finish->format('Y-m-d H:i:s') ?></td>
                                            <td id="selection">
                                                <input id="radio" type="radio" name="fileID"
                                                    value="<?php echo $file->fileID ?>">
                                            </td>
                                        </tr>
                                <?php }
                            ?>
                        </table>
                        <?php if($tests[0] == 0)
                        { ?>
                            <div id="message">
                                <p>No results to display.</p>
                            </div>
                        <?php } ?>
                    </form>
                </div> <!-- end #viewPatients -->
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
