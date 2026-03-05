<?php
require_once __DIR__ . "/../functions/function.php";

session_start();
check_logined();

if (!empty($_POST)) {
    if (!empty($_POST["status"]) && !empty($_POST["id"])) {
        $status = $_POST["status"];
        $id = (int)$_POST["id"];

        // 必須入力のデータがあったのでDB登録処理
        try {
            $db = db_connect();
            $sql = "UPDATE support_status SET status=:status WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->execute();

            set_admin_system_message(MsgContent::SUPPORT_STATUS_EDIT->value . $status, MsgStatus::SUCCESS);
            header("location:admin_support_status.php");
            exit();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:support_status_edit.php?id=" . $id);
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_support_status.php");
exit();
