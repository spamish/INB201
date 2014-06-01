<div id="header">
    <div style="float:left;">

        <h1>Townsville Outskirts Universal Children's Hospital</h1>
    </div>
    <div id="headerFunctions" style="float: right;">
        <?php
            if (   !strpos($_SERVER['PHP_SELF'], "index")
                && !strpos($_SERVER['PHP_SELF'], "redirect"))
            { ?>
                <a id="btnSubmit" href="/inb201/index.php">Logout</a><br>
                <a id="btnSubmit" href="/inb201/change_password.php">Change Password</a><br>
        <?php } ?>
    </div>
</div><!-- end #header -->
