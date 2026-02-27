<?php
require_once __DIR__ . "/../functions/function.php";

session_start();

if (!empty($_POST)) {
    if (!empty($_POST["status"])) {
        $status = $_POST["status"];

        // 必須入力のデータがあったのでDB登録処理
        try {
            $db = db_connect();
            $sql = "INSERT INTO support_status (status,create_date) VALUE (:status, now())";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->execute();

            // 正常に終わったらadmin_support_status.phpに戻す
            header("location:admin_support_status.php");
            exit();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            // TODO nagata-t: エラーメッセージを入れるか検討（余裕があったら）
            header("location:support_status_add.php");
            exit();
        }
    }
}
