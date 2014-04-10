<?php
    function tally()
    {
        $con = new PDO("mysql:host=localhost;dbname=inb201", "inb201", "password");
        $query = $con -> prepare("
            SELECT * FROM login
        ");
        $query -> execute();

        return count($query -> fetchAll());
    }

    function staff()
    {
        $con = new PDO("mysql:host=localhost;dbname=inb201", "inb201", "password");
        $query = $con -> prepare("
            SELECT email, firstname, surname, role
            FROM login
        ");
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);

        return $result;
    }
    
    function createStaff($email, $firstname, $surname, $role, $hash)
    {
        $con = new PDO("mysql:host=localhost;dbname=inb201", "inb201", "password");
        $query = $con -> query("
            INSERT INTO login(email,firstname,surname,role,hash)
            VALUES ('$email', '$firstname', '$surname', '$role', '$hash')
        ");
    }
?>
