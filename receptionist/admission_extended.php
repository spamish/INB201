<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/recep_functions.php');
    require('../includes/functions.php');
    
    $patient['firstName'] = $_POST['firstName'];
    $patient['surname'] = $_POST['surname'];
    $patient['gender'] = $_POST['gender'];
    $patient['dateOfBirth'] = $_POST['dateOfBirth'];
    
    $patient = createPatient($patient);
    
    if (isset($patient['mobileNumber']))
    {
        //Get mobile phone details
    }
    if (isset($patient['address']))
    {
        //Get address details
    }
    if (isset($patient['nextOfKin']))
    {
        //Get nextOfKin details
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <title>T.O.U.C.H. Online System</title>
    </head>
    
    <body>
        <div id="wrapper">
            
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <h2>Patient Details</h2>
                
                <p>Not required for admission but will be tracked on a list of patients with missing data.<br>
                If patient name is already in database then all fields will be populated with current data.</p>
                <p>All address fields (except unit number) must be completed to add address information to patient file.<br>
                If address exists then home phone will be added from the related address.</p>
                
                <form action="admission_summary.php" method="post">
                    <table>
                        <tr><td>Phone Number</td></tr>
                        <tr>
                            <td align="right">Mobile</td>
                            <td><input type="text" name="mobileNumber"></td>
                            <td align="right">Home</td>
                            <td><input type="text" name="homePhone"></td>
                        </tr>
                        <tr><td>Address</td></tr>
                        <tr>
                            <td align="right">Unit/Number</td>
                            <td>
                                <input type="text" name="unit" style="width: 30px;"> / 
                                <input type="text" name="houseNumber" style="width: 30px;">
                            </td>
                            <td align="right">Street</td>
                            <td><input type="text" name="street"></td>
                        </tr>
                        <tr>
                            <td align="right">Suburb or City</td>
                            <td><input type="text" name="suburb"></td>
                            <td align="right">Postcode</td>
                            <td><input type="text" name="postcode"></td>
                        </tr>
                        <tr>
                            <td align="right">State</td>
                            <td><input type="text" name="region" value="Queensland"></td>
                            <td align="right">Country</td>
                            <td><input type="text" name="country" value="Australia"></td>
                        </tr>
                        <tr><td>Next of Kin</td><tr>
                        <tr>
                            <td align="right">First Name</td>
                            <td><input type="text" name="nextOfKinFirstName"></td>
                            <td align="right">Surname</td>
                            <td><input type="text" name="nexxtOfKinSurname"></td>
                        </tr>
                            <td></td>
                            <td><input id="btnSubmit" type="submit" name="append" value="Submit"></td>
                        </tr>
                    </table>
                    <input type="hidden" name="firstName" value="<?php echo $patient[$patient[0]]['firstName'] ?>">
                    <input type="hidden" name="surname" value ="<?php echo $patient[$patient[0]]['surname'] ?>">
                    <input type="hidden" name="gender" value="<?php echo $patient[$patient[0]]['gender'] ?>">
                    <input type="hidden" name="dateOfBirth" value="<?php echo $patient[$patient[0]]['dateOfBirth'] ?>">
                    <input type="hidden" name="state" value="<?php echo $_POST['state'] ?>">
                    <input type="hidden" name="notes" value="<?php echo $_POST['notes'] ?>">
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>