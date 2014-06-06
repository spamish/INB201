<?php
    require('../includes/start_session.php');
    require('../includes/doc_functions.php');
    require('../includes/functions.php');
    
    $note = new Note($_POST);
    $note->type = "post-op";
    $note->staff = $_SESSION['login'];
    $note->timestamp = new DateTime();
    
    createNote($note);
    
    header ("refresh:0; url=patients_view_details.php?fileID=" . $file->fileID);
?>