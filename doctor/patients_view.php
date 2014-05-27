<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $url[0] = "patients_view.php?order=";
    $url[1] = "&sort=";
    $order = (isset($_GET['order']) ? $_GET['order'] : null);
    $sort = (isset($_GET['sort']) ? ($_GET['sort'] ? true : false) : false);
    
    //Divider search parameters.
    {
        $_GET['identified'] = (isset($_GET['patientID']) ? true : false);
        $_GET['patient'] = (isset($_GET['patientID']) ? $_GET['patientID'] : null);
        
        $file = new File($_GET);
        $patient = new Patient($_GET);
        
        if (isset($_GET['ward']))
        {
            $_GET['ward'] = (($_GET['ward'] == "-") ? null : $_GET['ward']);
        }
        $room = new Room($_GET);
        
        $_GET['firstName'] = (isset($_GET['docFirstName']) ? $_GET['docFirstName'] : null);
        $_GET['surname'] = (isset($_GET['docSurname']) ? $_GET['docSurname'] : null);
        $_GET['gender'] = null;
        $_GET['ward'] = null;
        
        $staff = new Staff($_GET);
        
        $url .= ($patient->patientID ? ("patient = " . $patient->patientID . "&") : "");
        $url .= ($patient->firstName ? ("firstName = " . $patient->firstName . "&") : "");
        $url .= ($patient->surname ? ("surname = " . $patient->surname . "&") : "");
        $url .= ($patient->gender ? ("gender = " . $patient->gender . "&") : "");
        $url .= ($file->fileID ? ("fileID = " . $file->fileID . "&") : "");
        $url .= ($staff->staffID ? ("staffID = " . $staff->staffID . "&") : "");
        $url .= ($staff->username ? ("username = " . $staff->username . "&") : "");
        $url .= ($staff->firstName ? ("docFirstName = " . $staff->firstName . "&") : "");
        $url .= ($staff->surname ? ("docSurname = " . $staff->surname . "&") : "");
        $url .= ($room->roomNumber ? ("roomNumber = " . $room->roomNumber . "&") : "");
        $url .= ($room->ward ? ("ward = " . $room->ward . "&") : "");
    }
    
    $patients = viewCurrent($file, $patient, $room, $staff);
    
    
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
                <h2><?php
                    if (isset($_GET['search']))
                    {
                        echo "Search Results";
                    }
                    else
                    {
                        echo "Current Patients";
                    }
                ?></h2>
                <div id="viewPatients">
                    <form action="patients_view_details.php" method="get">
                        <table>
                            <tr>
                                <th><a href="<?php echo $url[0] . "patientID" . $url[1] . !$sort ?>">Patient ID</th>
                                <th><a href="<?php echo $url[0] . "fileID" . $url[1] . !$sort ?>">Case ID</th>
                                <th><a href="<?php echo $url[0] . "firstName" . $url[1] . !$sort ?>">First Name</th>
                                <th><a href="<?php echo $url[0] . "surname" . $url[1] . !$sort ?>">Surname</th>
                                <th><a href="<?php echo $url[0] . "gender" . $url[1] . !$sort ?>">Gender</th>
                                <th><a href="<?php echo $url[0] . "admission" . $url[1] . !$sort ?>">Admission</th>
                                <th><a href="<?php echo $url[0] . "roomNumber" . $url[1] . !$sort ?>">Room Number</th>
                                <th><a href="<?php echo $url[0] . "ward" . $url[1] . !$sort ?>">Ward</th>
                                <td>
                                    <input id="btnSubmit" type="submit" name="details"
                                        value="View Details" style="float: right;">
                                </td>
                            </tr>
                            <?php
                                for ($i = 1; $i <= $patients[0]; $i++)
                                {
                                    $file = new File($patients[$i]['file']);
                                    $patient = new Patient($patients[$i]['patient']);
                                    $room = new Room();//$patients[$i]['room']);
                                    $staff = new Staff();//$patients[$i]['staff']);
                                    
                                    //echo var_dump($file) . "<br><br>";
                                    //echo var_dump($patient) . "<br><br>";
                                    
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
                                            <td><?php echo $file->admission->format('Y-m-d H:i:s') ?></td>
                                            <td><?php //echo $file->roomNumber ?></td>
                                            <td><?php //echo $file->ward ?></td>
                                            <td>
                                                <input id="radio" type="radio" name="fileID"
                                                    value="<?php echo $file->fileID ?>">
                                            </td>
                                        </tr>
                                <?php }
                            ?>
                        </table>
                        <?php if($patients[0] == 0)
                        { ?>
                                <p>No results to display.</p>
                        <?php } ?>
                    </form>
                </div> <!-- end #viewPatients -->
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
