<?php
  $servername = "localhost";
  $DBusername = "root";
  $DBpassword = "";
  $DBname = "mail_db";
  $username=$_POST["username"];
  $password=$_POST["password"];


  $pdo = new PDO("mysql:host=$servername;dbname=$DBname", $DBusername, $DBpassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT id,token FROM users WHERE username = '$username' AND password = '$password'";
  $stmt = $pdo->query($sql);
  if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(pdo::FETCH_ASSOC)) {
        $user = $row;
    }
    echo json_encode($user);
  } else {
        echo "login failed";
  }



?>