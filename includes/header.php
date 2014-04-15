<div id="header">
    <div style="float:left;">
        <h1>Townsville Outskirts Universal Children's Hospital</h1>
    </div>
    <div style="float:right;">
        <?php
            if (   !strpos($_SERVER['PHP_SELF'], "index")
                && !strpos($_SERVER['PHP_SELF'], "redirect"))
            {
                if (   strpos($_SERVER['PHP_SELF'], "home")
                    || strpos($_SERVER['PHP_SELF'], "password")
                    || strpos($_SERVER['PHP_SELF'], "template"))
                { ?>
                    <a href="index.php" class="btnHeading">Logout</a><br>
                    <a href="change_password.php" id="btnHeading">Change Password</a><br>
                <?php }
                else
                { ?>
                    <a href="../index.php" class="btnHeading">Logout</a><br>
                    <a href="../change_password.php" id="btnHeading">Change Password</a><br>
                <?php } ?>
            <?php }
        ?>
    </div>
</div><!-- end #header -->
