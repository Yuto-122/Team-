<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

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

            set_admin_system_message(MsgContent::CONTACT_EDIT->value . $id . " status: " . $status, MsgStatus::SUCCESS);
            header('location:admin_contact.php');
            exit();
        } catch (PDOException $e) {
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header('location:admin_contact_edit.php?id=' . $id);
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_contact.php");
exit();
