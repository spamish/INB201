<?php
    $dbName = "inb201project";
    $dbUser = "teamtouch";
    $dbPassword = "JFQQ4v2rXs";
    
    function tally()
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con -> prepare("
            SELECT * FROM employeeinfo
        ");
        $query -> execute();

        return count($query -> fetchAll());
    }

    function staff()
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con -> prepare("
            SELECT username, firstName, surname, dateOfBirth, phoneNumber, payGrade, position, ward
            FROM employeeinfo
        ");
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);

        return $result;
    }
    
    function checkIfExists($username)
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con -> prepare("
            SELECT count(1)
            FROM employeeinfo
            WHERE username = '$username'
        ");
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);
        
        if ($result[0])
        {
            return 0;
        }
        return 1;
    }
    
    function employeeInfoUsername($username)
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con -> prepare("
            SELECT id, username, firstName, surname, dateOfBirth, phoneNumber, payGrade, position, ward
            FROM employeeinfo
            WHERE username = '$username'
        ");
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);

        return $result[0];
    }
    
    function employeeInfoId($id)
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con -> prepare("
            SELECT id, username, firstName, surname, dateOfBirth, phoneNumber, payGrade, position, ward
            FROM employeeinfo
            WHERE id = '$id'
        ");
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);

        return $result;
    }
    
    function createStaff($username, $firstName, $surname, $dateOfBirth, $phoneNumber, $payGrade, $position, $ward, $hash)
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con->query("
            INSERT INTO employeeinfo (username, firstName, surname, dateOfBirth, phoneNumber, payGrade, position, ward, hash)
            VALUES ('$username', '$firstName', '$surname', '$dateOfBirth', '$phoneNumber', '$payGrade', '$position', '$ward', '$hash')
        ");
    }
    
    function editStaff($id, $username, $firstName, $surname, $dateOfBirth, $phoneNumber, $payGrade, $position, $ward)
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con->query("
            UPDATE employeeinfo
            SET username='$username',
                firstName='$firstName',
                surname='$surname',
                dateOfBirth='$dateOfBirth',
                phoneNumber='$phoneNumber',
                payGrade='$payGrade',
                position='$position',
                ward='$ward'
            WHERE id='$id'
        ");
        $query->bindValue(':id', $id);
        $query->execute();
    }
?>
