<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/recep_functions.php');
    require('../includes/functions.php');
    
    //Check if patient is identified or not.
    if (isset($_POST['append']))
    {
        $patient = new Patient();
        $patient->patientID = $_POST['patientID'];
        $results = viewTable("patients", $patient);
        $patient = new Patient($results[1]);
        $patient->identified = true;
        $append = true;
    }
    else
    {
        $patient = new Patient($_POST);
        $patient->identified = false;
    }
    
    //Update patient details.
    if ($patient->identified)
    {
        $reference = new Patient($_POST);
        $reference->patientID = $patient->patientID;
        
        foreach ($patient as $type => $value)
        {
            if ($patient->$type != $reference->$type)
            {
                update("patients", "patientID", $patient->patientID, $type, $reference->$type);
            }
        }
        
        $address = new Address($_POST);
        //Update address details.
        if (   $address->house
            && $address->street
            && $address->suburb
            && $address->postcode
            && $address->region
            && $address->country)
        {
            $address = assignAddress($address);
            update("patients", "patientID", $patient->patientID, "address", $address->addressID);
        }
        
        //Update guardian address.
        $guardian = new Guardian($_POST);
        
        if (isset($_POST['grdAddress']))
        {
            $guardian->homePhone = $patient->homePhone;
            $guardian->address = $address->addressID;
        }
        else
        {
            $_POST['unit'] = (isset($_POST['grdUnit']) ? $_POST['grdUnit'] : null);
            $_POST['house'] = (isset($_POST['grdHouse']) ? $_POST['grdHouse'] : null);
            $_POST['street'] = (isset($_POST['grdStreet']) ? $_POST['grdStreet'] : null);
            $_POST['suburb'] = (isset($_POST['grdSuburb']) ? $_POST['grdSuburb'] : null);
            $_POST['postcode'] = (isset($_POST['grdPostcode']) ? $_POST['grdPostcode'] : null);
            $_POST['region'] = (isset($_POST['grdRegion']) ? $_POST['grdRegion'] : null);
            $_POST['country'] = (isset($_POST['grdCountry']) ? $_POST['grdCountry'] : null);
            
            $address = new Address($_POST);
            if (   $address->house
                && $address->street
                && $address->suburb
                && $address->postcode
                && $address->region
                && $address->country)
            {
                $address = assignAddress($address);
            }
            $guardian->address = $address->addressID;
        }
        
        //Update guardian details.
        $_POST['firstName'] = (isset($_POST['grdFirstName']) ? $_POST['grdFirstName'] : null);
        $_POST['surname'] = (isset($_POST['grdSurname']) ? $_POST['grdSurname'] : null);
        $_POST['gender'] = (isset($_POST['grdGender']) ? $_POST['grdGender'] : null);
        $_POST['mobilePhone'] = (isset($_POST['grdMobilePhone']) ? $_POST['grdMobilePhone'] : null);
        $_POST['homePhone'] = (isset($_POST['grdHomePhone']) ? $_POST['grdHomePhone'] : null);
        
        $guardian = assignGuardian($guardian);
        
        if ($guardian->guardianID != $patient->guardian)
        {
            update("patients", "patientID", $patient->patientID, "guardian", $guardian->guardianID);
        }
    }
    
    //Create case file.
    $file = new File($_POST);
    $file->admission = new DateTime();
    
    $file = createFile($file);
    
    //Add admission note.
    $note = new Note($_POST);
    $note->file = $file->fileID;
    $note->type = "admission";
    $note->timestamp = $file->admission;
    $note->staff = $_SESSION['login'];
    
    $note = createNote($note);
    
    //Update links to file.
    if ($patient->identified)
    {
        update("files", "fileID", $file->fileID, "patient", $patient->patientID);
    }
    else
    {
        $patient->file = $file->fileID;
        createUnidentified($patient);
    }
    
    //Display patient information.
    header ("refresh:0; url=patients_view_details.php?fileID=" . $file->fileID);
?>