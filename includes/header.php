<div id="header">
	<h1>Townsville Outskirts Universal Children's Hospital</h1>
    
    <?php
        switch ($_SESSION['layer']) {
            case 0; ?>
                <a href="index.php" class="btnLogout">Logout</a>
                <?php break;
                
            case 1; ?>
                <a href="../index.php" class="btnLogout">Logout</a>
                <?php break;
            
            default: break;
        }
        
        echo $_SERVER['PHP_SELF'];
    ?>
</div><!-- end #header -->
