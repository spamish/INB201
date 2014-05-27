<?php
    if ($_SESSION['ward'])
    { ?>
        <a id="btnSidebar" href="/inb201/doctor/next_patient.php">Next Patient</a>
    <?php }
?>

<a id="btnSidebar" href="/inb201/doctor/patients_view.php?staffID=<?php echo $_SESSION['login'] ?>">My Patients</a>
<a id="btnPageActions" href="/inb201/doctor/patients_search.php?staffID=<?php echo $_SESSION['login'] ?>" style="margin-left:10px;">Search</a>

<a id="btnSidebar" href="/inb201/doctor/patients_view.php">Current Patients</a>
<a id="btnPageActions" href="/inb201/doctor/patients_search.php" style="margin-left:10px;">Search</a>