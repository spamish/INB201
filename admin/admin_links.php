<a id="btnSidebar" href="/inb201/admin/staff_view.php">Staff</a>

<?php if (strpos($_SERVER["PHP_SELF"], "staff"))
{ ?>
    <a id="btnPageActions" href="/inb201/admin/staff_add.php"
        style="margin-left:10px;">Add</a>
<?php } ?>

<a id="btnSidebar" href="/inb201/admin/salaries_view.php">Salaries</a>

<?php if (strpos($_SERVER["PHP_SELF"], "salaries"))
{ ?>
    <a id="btnPageActions" href="/inb201/admin/salary_add.php"
        style="margin-left:10px;">Add</a><br>
<?php } ?>

<a id="btnSidebar" href="/inb201/admin/room_view.php">Rooms</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "room"))
{ ?>
    <a id="btnPageActions" href="/inb201/admin/room_add.php"
        style="margin-left:10px;">Add</a><br>
<?php } ?>

<a id="btnSidebar" href="/inb201/admin/theater_view.php">Theaters</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "theater"))
{ ?>
    <a id="btnPageActions" href="/inb201/admin/theater_add.php"
        style="margin-left:10px;">Add</a><br>
    <a id="btnPageActions" href="/inb201/admin/theater_procedure_view.php"
        style="margin-left:10px;">Procedures</a><br>

    <?php if (strpos($_SERVER["PHP_SELF"], "procedure"))
    { ?>
        <a id="btnPageActions" href="/inb201/admin/theater_procedure_add.php"
            style="margin-left:15px;">Add</a><br>
    <?php } ?>
<?php } ?>

<a id="btnSidebar" href="/inb201/admin/equipment_view.php">Equipment</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "equipment"))
{ ?>
    <a id="btnPageActions" href="/inb201/admin/equipment_add.php"
        style="margin-left:10px;">Add</a><br>
<?php } ?>

<a id="btnSidebar" href="/inb201/admin/insurance_view.php">Insurance</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "insurance"))
{ ?>
    <a id="btnPageActions" href="/inb201/admin/insurance_add.php"
        style="margin-left:10px;">Add</a><br>
<?php } ?>

<a id="btnSidebar" href="/inb201/admin/logs_view.php">Logs &amp Reports</a><br>


<?php /* Template for adding staff functions.
    <a id="btnSidebar" href="/inb201/admin/[function_view].php">[View Function]</a><br>

    <?php if (strpos($_SERVER["PHP_SELF"], "[function]"))
    { ?>
        <a href="/inb201/admin/[function_subfunction].php" id="btnPageActions"
            style="margin-left:10px;">[Perform Subfunction]</a><br>
    <?php } ?>
*/ ?>
