<?php
    require('../includes/start_session.php');
    require('../includes/doc_functions.php');
    require('../includes/functions.php');
    
    $note = new Note($_POST);
    $note->timestamp = new DateTime();
    
    $check = true;
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    
    $records = viewTable("notes");
    
    $fileName = ($records[0] + 1) . "." . $extension;
    
    if (exif_imagetype ($_FILES["file"]["tmp_name"]))
    {
        if (is_uploaded_file($_FILES["file"]["tmp_name"]))
        {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], ("../results/" . $fileName)))
            {
                $note->details .= "<br>Results have been uploaded to "
                    . "<a href=\"http://107.170.200.157/inb201/results/" . $fileName
                    . "\">Results</a> at " . $note->timestamp->format('jS M Y')
                    . " on " . $note->timestamp->format('h:ia');
            }
            else
            {
                $_SESSION['error'] = "Unsuccessful moving of file.";
                $check = false;
            }
        }
        else
        {
            $_SESSION['error'] = "Unsuccessful upload of file.";
            $check = false;
        }
    }
    else
    {
        $_SESSION['error'] = "Incorrect file type.";
        $check = false;
    }
    if (isset($_SESSION['error']))
    {
        echo $_SESSION['error'];
    }
    
    if($check)
    {
        $note->type = "results";
        $note->staff = $_SESSION['login'];
        
        createNote($note);
    }
    else
    {
        header ("refresh:0; url=add_results.php?fileID=" . $file->fileID);
    }
    
    header ("refresh:0; url=patients_view_details.php?fileID=" . $file->fileID);
?>