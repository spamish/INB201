<div id="header">
    <div style="float:left;">
        <h1>Townsville Outskirts Universal Children's Hospital</h1>
    </div>
    <div id="headerFunctions">
        <?php
            if (   !strpos($_SERVER['PHP_SELF'], "index")
                && !strpos($_SERVER['PHP_SELF'], "redirect"))
            { ?>
                <a id="btnHeader" href="/inb201/index.php" id="btnHeading">Logout</a><br>
                <a id="btnHeader" href="/inb201/change_password.php" id="btnHeading">Change Password</a><br>
            <?php }
            echo $_SERVER['SERVER_NAME'];
            echo "<br>";
            echo $_SERVER['PHP_SELF'];
        ?>
    </div>
</div><!-- end #header -->
