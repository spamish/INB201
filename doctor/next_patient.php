<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    $queue;
    $now = new DateTime();
    $file = new File();
    $file->discharge = "NULL";
    $file->doctor = "NULL";
    $result = viewTable("files", $file);
    
    for ($i = 1; $i <= ($queue[0] = $result[0]); $i++)
    {
        $file = new File($result[$i]);
        
        $interval = $file->admission->diff($now);
        $interval = new DateTime($interval->format('%Y-%M-%D %H:%I:%S'));
        
        $queue[] = array(($interval->getTimestamp() * $file->state), $file->fileID);
    }
    rsort($queue);
    
    $file = new File();
    $file->fileID = $queue[0][1];
    
    updateFile($file, "doctor", $_SESSION['login']);
    
    $date = new DateTime();
    $note = new Note();
    $note->file = $file->fileID;
    $note->type = "transfer";
    $note->staff = $_SESSION['login'];
    $note->timestamp = $date->format('Y-m-d h:i:s');
    $note->details = "Patient assigned to " . $_SESSION['firstName'] . " " . $_SESSION['surname'];
    createNote($note);
    
    header ("refresh:0; url=patients_view_details.php?fileID=" . $file->fileID);
?>