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
            set_admin_system_message(MsgContent::USER_DELETE->value, MsgStatus::SUCCESS);
            header("location:admin_user.php");
            exit();
        } catch (PDOException $e) {
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:user_delete.php?id=" . $id);
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR, MsgStatus::ERROR);
header("location:admin_user.php");
exit();
