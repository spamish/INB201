<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/admin_functions.php');
    require('../includes/functions.php');
    
    $i = 1;
    while (isset($_POST['staff' . $i]))
    {
        $staff = new Staff();
        $staff->username = $_POST['surgeon' . $i];
        $results = viewTable("staff", $staff);
        if ($results[0])
        {
            $staff = new Staff($results[1]);
            if ($staff->position == "surgeon")
            {
                $surgeons[] = $staff->staffID;
            }
            else
            {
                $error = "A selected surgeon is assigned to a different role.";
            }
        }
        else
        {
            $error = "A selected surgeon doesn't exist.";
        }
        
        $i++;
    }
    
    $procedure = new Procedure($_POST);
    $procedure->surgeons = serialize($surgeons);
    
    if (checkCode($procedure))
    {
        $error = "The procedure code is not unique.";
        $check = false;
    }
    
    if ($check)
    {
        createProcedure($procedure);
    }
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
                <h2>Summary</h2>
                <?php if ($check)
                { ?>
                    <p>Adding of operation procedure successful.</p>
                    <table>
                        <tr>
                            <th>Procedure Code</th>
                            <th>Procedure Duration</th>
                            <th>Cost of Procedure</th>
                            <th>Procedure Description</th>
                        </tr>
                        
                        <tr id="tableRowA">
                            <td><?php echo $procedure->code ?></td>
                            <td><?php echo $procedure->duration->format('H:i') ?></td>
                            <td><?php echo $procedure->cost ?></td>
                            <td><?php echo $procedure->description ?></td>
                        </tr>
                    </table>
                <?php }
                else
                { ?>
                    <p><?php echo $error ?></p>
                <?php } ?>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
