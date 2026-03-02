<?php
require_once __DIR__ . "/../functions/function.php";

session_start();

if (!empty($_POST)) {
    if (!empty($_POST["question"])  && !empty($_POST["answer"]) && !empty($_POST["type"]) && !empty($_POST["id"])) {
        $question = $_POST["question"];
        $answer = $_POST["answer"];
        $type = (int)$_POST["type"];
        $id = (int)$_POST["id"];

        // 必須入力のデータがあったのでDB登録処理
        try {
            $db = db_connect();
            $sql = "UPDATE faq SET question=:question,answer=:answer,type=:type WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":question", $question, PDO::PARAM_STR);
            $stmt->bindParam(":answer", $answer, PDO::PARAM_STR);
            $stmt->bindParam(":type", $type, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            // TODO nagata-t: エラーメッセージを入れるか検討（余裕があったら）
            header("location:faq_edit.php");
            exit();
        }
    }
}

header("location:admin_faq.php");
exit();
