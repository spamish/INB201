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
            case "doctor": //Display links if user has doctors access. ?>
                <a id="btnSidebar" href="/inb201/home.php">Home</a>
                <a id="btnSidebar" href="/inb201/"></a>
                <?php break;
            
            case "nurse": //Display links if user has nurses access. ?>
                <a id="btnSidebar" href="/inb201/home.php">Home</a>
                <a id="btnSidebar" href="/inb201/"></a>
                <?php break;
            
            case "receptionist": //Display links if user has receptionist access. ?>
                <a id="btnSidebar" href="/inb201/home.php">Home</a>
                <a id="btnSidebar" href="/inb201/"></a>
                <?php break;
            
            case "technician": //Display links if user has medical technician access. ?>
                <a id="btnSidebar" href="/inb201/home.php">Home</a>
                <a id="btnSidebar" href="/inb201/"></a>
                <?php break;
            
            case "administrator": //Display links if user has system administrator access. ?>
                <a id="btnSidebar" href="/inb201/home.php">Home</a><br>
                <?php include($append . 'admin/admin_links.php');
                break;
            
            default: break; //Display no links unless authorised.
        }
    ?>
</div> <!-- end #sidebar -->
