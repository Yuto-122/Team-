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
        } catch (PDOException $e) {
            // TODO nagata-t: エラーの挙動は後で考える（admin_faqに戻すで良い気がする）
            header("location:admin_faq.php");
            exit();
        }
    }
}

header("location:admin_faq.php");
exit();
