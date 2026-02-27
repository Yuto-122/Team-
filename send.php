<?php
require_once __DIR__ . "../functions/function.php";

session_start();

$name = $_POST["name"];
$kana = $_POST["kana"];
$email = $_POST["email"];
$message = $_POST["message"];


//DBにPOST受け取りしたデータを挿入(INSERT)
try {
    $db = db_connect();
    $sql = "INSERT INTO contact (id,name,kana,email,message,receive_date,update_date,status)
    VALUES (null,:name,:kana,:email,:message,now(),now(),1)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":kana", $kana, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":message", $message, PDO::PARAM_STR);

    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}

session_destroy();

header("location: complete.php");
exit();
