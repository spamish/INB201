<a href="<?php echo $append . "admin/staff_view.php"?>"
    id="btnSidebar">Staff</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "staff")) { ?>
    <a href="staff_add.php" id="btnPageActions" style="margin-left:10px;">Add Staff</a><br>
    <a href="staff_view.php" id="btnPageActions" style="margin-left:10px;">Edit Staff</a><br>
<?php } ?>

<a href="<?php echo $append . "admin/procedure_view.php"?>"
    id="btnSidebar">Procedures</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "procedure")) { ?>
    <a href="" id="btnPageActions" style="margin-left:10px;">F1</a><br>
<?php } ?>

<a href="<?php echo $append . "admin/facility_view.php"?>"
    id="btnSidebar">Facilities</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "facility")) { ?>
    <a href="" id="btnPageActions" style="margin-left:10px;">F1</a><br>
<?php } ?>

<a href="<?php echo $append . "admin/insurance_view.php"?>"
    id="btnSidebar">Insurance</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "insurance")) { ?>
    <a href="" id="btnPageActions" style="margin-left:10px;">F1</a><br>
<?php } ?>

<a href="<?php echo $append . "admin/log_view.php"?>"
    id="btnSidebar">Logs and Reports</a><br>

<?php if (strpos($_SERVER["PHP_SELF"], "log")) { ?>
    <a href="" id="btnPageActions" style="margin-left:10px;">F1</a><br>
<?php } ?>

<a href=""
    id="btnSidebar">Export Salaries</a><br>

<?php /*if (strpos($_SERVER["PHP_SELF"], "")) { ?>
    <a href="" id="btnPageActions" style="margin-left:10px;">F1</a><br>
<?php }*/ ?>
