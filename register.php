<?php

$servername = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "mail_db";

$username = $_POST['username'];
$password = $_POST['password'];
$pdo = new PDO("mysql:host=$servername;dbname=$DBname", $DBusername,$DBpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$usernamecheck = $pdo->query("SELECT `username` FROM `users` WHERE username='$username'");
while ($row = $usernamecheck->fetch(pdo::FETCH_ASSOC)) {
    $usernames[]= $row;
}
if(isset($usernames)){
    echo $username." is already taken";
  }else{

try {
    
    $token = "qpalzmnxskwoeidjcnbvhfurgyt5876439021";
    $token = str_shuffle($token);
    $token = substr($token, 0, 10);
    $sql = "INSERT INTO users VALUES (NULL,'$username', '$password','$token')";
    $pdo->exec($sql);
    echo "New record created successfully";
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
  }

  ?>