<?php
    $_SESSION['position'] = isset($_GET['position']) ? $_GET['position'] : $_SESSION['position'];
?>
<form action="/inb201/home.php" method="get">
    <select name="position" style="width:90px;">
        <?php
            if ($_SESSION['position'] == 'inactive')
            { ?>
                <option value="inactive" selected>Inactive</option>
            <?php }
            else
            { ?>
                <option value="inactive">Inactive</option>
            <?php }
            
            if ($_SESSION['position'] == 'doctor')
            { ?>
                <option value="doctor" selected>Doctor</option>
            <?php }
            else
            { ?>
                <option value="doctor">Doctor</option>
            <?php }
            
            if ($_SESSION['position'] == 'nurse')
            { ?>
                <option value="nurse" selected>Nurse</option>
            <?php }
            else
            { ?>
                <option value="nurse">Nurse</option>
            <?php }
            
            if ($_SESSION['position'] == 'receptionist')
            { ?>
                <option value="receptionist" selected>Receptionist</option>
            <?php }
            else
            { ?>
                <option value="receptionist">Receptionist</option>
            <?php }
            
            if ($_SESSION['position'] == 'technician')
            { ?>
                <option value="technician" selected>Medical Technician</option>
            <?php }
            else
            { ?>
                <option value="technician">Medical Technician</option>
            <?php }
            if ($_SESSION['position'] == 'administrator')
            { ?>
                <option value="administrator" selected>System Administrator</option>
            <?php }
            else
            { ?>
                <option value="administrator">System Administrator</option>
        <?php
            } ?>
    </select>
    <input id="btnSubmit" type="submit" name="submit" value="Go"/>
</form>