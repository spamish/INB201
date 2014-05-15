<div id="sidebar">
    <?php
        if ( strpos($_SERVER["PHP_SELF"], "home")
            || strpos($_SERVER["PHP_SELF"], "password")
            || strpos($_SERVER["PHP_SELF"], "template"))
        {
            $append = "";
        }
        else
        {
            $append = "../";
        }
        switch ($_SESSION['position']) {
            case "doctor": //Display links if user has doctors access.
                echo '<a id="btnSidebar" href="/inb201/home.php">Home</a>';
                include($append . 'doctor/doc_links.php');
                break;
            
            case "surgeon": //Display links if user has surgeon access.
                echo '<a id="btnSidebar" href="/inb201/home.php">Home</a>';
                include($append . 'surgeon/surg_links.php');
                break;
            
            case "nurse": //Display links if user has nurses access.
                echo '<a id="btnSidebar" href="/inb201/home.php">Home</a>';
                include($append . 'nurse/nurse_links.php');
                break;
            
            case "receptionist": //Display links if user has receptionist access.
                echo '<a id="btnSidebar" href="/inb201/home.php">Home</a>';
                include($append . 'receptionist/recep_links.php');
                break;
            
            case "technician": //Display links if user has medical technician access.
                echo '<a id="btnSidebar" href="/inb201/home.php">Home</a>';
                include($append . 'technician/tech_links.php');
                break;
            
            case "administrator": //Display links if user has system administrator access.
                echo '<a id="btnSidebar" href="/inb201/home.php">Home</a>';
                include($append . 'administrator/admin_links.php');
                break;
            
            default: break; //Display no links unless authorised.
        }
    ?>
</div> <!-- end #sidebar -->
