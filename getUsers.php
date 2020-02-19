<?php
    $servername = "localhost";
    $DBusername = "root";
    $DBpassword = "";
    $DBname = "mail_db";

    try {
    $pdo = new PDO("mysql:host=$servername;dbname=$DBname", $DBusername,$DBpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT username FROM users");
    while ($row = $stmt->fetch(pdo::FETCH_ASSOC)) {
        $usernames[]= $row;
    }
    echo json_encode($usernames);
} catch (PDOException $e) {
    echo $stmt . "<br>" . $e->getMessage();
}

    ?>