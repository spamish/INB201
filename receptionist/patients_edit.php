<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $file = new File($_GET);
    $results = viewTable("files", $file);
    $file = new File($results[1]);
    
    $patient = new Patient();
    if ($file->patient)
    {
        $patient->patientID = $file->patient;
        $results = viewTable("patients", $patient);
        $patient = new Patient($results[1]);
    }
    
    $address = new Address();
    if ($patient->address)
    {
        $address->addressID = $patient->address;
        $results = viewTable("addresses", $address);
        $address = new Address($results[1]);
    }
    
    $insurance = new Insurance();
    if ($patient->insurance)
    {
        $insurance->insuranceID = $patient->insurance;
        $results = viewTable("insurance", $insurance);
        $insurance = new Insurance($results[1]);
    }
    
    $guardian = new Guardian();
    if ($patient->guardian)
    {
        $guardian->guardianID = $patient->guardian;
        $results = viewTable("guardians", $guardian);
        $guardian = new Guardian($results[1]);
    }
    
    $residence = new Address();
    if ($guardian->address)
    {
        $residence->addressID = $guardian->address;
        $results = viewTable("addresses", $residence);
        $residence = new Address($results[1]);
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
                
                <form action="summary.php" method="post">
                    <input type="hidden" name="fileID" value="<?php echo $file->fileID ?>"/>
                    <input type="hidden" name="function" value="update"/>
                    <fieldset style="height:146px;">
                        <legend><h3>Patient Details</h3></legend>
                        <table>
                            <tr>
                                <th>First Name</th>
                                <td><input type="text" required autofocus
                                    name="firstName" value="<?php echo $patient->firstName ?>"/></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td><input type="text" required
                                    name="surname" value="<?php echo $patient->surname ?>"/></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td><input type="text" name="dateOfBirth" required
                                    value="<?php echo $patient->dateOfBirth->format('Y-m-d') ?>"/></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    <?php if ($patient->gender == "f") { ?>
                                        <input type="radio" name="gender" value="m"/>Male
                                        <input type="radio" name="gender" value="f" checked/>Female
                                    <?php } else { ?>
                                        <input type="radio" name="gender" value="m" checked/>Male
                                        <input type="radio" name="gender" value="f"/>Female
                                    <?php } ?>
                                </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:146px;">
                        <legend><h3>Parent, Guardian or Next of Kin Details</h3></legend>
                        <table>
                            <tr>
                                <th>First Name</th>
                                <td><input type="text" name="grdFirstName"
                                    value="<?php echo $guardian->firstName ?>"/></td>
                            </tr>
                            <tr>
                                <th>Surname</th>
                                <td><input type="text" name="grdSurname"
                                    value="<?php echo $guardian->surname ?>"/></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    <?php if ($patient->gender == "f") { ?>
                                        <input type="radio" name="grdGender" value="m"/>Male
                                        <input type="radio" name="grdGender" value="f" checked/>Female
                                    <?php } else { ?>
                                        <input type="radio" name="grdGender" value="m" checked/>Male
                                        <input type="radio" name="grdGender" value="f"/>Female
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:146px;">
                        <legend><h3>Contact Details</h3></legend>
                        <table>
                            <tr>
                                <th>Mobile Phone</th>
                                <td><input type="text" name="mobilePhone"
                                    value="<?php echo $patient->mobilePhone ?>"/></td>
                            </tr>
                            <tr>
                                <th>Home Phone</th>
                                <td><input type="text" name="homePhone"
                                    value="<?php echo $patient->homePhone ?>"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:146px;">
                        <legend><h3>Contact Details</h3></legend>
                        <table>
                            <tr>
                                <th>Mobile Phone</th>
                                <td><input type="text" name="grdMobilePhone"
                                    value="<?php echo $guardian->mobilePhone ?>"/></td>
                            </tr>
                            <tr>
                                <th>Same as Patients</th>
                                <td><input id="address" type="checkbox" name="grdAddress" onchange="setAddress()"/></td>
                            <tr>
                            </tr>
                                <th>Home Phone</th>
                                <td><input id="homePhone" type="text" name="grdHomePhone"
                                    value="<?php echo $guardian->homePhone ?>"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:220px;">
                        <legend><h3>Address Details</h3></legend>
                        <table>
                            <tr>
                                <th>Unit/Number</th>
                                <td>
                                    <input type="text" name="unit" style="width: 30px;"
                                        value="<?php echo $address->unit ?>"/> / 
                                    <input type="text" name="house" style="width: 30px;"
                                        value="<?php echo $address->house ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td><input type="text" name="street"
                                    value="<?php echo $address->street ?>"/></td>
                            </tr>
                            <tr>
                                <th>Suburb or City</th>
                                <td><input type="text" name="suburb"
                                    value="<?php echo $address->suburb ?>"/></td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td><input type="text" name="postcode"
                                    value="<?php echo $address->postcode ?>"/></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><input type="text" name="region"
                                    value="<?php echo $address->region ?>"/></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><input type="text" name="country"
                                    value="<?php echo $address->country ?>"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="height:220px;">
                        <legend><h3>Address Details</h3></legend>
                        <table>
                            <tr>
                                <th>Unit/Number</th>
                                <td>
                                    <input id="unit" type="text" name="grdUnit" style="width: 30px;"
                                        value="<?php echo $residence->unit ?>"> / 
                                    <input id="house" type="text" name="grdHouse" style="width: 30px;"
                                        value="<?php echo $residence->house ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td><input id="street" type="text" name="grdStreet"
                                    value="<?php echo $residence->street ?>"></td>
                            </tr>
                            <tr>
                                <th>Suburb or City</th>
                                <td><input id="suburb" type="text" name="grdSuburb"
                                    value="<?php echo $residence->suburb ?>"></td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td><input id="postcode" type="text" name="grdPostcode"
                                    value="<?php echo $residence->postcode ?>"></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><input id="region" type="text" name="grdRegion"
                                    value="<?php echo $residence->region ?>"></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><input id="country" type="text" name="grdCountry"
                                    value="<?php echo $residence->country ?>"></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <fieldset style="width:90%;">
                        <legend><h3>Insurance Details</h3></legend>
                        <table>
                            <tr>
                                <th>Provider</th>
                                <td><input type="text" name="provider"
                                    value="<?php echo $insurance->provider ?>"/></td>
                                <td style="width:30px;"></td>
                                <th>Policy</th>
                                <td><input type="text" name="policy"
                                    value="<?php echo $insurance->policy ?>"/></td>
                            </tr>
                            <tr>
                                <th>Rebate %</th>
                                <td><input type="text" name="percent"
                                    value="<?php echo $insurance->percent ?>"/>%</td>
                                <td></td>
                                <th>Rebate Max</th>
                                <td>$<input type="text" name="maximum"
                                    value="<?php echo $insurance->maximum ?>"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <h2 style="width:90%;"><input id="btnSubmit" type="submit" name="submit" value="Submit"></h2>
                </form>
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
            
        </div> <!-- End #wrapper -->
    </body>
</html>