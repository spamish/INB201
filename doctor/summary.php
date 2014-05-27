<?php
    require('../includes/start_session.php');
    require('../includes/functions.php');
    
    switch ($_POST['function'])
    {
        case "note":
            $note = new Note($_POST);
            $note->type = "note";
            $note->staff = $_SESSION['login'];
            $note->timestamp = new DateTime();
            
            createNote($note);
            
            //header ("refresh:0; url=patients_view_details.php?fileID=" . $note->file);
            exit;
        
        case "order":
            
            exit;
        
        case "test":
            
            exit;
        
        case "operation":
            
            exit;
    }
?>