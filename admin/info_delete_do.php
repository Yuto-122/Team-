<?php
require_once __DIR__ . "/../functions/function.php";

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $id = (int)$_POST["id"];

        try {
            $db = db_connect();


            //画像削除分　+++
            $sql02 = "SELECT * FROM info WHERE id=:id";
            $stmt02 = $db->prepare($sql02);
            $stmt02->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt02->execute();
            $result = $stmt02->fetch(PDO::FETCH_ASSOC);

            $file_path = '../img/news/'. $result['info_img'];
            //  var_dump($file_path);
            unlink($file_path); 


            $sql = "DELETE FROM info WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // TODO nagata-t: エラーの挙動は後で考える（admin_userに戻すで良い気がする）
            header("location:admin_info.php");
            exit();
        }
    }
}
// echo var_dump($id);
header("location:admin_info.php");
exit();
