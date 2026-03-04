<?php
require_once __DIR__ . "/../functions/function.php";

session_start();

if (!empty($_POST)) {
    if (!empty($_POST["question"])  && !empty($_POST["answer"]) && !empty($_POST["type"])) {
        $question = $_POST["question"];
        $answer = $_POST["answer"];
        $type = (int)$_POST["type"];

        try {
            $db = db_connect();
            $sql = "INSERT INTO faq (question,answer,type,create_date) VALUE (:question,:answer,:type,now())";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":question", $question, PDO::PARAM_STR);
            $stmt->bindParam(":answer", $answer, PDO::PARAM_STR);
            $stmt->bindParam(":type", $type, PDO::PARAM_INT);
            $stmt->execute();

            set_admin_system_message(MsgContent::FAQ_ADD->value . $question, MsgStatus::SUCCESS);
            header("location:admin_faq.php");
            exit();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:faq_add.php");
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_faq.php");
exit();
