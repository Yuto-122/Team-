<?php
require_once __DIR__ . "/../functions/function.php";

session_start();

if (!empty($_POST)) {
    if (!empty($_POST["category"]) && !empty($_POST["link_id"])  && !empty($_POST["id"])) {
        $category = $_POST["category"];
        $link_id = $_POST["link_id"];
        $id = (int)$_POST["id"];

        try {
            $db = db_connect();
            $sql = "UPDATE faq_category SET category=:category,link_id=:link_id WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":category", $category, PDO::PARAM_STR);
            $stmt->bindParam(":link_id", $link_id, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            set_admin_system_message(MsgContent::FAQ_CATEGORY_EDIT->value . $category, MsgStatus::SUCCESS);
            header('location:admin_faq_category.php');
            exit();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:faq_category_edit.php?id=" . $id);
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header('location:admin_faq_category.php');
exit();
