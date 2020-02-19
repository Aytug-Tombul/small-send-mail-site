<?php

$post = $_POST['post'];
$token= $_POST['token'];
$sended= $_POST['sendedUser'];


$servername = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "mail_db";
$pdo = new PDO("mysql:host=$servername;dbname=$DBname", $DBusername, $DBpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT token,username FROM users WHERE username = '$sended'";
$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    try{
        $pdo1 = new PDO("mysql:host=$servername;dbname=$DBname", $DBusername, $DBpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        while ($row = $stmt->fetch(pdo::FETCH_ASSOC)) {
            $sendedtoken= $row["token"];
            $sendedUser= $row["username"];
            
        }
        $sql2 = "INSERT INTO mail_tbl VALUES (NULL,'$post','$token','$sendedtoken','$sendedUser')";
        $pdo1->query($sql2);
        echo "mail sended";
            
        }catch (PDOException $e) {
            echo $sql2 . "<br>" . $e->getMessage();
        }
       

    }

?>