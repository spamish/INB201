<div id="pageActions">
    <?php
        switch ($_SESSION['role']) {
            case "doctor": //Display links if user has doctors access.
                $append .= home.php; ?>
                <a href="$append" id="btnPageActions">Doctor 2</a>
                <?php break;
            
            case "nurse": //Display links if user has nurses access.
                if (basename($_SERVER["PHP_SELF"]) == "home.php") {;?>
                    <a href="home.php" id="btnPageActions">Nurse 2</a>
                <?php } else { ?>
                    <a href="../home.php" id="btnPageActions">Nurse 2</a>
                <?php }
                break;
            
            case "receptionist": //Display links if user has receptionist access.
                if (basename($_SERVER["PHP_SELF"]) == "home.php") {;?>
                    <a href="home.php" id="btnPageActions">Reception 2</a>
                <?php } else { ?>
                    <a href="../home.php" id="btnPageActions">Reception 2</a>
                <?php }
                break;
            
            case "technician": //Display links if user has medical technician access.
                if (basename($_SERVER["PHP_SELF"]) == "home.php") {;?>
                    <a href="home.php" id="btnPageActions">Technician 3</a>
                <?php } else { ?>
                    <a href="../home.php" id="btnPageActions">Technician 3</a>
                <?php }
                break;
            
            case "administrator": //Display links if user has system administrator access.
                switch ($_SESSION['layer']) {
                    case 1: ?>
                        <a href="staff_add.php" id="btnPageActions">Add Staff</a>
                        <a href="staff_view.php" id="btnPageActions">Edit Staff</a>
                        <?php break;
                    
                    case 2: ?>
                        <a href="staff_view.php" id="btnPageActions">Cancel</a>
                        <?php break;
                    
                    default: break;
                }
                break;
            
            default: break; //Display no links unless authorised.
        }
    ?>
</div> <!-- end #functions -->
