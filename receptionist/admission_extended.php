<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/recep_functions.php');
    require('../includes/functions.php');
    
    $_POST['identified'] = (($_POST['dateOfBirth'] != null) ? true : false);
    
    $patient = createPatient(new Patient($_POST));
    
    if ($patient->address)
    {
        $address = new Address();
        $address->addressID = $patient->address;
        $address = viewTable("addresses", $address);
    }
    if ($patient->guardian)
    {
        $guardian = new guardian();
        $guardian->parentID = $patient->guardian;
        $guardian = viewTable("guardians", $guardian);
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
                <p>All address fields (except unit number) must be completed to add address information to patient file.</p>
                
                <form action="admission_summary.php" method="post">
                    <table>
                        <tr>
                            <th>Patient Details</th>
                            <td><?php echo $patient->firstName ?></td>
                            <td><?php echo $patient->surname ?></td>
                        </tr>
                        <tr><td>Contact Details</td></tr>
                        <tr>
                            <td align="right">Mobile Phone</td>
                            <td><input type="text" name="mobilePhone"></td>
                            <td align="right">Home Phone</td>
                            <td><input type="text" name="homePhone"></td>
                        </tr>
                        <tr><td>Address Details</td></tr>
                        <tr>
                            <td align="right">Unit/Number</td>
                            <td>
                                <input type="text" name="unit" style="width: 30px;"> / 
                                <input type="text" name="house" style="width: 30px;">
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
                        <tr><th>Parent, Guardian or Next of Kin Details</th><tr>
                        <tr>
                            <td align="right">First Name</td>
                            <td><input type="text" name="grdFirstName"></td>
                            <td align="right">Surname</td>
                            <td><input type="text" name="grdSurname"></td>
                        </tr>
                        <tr>
                            <td>Contact Details</td>
                            <td align="right">Gender</td>
                        </tr>
                        <tr>
                            <td align="right">Mobile Phone</td>
                            <td><input type="text" name="grdMobilePhone"></td>
                        <tr>
                            <td>As Above (add check box).</td>
                        </tr>
                        <tr>
                            <td align="right">Home Phone</td>
                            <td><input type="text" name="grdHomePhone"></td>
                        </tr>
                        <tr><td>Address Details</td></tr>
                        <tr>
                            <td align="right">Unit/Number</td>
                            <td>
                                <input type="text" name="grdUnit" style="width: 30px;"> / 
                                <input type="text" name="grdHouse" style="width: 30px;">
                            </td>
                            <td align="right">Street</td>
                            <td><input type="text" name="grdStreet"></td>
                        </tr>
                        <tr>
                            <td align="right">Suburb or City</td>
                            <td><input type="text" name="grdSuburb"></td>
                            <td align="right">Postcode</td>
                            <td><input type="text" name="grdPostcode"></td>
                        </tr>
                        <tr>
                            <td align="right">State</td>
                            <td><input type="text" name="grdRegion" value="Queensland"></td>
                            <td align="right">Country</td>
                            <td><input type="text" name="grdCountry" value="Australia"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input id="btnSubmit" type="submit" name="append" value="Submit"></td>
                        </tr>
                    </table>
                    <input type="hidden" name="firstName" value="<?php echo $patient->firstName ?>">
                    <input type="hidden" name="surname" value ="<?php echo $patient->surname ?>">
                    <input type="hidden" name="gender" value="<?php echo $patient->gender ?>">
                    <input type="hidden" name="dateOfBirth" value="<?php echo $patient->dateOfBirth ?>">
                    <input type="hidden" name="state" value="<?php echo $_POST['state'] ?>">
                    <input type="hidden" name="details" value="<?php echo $_POST['details'] ?>">
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>