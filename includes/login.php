<?php
    include('lib/password.php');
    
    function login($email, $password)
    {
        $con = new PDO("mysql:host=localhost;dbname=inb201", "inb201", "password");
        $query = $con -> prepare("
            SELECT email, hash
            FROM login
            WHERE email = '$email'
        ");
        $query -> bindValue(':email', $email);
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);
        
        $hash = $result[0]['hash'];
        return password_verify($password, $hash);
    }
    
    function id($email)
    {
        $con = new PDO("mysql:host=localhost;dbname=inb201", "inb201", "password");
        $query = $con -> prepare("
            SELECT email, id
            FROM login
            WHERE email = '$email'
        ");
        $query -> bindValue(':email', $email);
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);

        return $result[0]['id'];
    }
    
    function firstname($email)
    {
        $con = new PDO("mysql:host=localhost;dbname=inb201", "inb201", "password");
        $query = $con -> prepare("
            SELECT email, firstname
            FROM login
            WHERE email = '$email'
        ");
        $query -> bindValue(':email', $email);
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);

        return $result[0]['firstname'];
    }
    
    function surname($email)
    {
        $con = new PDO("mysql:host=localhost;dbname=inb201", "inb201", "password");
        $query = $con -> prepare("
            SELECT email, surname
            FROM login
            WHERE email = '$email'
        ");
        $query -> bindValue(':email', $email);
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);

        return $result[0]['surname'];
    }
    
    function role($email){
        $con = new PDO("mysql:host=localhost;dbname=inb201", "inb201", "password");
        $query = $con -> prepare("
            SELECT email, role
            FROM login
            WHERE email = '$email'
        ");
        $query -> bindValue(':email', $email);
        $query -> execute();

        $result = $query -> fetchAll();
        $rows = count($result, 0);

        return $result[0]['role'];
    }
?>
