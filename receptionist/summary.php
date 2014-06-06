<?php
    require('../includes/start_session.php');
    require('../includes/recep_functions.php');
    require('../includes/functions.php');
    
    switch ($_POST['function'])
    {
        case "payment":
            $file = new File($_POST);
            $results = viewTable("files", $file);
            $file = new File($results[1]);
            
            $note = new Note();
            $note->file = $file->fileID;
            $note->type = "payment";
            $note->staff = $_SESSION['login'];
            $note->timestamp = new DateTime();
            
            $due = $_POST['due'];
            if ($due == 0)
            {
                update("files", "fileID", $file->fileID, "balance", 0);
                $note->details = "File balance paid by insurance.";
            }
            else
            {
                $amount = $_POST['amount'];
                if ($due > $amount)
                {
                    $remaining = $due - $amount;
                    update("files", "fileID", $file->fileID, "balance", $remaining);
                    $note->details = "Portion of file balance paid off.";
                }
                else
                {
                    $change = $amount - $due;
                    update("files", "fileID", $file->fileID, "balance", 0);
                    $note->details = "File balance paid off.";
                }
            }
            
            createNote($note);
            
            break;
        
        case "update":
            $file = new File($_POST);
            $results = viewTable("files", $file);
            $file = new File($results[1]);
            
            $patient = new Patient($_POST);
            $reference = new Patient();
            
            if ($file->patient)
            {
                $reference->patientID = $file->patient;
                $results = viewTable("patients", $reference);
                $reference = new Patient($results[1]);
                $patient->patientID = $reference->patientID;
                
                foreach ($patient as $type => $value)
                {
                    if ($patient->$type != $reference->$type)
                    {
                        update("patients", "patientID", $reference->patientID, $type, $patient->$type);
                    }
                }
            }
            else
            {
                delete("unidentified", "file", $file->fileID);
                $patient = createPatient($patient);
            }
            
            $address = new Address($_POST);
            if (   $address->house
                && $address->street
                && $address->suburb
                && $address->postcode
                && $address->region
                && $address->country)
            {
                $address = assignAddress($address);
                
                if ($address->addressID != $patient->address)
                {
                    update("patients", "patientID", $patient->patientID, "address", $address->addressID);
                }
            }
            
            $insurance = new Insurance($_POST);
            $insurance = assignInsurance($insurance);
            
            if ($insurance->insuranceID != $patient->insurance)
            {
                update("patients", "patientID", $patient->patientID, "insurance", $insurance->insuranceID);
            }
            
            $_POST['firstName'] = (isset($_POST['grdFirstName']) ? $_POST['grdFirstName'] : null);
            $_POST['surname'] = (isset($_POST['grdSurname']) ? $_POST['grdSurname'] : null);
            $_POST['gender'] = (isset($_POST['grdGender']) ? $_POST['grdGender'] : null);
            $_POST['mobilePhone'] = (isset($_POST['grdMobilePhone']) ? $_POST['grdMobilePhone'] : null);
            $_POST['homePhone'] = (isset($_POST['grdHomePhone']) ? $_POST['grdHomePhone'] : null);
            
            $guardian = new Guardian($_POST);
            if ($_POST['grdAddress'])
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
            $guardian = assignGuardian($guardian);
            
            if ($guardian->guardianID != $patient->guardian)
            {
                update("patients", "patientID", $patient->patientID, "guardian", $guardian->guardianID);
            }
            break;
    }
    
    header ("refresh:0; url=patients_view_details.php?fileID="
        . $file->fileID . (isset($change) ? "&change=" . $change : ""));
?>