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
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/info.css') ?>
            <?php include('../styles/cal.css') ?>
        </style>
        <script type="text/javascript" src="../includes/javascripting.js"></script>
        <title>T.O.U.C.H. Online System</title>
    </head>
    
    <body>
        <div id="wrapper">
            
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <h2>Patient Details</h2>
                
                <div id="message">
                    <p>Not required for admission but will be tracked on a list of patients with missing data.<br>
                    If patient name is already in database then all fields will be populated with current data.</p>
                    <p>All address fields (except unit number) must be completed to add address information to patient file.</p>
                </div>
                
                <form action="admission_summary.php" method="post">
                    <input type="hidden" name="patientID" value="<?php echo $patient->patientID ?>">
                    <fieldset style="height:146px;">
                        <legend><h3>Patient Details</h3></legend>
                        <table>
                            <tr>
                                <th>First Name</th>
                                <td><?php echo $patient->firstName ?></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td><?php echo $patient->surname ?></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td><?php echo gender($patient->gender) ?></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td><?php echo $patient->dateOfBirth->format('jS M Y') ?></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:146px;">
                        <legend><h3>Parent, Guardian or Next of Kin Details</h3></legend>
                        <table>
                            <tr>
                                <th>First Name</th>
                                <td><input type="text" name="grdFirstName"/></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td><input type="text" name="grdSurname"/></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    <input type="radio" name="grdGender" value="m"/>Male
                                    <input type="radio" name="grdGender" value="f"/>Female
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:146px;">
                        <legend><h3>Contact Details</h3></legend>
                        <table>
                            <tr>
                                <th>Mobile Phone</th>
                                <td><input type="text" name="mobilePhone"></td>
                            </tr>
                            <tr>
                                <th>Home Phone</th>
                                <td><input type="text" name="homePhone"></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:146px;">
                        <legend><h3>Contact Details</h3></legend>
                        <table>
                            <tr>
                                <th>Mobile Phone</th>
                                <td><input type="text" name="grdMobilePhone"/></td>
                            </tr>
                            <tr>
                                <th>Same as Patients</th>
                                <td><input id="grdAddress" type="checkbox" name="grdAddress" onchange="setAddress()"/></td>
                            </tr>
                            <tr>
                                <th>Home Phone</th>
                                <td><input id="homePhone" type="text" name="grdHomePhone"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:220px;">
                        <legend><h3>Address Details</h3></legend>
                        <table>
                            <tr>
                                <th>Unit/Number</th>
                                <td>
                                    <input type="text" name="unit" style="width: 30px;"> / 
                                    <input type="text" name="house" style="width: 30px;">
                                </td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td><input type="text" name="street"></td>
                            </tr>
                            <tr>
                                <th>Suburb or City</th>
                                <td><input type="text" name="suburb"></td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td><input type="text" name="postcode"></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><input type="text" name="region" value="Queensland"></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><input type="text" name="country" value="Australia"></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:220px;">
                        <legend><h3>Address Details</h3></legend>
                        <table>
                            <tr>
                                <th>Unit/Number</th>
                                <td>
                                    <input id="unit" type="text" name="grdUnit" style="width: 30px;"> / 
                                    <input id="house" type="text" name="grdHouse" style="width: 30px;">
                                </td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td><input id="street" type="text" name="grdStreet"></td>
                            </tr>
                            <tr>
                                <th>Suburb or City</th>
                                <td><input id="suburb" type="text" name="grdSuburb"></td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td><input id="postcode" type="text" name="grdPostcode"></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><input id="region" type="text" name="grdRegion" value="Queensland"></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><input id="country" type="text" name="grdCountry" value="Australia"></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="width:90%;">
                        <legend><h3>Insurance Details</h3></legend>
                        <table>
                            <tr>
                                <th>Provider</th>
                                <td><input type="text" name="provider"/></td>
                                <td style="width:30px;"></td>
                                <th>Policy</th>
                                <td><input type="text" name="policy"/></td>
                            </tr>
                            <tr>
                                <th>Rebate</th>
                                <td><input type="text" name="percent"/>%</td>
                                <td></td>
                                <th>Rebate Max</th>
                                <td>$<input type="text" name="maximum"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <h2 style="width:90%;"><input id="btnSubmit" type="submit" name="append" value="Submit"></h2>
                </form>
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>