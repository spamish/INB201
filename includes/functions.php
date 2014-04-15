<?php
    $dbName = "inb201project";
    $dbUser = "teamtouch";
    $dbPassword = "JFQQ4v2rXs";

    if (   strpos($_SERVER["PHP_SELF"], "home")
        || strpos($_SERVER["PHP_SELF"], "index")
        || strpos($_SERVER["PHP_SELF"], "redirect"))
    {
        include('lib/password.php');
    }
    else
    {
        include('../lib/password.php');
    }
    
    function login($username, $password)
    {
        global $dbName, $dbUser, $dbPassword;
        $con = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
        $query = $con -> prepare("
            SELECT username, hash
            FROM employeeinfo
            WHERE username = '$username'
        ");
        $query -> bindValue(':username', $username);
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);
        
        $hash = $result[0]['hash'];
        return password_verify($password, $hash);
    }
    
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
    
    function employeeInfosId($id)
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
            VALUES ('1', '$username', '$firstName', '$surname', '$dateOfBirth', '$phoneNumber', '$payGrade', '$position', '$ward', '$hash')
        ");
    }
?>
