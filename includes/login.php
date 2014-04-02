<?php function login($username, $password) {
    $con = new PDO("mysql:host=localhost;dbname=inb201","inb201","password");
    $query = $con->prepare("SELECT username, password
        FROM login WHERE username = '$username'");
    $query->bindValue(':username', $username);
    $query->bindValue(':password', $password);
    $query->execute();

    $result = $query->fetchAll();
    $rows = count($result,0);

    if($result[0]['password'] == $password) {
        return 1;
    }
    return 0;
}
function id($username) {
    $con = new PDO("mysql:host=localhost;dbname=inb201","inb201","password");
    $query = $con->prepare("SELECT username, id
        FROM login WHERE username = '$username'");
    $query->bindValue(':username', $username);
    $query->execute();

    $result = $query->fetchAll();
    $rows = count($result,0);

    return $result[0]['id'];
}
function firstname($username) {
    $con = new PDO("mysql:host=localhost;dbname=inb201","inb201","password");
    $query = $con->prepare("SELECT username, firstname
        FROM login WHERE username = '$username'");
    $query->bindValue(':username', $username);
    $query->execute();

    $result = $query->fetchAll();
    $rows = count($result,0);

    return $result[0]['firstname'];
}
function surname($username) {
    $con = new PDO("mysql:host=localhost;dbname=inb201","inb201","password");
    $query = $con->prepare("SELECT username, surname
        FROM login WHERE username = '$username'");
    $query->bindValue(':username', $username);
    $query->execute();

    $result = $query->fetchAll();
    $rows = count($result,0);

    return $result[0]['surname'];
}
function role($username) {
    $con = new PDO("mysql:host=localhost;dbname=inb201","inb201","password");
    $query = $con->prepare("SELECT username, role
        FROM login WHERE username = '$username'");
    $query->bindValue(':username', $username);
    $query->execute();

    $result = $query->fetchAll();
    $rows = count($result,0);

    return $result[0]['role'];
} ?>