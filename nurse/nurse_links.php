<a id="btnSidebar" href="">Option A</a>

<?php if (strpos($_SERVER["PHP_SELF"], "."))
{ ?>
    <a id="btnPageActions" href=""
        style="margin-left:10px;">Sub-option</a>
<?php } ?>

<a id="btnSidebar" href="">Option B</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "."))
{ ?>
    <a id="btnPageActions" href=""
        style="margin-left:10px;">Sub-option</a><br>
<?php } ?>

<a id="btnSidebar" href="">Option C</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "."))
{ ?>
    <a id="btnPageActions" href=""
        style="margin-left:10px;">Sub-option</a><br>
<?php } ?>
