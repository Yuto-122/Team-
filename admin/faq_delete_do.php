<?php
require_once __DIR__ . "/../functions/function.php";

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $id = (int)$_POST["id"];

        try {
            $db = db_connect();
            $sql = "DELETE FROM faq WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            set_admin_system_message(MsgContent::FAQ_DELETE->value . $question, MsgStatus::SUCCESS);
            header("location:admin_faq.php");
            exit();
        } catch (PDOException $e) {
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            header("location:faq_delete.php?id=" . $id);
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_faq.php");
exit();
