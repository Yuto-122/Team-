<?php
require_once __DIR__ . "/../functions/function.php";

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $id = (int)$_POST["id"];

        try {
            $db = db_connect();
            $sql = "DELETE FROM users WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            set_admin_system_message("ユーザーを削除しました。", Msg_Status::Success);
            header("location:admin_user.php");
            exit();
        } catch (PDOException $e) {
            set_admin_system_message("例外が発生しました。<br>" . $e->getMessage(), Msg_Status::Error);
            header("location:user_del.php?id=" . $id);
            exit();
        }
    }
}

set_admin_system_message("問題が発生しました。", Msg_Status::Error);
header("location:admin_user.php");
exit();
