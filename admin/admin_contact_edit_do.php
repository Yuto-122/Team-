<?php
require_once __DIR__ . "/../functions/function.php";

session_start();
debug_check($_POST);
if (!empty($_POST)) {
    if (!empty($_POST["status"]) && !empty($_POST["id"])) {
        $status = $_POST["status"];
        $id = $_POST["id"];

        // 必須入力のデータがあったのでDB上書き処理
        try {
            $db = db_connect();
            $sql = "UPDATE contact SET status=:status, update_date=now() WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            // TODO nagata-t: エラーメッセージを入れるか検討（余裕があったら）
            echo $e->getMessage();
        }
    }
}
// 正常に終わったらadmin_contact.phpに戻す
header("location:admin_contact.php");
exit();
