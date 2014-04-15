<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    session_start();
    include('../includes/functions.php');
    echo $id = $_POST['edit'] + 1;
    $employee = employeeInfoId($id);
    $username = $employee[0][1];
    $firstName = $employee[0][2];
    $surname = $employee[0][3];
    $dateOfBirth = $employee[0][4];
    $phoneNumber = $employee[0][5];
    $payGrade = $employee[0][6];
    $position = $employee[0][7];
    $ward = $employee[0][8];
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
        <title>T.O.U.C.H. Online System</title>
    </head>

    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <?php include('../includes/sidebar.php'); ?>

            <div id="content"> <!-- All content goes here -->
                <h2>Edit Staff</h2>
                <form action="staff_edit_confirm.php" method="post" style="float:left;width=50%;">
                    <table>
                        <tr>
                            <td align="right">Username</td>
                            <td align="left">
                                <input type="text" name="username"
                                    required value="<?php echo $username ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">First Name</td>
                            <td align="left">
                                <input type="text" name="firstName"
                                    required value="<?php echo $firstName ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Surname</td>
                            <td align="left">
                                <input type="text" name="surname"
                                    required value="<?php echo $surname ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Date of Birth</td>
                            <td align="left">
                                <input type="date" name="dateOfBirth"
                                    required value="<?php echo $dateOfBirth ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Phone Number</td>
                            <td align="left">
                                <input type="text" name="phoneNumber"
                                    value="<?php echo $phoneNumber ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Pay Grade</td>
                            <td align="right"><select name="payGrade">
                                <?php if ($payGrade == 'A') { ?>
                                    <option value="A" selected>A</option>
                                <?php } else { ?>
                                    <option value="A">A</option>
                                <?php }
                                if ($payGrade == 'B') { ?>
                                    <option value="B" selected>B</option>
                                <?php } else { ?>
                                    <option value="B">B</option>
                                <?php }
                                if ($payGrade == 'C') { ?>
                                    <option value="C" selected>C</option>
                                <?php } else { ?>
                                    <option value="C">C</option>
                                <?php }
                                if ($payGrade == 'D') { ?>
                                    <option value="D" selected>D</option>
                                <?php } else { ?>
                                    <option value="D">D</option>
                                <?php }
                                if ($payGrade == 'E') { ?>
                                    <option value="E" selected>E</option>
                                <?php } else { ?>
                                    <option value="E">E</option>
                                <?php } ?>
                            </select></td>
                            <td align="right">Ward</td>
                        </tr>
                        <tr>
                            <td align="right">Position</td>
                            <td align="left"><select name="position">
                                <?php if ($position == 'inactive') { ?>
                                    <option value="inactive" selected>Inactive</option>
                                <?php } else { ?>
                                    <option value="inactive">Inactive</option>
                                <?php }
                                if ($position == 'doctor') { ?>
                                    <option value="doctor" selected>Doctor</option>
                                <?php } else { ?>
                                    <option value="doctor">Doctor</option>
                                <?php }
                                if ($position == 'nurse') { ?>
                                    <option value="nurse" selected>Nurse</option>
                                <?php } else { ?>
                                    <option value="nurse">Nurse</option>
                                <?php }
                                if ($position == 'receptionist') { ?>
                                    <option value="receptionist" selected>Receptionist</option>
                                <?php } else { ?>
                                    <option value="receptionist">Receptionist</option>
                                <?php }
                                if ($position == 'technician') { ?>
                                    <option value="technician" selected>Medical Technician</option>
                                <?php } else { ?>
                                    <option value="technician">Medical Technician</option>
                                <?php }
                                if ($position == 'administrator') { ?>
                                    <option value="administrator" selected>System Administrator</option>
                                <?php } else { ?>
                                    <option value="administrator">System Administrator</option>
                                <?php } ?>
                            </select></td>
                            <td align="right"><select name="ward">
                                <?php if ($ward == 'A') { ?>
                                    <option value="A" selected>A</option>
                                <?php } else { ?>
                                    <option value="A">A</option>
                                <?php }
                                if ($ward == 'B') { ?>
                                    <option value="B" selected>B</option>
                                <?php } else { ?>
                                    <option value="B">B</option>
                                <?php }
                                if ($ward == 'C') { ?>
                                    <option value="C" selected>C</option>
                                <?php } else { ?>
                                    <option value="C">C</option>
                                <?php }
                                if ($ward == 'D') { ?>
                                    <option value="D" selected>D</option>
                                <?php } else { ?>
                                    <option value="D">D</option>
                                <?php }
                                if ($ward == 'E') { ?>
                                    <option value="E" selected>E</option>
                                <?php } else { ?>
                                    <option value="E">E</option>
                                <?php }
                                if ($ward == 'F') { ?>
                                    <option value="F" selected>F</option>
                                <?php } else { ?>
                                    <option value="F">F</option>
                                <?php } ?>
                            </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="left">
                                <input type="submit" value="Save">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </td>
                        </tr>
                    </table>
                </form>
            </div> <!-- end #content -->
            
            <?php include('../includes/footer.php'); ?>
        </div> <!-- End #wrapper -->
    </body>
</html>
