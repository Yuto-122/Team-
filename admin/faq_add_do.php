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
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            // TODO nagata-t: エラーメッセージを入れるか検討（余裕があったら）
            header("location:faq_add.php");
            exit();
        }
    }
}

header("location:admin_faq.php");
exit();
