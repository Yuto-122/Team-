<?php
require_once __DIR__ . "/../functions/function.php";

if (empty($_GET)) {
    // GETが無かったら戻す
    header("location:admin_contact.php");
    exit();
}

$id = $_GET["id"];

debug_check($id);
try{
$db = db_connect();
$sql = "DELETE FROM contact WHERE id=:id";
$stmt = $db->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

$stmt->execute();

$data = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo $e -> getMessage();
}
header("location: admin_contact.php");
exit();
?>