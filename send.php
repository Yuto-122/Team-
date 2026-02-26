<?php
require_once __DIR__ . "../functions/function.php";

session_start();

$name = $_POST["name"];
$kana = $_POST["kana"];
$email = $_POST["email"];
$message = $_POST["message"];

debug_check($name);
debug_check($kana);
debug_check($email);
debug_check($message);

//DBにPOST受け取りしたデータを挿入(INSERT) now()
try {
    $db = db_connect();
    $sql = "INSERT INTO contact (name,kana,email,message)
    VALUES (:name,:kana,:email,:message,now())";
    $stmt = $db -> prepare($sql);

    $stmt -> bindParam(":name",$name,PDO::PARAM_STR);
    $stmt -> bindParam(":kana",$kana,PDO::PARAM_STR);
    $stmt ->bindParam(":email",$email,PDO::PARAM_STR);
    $stmt ->bindParam(":message",$message,PDO::PARAM_STR);

    $stmt -> execute();



    
} catch (PDOException $e) {
    echo $e->getMessage();
}


    //画面遷移