<?php
    $servername = "localhost";
    $DBusername = "root";
    $DBpassword = "";
    $DBname = "mail_db";
    $token= $_POST['token'];
    $pdo = new PDO("mysql:host=$servername;dbname=$DBname", $DBusername,$DBpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT post,gonderen FROM mail_tbl WHERE get_token = '$token'");
    try {

    while ($row = $stmt->fetch(pdo::FETCH_ASSOC)) {
        $mails[]= $row;
    }
    echo json_encode($mails);
} catch (PDOException $e) {
    echo $stmt . "<br>" . $e->getMessage();
}

    ?>