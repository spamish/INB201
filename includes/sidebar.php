<div id="sidebar">
    <?php
        switch ($_SERVER["PHP_SELF"]) {
            case "/inb201/home.php"; //If in the root directory.
                $append = "";
                break;
            
            default: //If in a folder.
                $append = "../";
                break;
        }
        
        switch ($_SESSION['role']) {
            case "doctor": //Display links if user has doctors access. ?>
                
                <a href="<?php echo $append . "home.php"?>"
                    id="btnPageActions">Home</a>
                
                <a href="<?php echo $append . "/"?>"
                    id="btnPageActions"></a>
                
                <?php break;
            
            case "nurse": //Display links if user has nurses access. ?>
                
                <a href="<?php echo $append . "home.php"?>"
                    id="btnPageActions">Home</a>
                
                <a href="<?php echo $append . "/"?>"
                    id="btnPageActions"></a>
                
                <?php break;
            
            case "receptionist": //Display links if user has receptionist access. ?>
                
                <a href="<?php echo $append . "home.php"?>"
                    id="btnPageActions">Home</a>
                
                <a href="<?php echo $append . "/"?>"
                    id="btnPageActions"></a>
                
                <?php break;
            
            case "technician": //Display links if user has medical technician access. ?>
                
                <a href="<?php echo $append . "home.php"?>"
                    id="btnPageActions">Home</a>
                
                <a href="<?php echo $append . "/"?>"
                    id="btnPageActions"></a>
                
                <?php break;
            
            case "administrator": //Display links if user has system administrator access. ?>
                <a href="<?php echo $append . "home.php"?>"
                    id="btnPageActions">Home</a><br>
                <a href="<?php echo $append . "admin/staff_view.php"?>"
                    id="btnPageActions">Staff</a><br>
                <a href="<?php echo $append . "admin/procedure_view.php"?>"
                    id="btnPageActions">Procedures</a><br>
                <a href="<?php echo $append . "admin/facility_view.php"?>"
                    id="btnPageActions">Facilities</a><br>
                <a href="<?php echo $append . "admin/insurance_view.php"?>"
                    id="btnPageActions">Insurance</a><br>
                <a href="<?php echo $append . "admin/log_view.php"?>"
                    id="btnPageActions">Logs and Reports</a><br>
                <?php break;
            
            default: break; //Display no links unless authorised.
        }
    ?>
</div> <!-- end #sidebar -->
