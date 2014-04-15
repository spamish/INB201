<div id="sidebar">
    <?php
        if (   strpos($_SERVER["PHP_SELF"], "home")
            || strpos($_SERVER["PHP_SELF"], "password"))
        {
            $append = "";
        }
        else
        {
            $append = "../";
        }
        
        switch ($_SESSION['position']) {
            case "doctor": //Display links if user has doctors access. ?>
                
                <a href="<?php echo $append . "home.php"?>"
                    id="btnSidebar">Home</a>
                
                <a href="<?php echo $append . "/"?>"
                    id="btnSidebar"></a>
                
                <?php break;
            
            case "nurse": //Display links if user has nurses access. ?>
                
                <a href="<?php echo $append . "home.php"?>"
                    id="btnSidebar">Home</a>
                
                <a href="<?php echo $append . "/"?>"
                    id="btnSidebar"></a>
                
                <?php break;
            
            case "receptionist": //Display links if user has receptionist access. ?>
                
                <a href="<?php echo $append . "home.php"?>"
                    id="btnSidebar">Home</a>
                
                <a href="<?php echo $append . "/"?>"
                    id="btnSidebar"></a>
                
                <?php break;
            
            case "technician": //Display links if user has medical technician access. ?>
                
                <a href="<?php echo $append . "home.php"?>"
                    id="btnSidebar">Home</a>
                
                <a href="<?php echo $append . "/"?>"
                    id="btnSidebar"></a>
                
                <?php break;
            
            case "administrator": //Display links if user has system administrator access. ?>
            
                <a href="<?php echo $append . "home.php"?>"
                    id="btnSidebar">Home</a><br>
                <?php include($append . 'admin/admin_links.php');
                break;
            
            default: break; //Display no links unless authorised.
        }
    ?>
</div> <!-- end #sidebar -->
