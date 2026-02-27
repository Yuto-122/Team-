<?php
require_once __DIR__ . "/../functions/function.php";

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $id = $_POST["id"];

        try {
            $db = db_connect();
            $sql = "DELETE FROM users WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // TODO nagata-t: エラーの挙動は後で考える（admin_userに戻すで良い気がする）
            header("location:admin_user.php");
            exit();
        }
    }
}

header("location:admin_user.php");
exit();
