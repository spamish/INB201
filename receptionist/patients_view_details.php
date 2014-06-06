<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $results = viewTable("files", new File($_GET));
    $file = new File($results[1]);
    $patient = new Patient();
    
    $discharge = new Note();
    $discharge->type = "discharge";
    $discharge->file = $file->fileID;
    $results = viewTable("notes", $discharge);
    $discharge = $results[0];
    
    //Select related patient details.
    if($file->patient)
    {
        $patient->patientID = $file->patient;
        $results = viewTable("patients", $patient);
        $patient = new Patient($results[1]);
        $patient->identified = true;
        
        if ($patient->insurance)
        {
            $insurance = new Insurance();
            $insurance->insuranceID = $patient->insurance;
            $results = viewTable("insurance", $insurance);
            $insurance = new Insurance($results[1]);
        }
        
        if ($patient->address)
        {
            $address = new Address();
            $address->addressID = $patient->address;
            $results = viewTable("addresses", $address);
            $address = new Address($results[1]);
        }
        
        if ($patient->guardian)
        {
            $guardian = new Guardian();
            $guardian->guardianID = $patient->guardian;
            $results = viewTable("guardians", $guardian);
            $guardian = new Guardian($results[1]);
            
            if ($guardian->address)
            {
                $grdAddress = new Address();
                $grdAddress->addressID = $guardian->address;
                $results = viewTable("addresses", $grdAddress);
                $grdAddress = new Address($results[1]);
            }
        }
    }
    else
    {
        $patient->file = $file->fileID;
        $results = viewTable("unidentified", $patient);
        $patient = new Patient($results[1]);
        $patient->identified = false;
    }
    
    if ($file->doctor)
    {
        $staff = new Staff();
        $staff->staffID = $file->doctor;
        $results = viewTable("staff", $staff);
        $staff = new Staff($results[1]);
    }
    
    if ($file->room)
    {
        $room = new Room();
        $room->roomID = $file->room;
        $results = viewTable("rooms", $room);
        $room = new Room($results[1]);
    }
    
    $note = new Note();
    $note->file = $file->fileID;
    $notes = viewTable("notes", $note, "timestamp", false);
    
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            <?php include('../styles/style.css') ?>
            <?php include('../styles/actions.css') ?>
            <?php include('../styles/info.css') ?>
        </style>
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>
            
            <div id="content"> <!-- All content goes here -->
                <h2>Patient Information</h2>
                <div id="actions">
                    <a id="btnAction" href="patients_edit.php?fileID=<?php echo $file->fileID ?>">Update</a>
                    <a id="btnAction" href="process.php?fileID=<?php echo $file->fileID ?>">Process Payment</a>
                </div>
                
                <?php if (isset($_GET['change'])) { ?>
                    <div id="message">
                        <p>Owe customer $<?php echo $_GET['change'] ?> change.</p>
                    </div>
                <?php } ?>
                
				<fieldset style="height:200px;">
                    <legend><h3>Patient Details</h3></legend>
                    <table>
                        <?php if ($patient->identified)
                        { ?>
                            <tr>
                                <th>Patient ID</th>
                                <td><?php echo $patient->patientID ?></td>
                            </tr>
                        <?php } ?>
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
                        <?php if ($patient->identified)
                        { ?>
                            <tr>
                                <th>Date of Birth</th>
                                <td><?php echo $patient->dateOfBirth->format('jS M Y') ?></td>
                            </tr>
                        <?php } ?>
                    </table>
				</fieldset> <!-- end #patientDetails -->
                
                <fieldset style="height:200px;">
                    <legend><h3>Case File Details</h3></legend>
                    <table>
                        <tr>
                            <th>Case Number</th>
                            <td><?php echo $file->fileID ?></td>
                        </tr>
                        <tr>
                            <th>Admission</th>
                            <td><?php echo $file->admission->format('g:i a D jS M Y') ?></td>
                        </tr>
                        <tr>
                            <th>Balance</th>
                            <td>$<?php echo $file->balance ?></td>
                        </tr>
                        <tr>
                            <th>Primary Doctor</th> 
                            <?php if($file->doctor)
                            { ?>
                                <td><?php echo $staff->firstName . " " . $staff->surname ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?php echo $staff->username ?></td>
                            <?php }
                            else
                            { ?>
                                <td>None assigned.</td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <th>Room</th>
                            <?php if($file->room)
                            { ?>
                                <td><?php echo $room->roomNumber ?></td>
                            </tr>
                            <tr>
                                <th>Ward</th>
                                <td><?php echo $room->ward ?></td>
                            <?php }
                            else
                            { ?>
                                <td>None assigned.</td>
                            <?php } ?>
                        </tr>
                    </table>
				</fieldset> <!-- end #fileDetails -->
                
                <fieldset style="height:284px;">
                    <legend><h3>Contact Details</h3></legend>
                    <table>
                        <?php if ($patient->mobilePhone)
                        { ?>
                            <tr>
                                <th>Mobile Phone</th>
                                <td><?php echo $patient->mobilePhone ?></td>
                            </tr>
                        <?php }
                        if ($patient->homePhone)
                        { ?>
                            <tr>
                                <th>Home Phone</th>
                                <td><?php echo $patient->homePhone ?></td>
                            </tr>
                        <?php }
                        if ($patient->address)
                        { ?>
                            <tr>
                                <th>Address</th>
                                <td><?php echo ($address->unit ? ($address->unit . "/") : "")
                                    . $address->house . " " . $address->street ?></td>
                            </tr>
                            <tr>
                                <th>Suburb</th>
                                <td><?php echo $address->suburb ?></td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td><?php echo $address->postcode ?></td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td><?php echo $address->region ?></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><?php echo $address->country ?></td>
                            </tr>
                        <?php }
                        else
                        { ?>
                            <tr>
                                <th>No address set.</th>
                            </tr>
                        <?php } ?>
                    </table>
                </fieldset> <!-- end #contactDetails -->
                
                <fieldset style="height:284px;">
                    <legend><h3>Parent, Guardian or Next of Kin Details</h3></legend>
                    <table>
                        <tr>
                            <?php if($patient->guardian)
                            { ?>
                                <th>First Name</th>
                                    <td><?php echo $guardian->firstName ?></td>
                                </tr>
                                <tr>
                                    <th>Surname</th>
                                    <td><?php echo $guardian->surname ?></td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td><?php echo gender($guardian->gender) ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile Phone</th>
                                    <td><?php echo $guardian->mobilePhone ?></td>
                                </tr>
                                <tr>
                                    <th>Home Phone</th>
                                    <td><?php echo $guardian->homePhone ?></td>
                                </tr>
                                <? if ($guardian->address)
                                { ?>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo ($grdAddress->unit ? ($grdAddress->unit . "/") : "")
                                            . $grdAddress->house . " " . $grdAddress->street ?></td>
                                    </tr>
                                    <tr>
                                        <th>Suburb</th>
                                        <td><?php echo $grdAddress->suburb ?></td>
                                    </tr>
                                    <tr>
                                        <th>Postcode</th>
                                        <td><?php echo $grdAddress->postcode ?></td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td><?php echo $grdAddress->region ?></td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td><?php echo $grdAddress->country ?></td>
                                    </tr>
                                <?php
                                }
                            }
                            else
                            { ?>
                                <th>No details entered.</th>
                            <?php } ?>
                        </tr>
                    </table>
                </fieldset> <!-- end #guardianDetails -->
                
                <fieldset style="width:93%;">
                    <legend><h3>Insurance Details</h3></legend>
                    <table>
                        <?php if($patient->insurance)
                        { ?>
                            <tr>
                                <th>Provider</th>
                                <td><?php echo $insurance->provider ?></td>
                            </tr>
                            <tr>
                                <th>Policy</th>
                                <td><?php echo $insurance->policy ?></td>
                            </tr>
                            <?php if ($insurance->percent)
                            { ?>
                                <tr>
                                    <th>Rebate Percentage</th>
                                    <td><?php echo $insurance->percent ?>%</td>
                                </tr>
                            <?php }
                            if ($insurance->maximum)
                            { ?>
                                <tr>
                                    <th>Maximum Rebate</th>
                                    <td>$<?php echo $insurance->maximum ?></td>
                                </tr>
                            <?php }
                        }
                        else
                        { ?>
                            <tr>
                                <th>No insurance.</th>
                            </tr>
                        <?php } ?>
                    </table>
                </fieldset> <!-- end #insuranceDetails -->
                
                <fieldset style="width:93%;">
                    <legend><h3>Patient Notes</h3></legend>
                    <?php $count = 0;
                    for ($i = 1; $i <= $notes[0]; $i++)
                    {
                        $note = new Note($notes[$i]);
                        
                        if ($note->type == "payment")
                        { ?>
                            <table>
                                <tr>
                                    <th>Type of Action</th>
                                    <td><?php echo ucfirst($note->type) ?></td>
                                </tr>
                                <tr>
                                    <th>Timestamp</th>
                                    <td><?php echo $note->timestamp->format('h:ia D, jS M Y') ?></td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td><?php echo $note->staff ?></td>
                                </tr>
                                <tr>
                                    <th valign="top">Details</th>
                                    <td><?php echo $note->details ?></td>
                                </tr>
                            </table>
                            <br>
                        <?php $count++;
                        }
                    }
                    
                    if (!$count)
                    { ?>
                        <p>No payments to display.</p>
                    <?php } ?>
                </fieldset>
                
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
