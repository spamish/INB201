<?php
    $_SESSION['position'] = isset($_GET['position']) ? $_GET['position'] : $_SESSION['position'];
    $_SESSION['ward'] = isset($_GET['ward']) ? $_GET['ward'] : $_SESSION['ward'];
?>
<form action="/inb201/home.php" method="get">
    <select name="position" style="width:70px;">
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
            <?php }
        ?>
    </select>
    <select name="ward" style="width:30px;">
        <?php
            if ($_SESSION['ward'] == 'A')
            { ?>
                <option value="A" selected>A</option>
            <?php }
            else
            { ?>
                <option value="A">A</option>
            <?php }
            
            if ($_SESSION['ward'] == 'B')
            { ?>
                <option value="B" selected>B</option>
            <?php }
            else
            { ?>
                <option value="B">B</option>
            <?php }
            
            if ($_SESSION['ward'] == 'C')
            { ?>
                <option value="C" selected>C</option>
            <?php }
            else
            { ?>
                <option value="C">C</option>
            <?php }
            
            if ($_SESSION['ward'] == 'D')
            { ?>
                <option value="D" selected>D</option>
            <?php }
            else
            { ?>
                <option value="D">D</option>
            <?php }
            
            if ($_SESSION['ward'] == 'E')
            { ?>
                <option value="E" selected>E</option>
            <?php }
            else
            { ?>
                <option value="E">E</option>
            <?php }
            if ($_SESSION['ward'] == 'F')
            { ?>
                <option value="F" selected>F</option>
            <?php }
            else
            { ?>
                <option value="F">F</option>
            <?php }
            if ($_SESSION['ward'] == 'G')
            { ?>
                <option value="G" selected>G</option>
            <?php }
            else
            { ?>
                <option value="G">G</option>
            <?php }
        ?>
    </select>
    <input id="btnSubmit" type="submit" name="submit" value="Go"/>
</form>