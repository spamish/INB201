<?php
    function login($username, $password) {
		$con = new PDO("mysql:host=localhost;dbname=inb201","inb201","");
		$query = $con->prepare("SELECT username, password FROM login WHERE username = '$username'");
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
?>