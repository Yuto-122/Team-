<?php
require_once __DIR__ . "/../functions/function.php";

session_start();
check_logined();

if (!empty($_POST)) {
    if (!empty($_POST["menu"]) && !empty($_POST["body"]) && !empty($_POST["amount"]) && !empty($_POST["price"]) && !empty($_POST["id"])) {
        $name = $_POST["menu"];
        $body = $_POST["body"];
        $amount = $_POST["amount"];
        $price = $_POST["price"];
        $id = $_POST["id"];

        // 必須入力のデータがあったのでDB上書き処理
        try {
            $db = db_connect();
            $sql = "UPDATE menus SET name=:name,body=:body,amount=:amount,price=:price,menu_img=:menu_img ,update_date=now() WHERE id=:id";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":body", $body, PDO::PARAM_STR);
            $stmt->bindParam(":amount", $amount, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam("menu_img", $menu_img, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            // TODO nagata-t: エラーメッセージを入れるか検討（余裕があったら）
            echo $e->getMessage();
        }
    }
}
// 正常に終わったらadmin_contact.phpに戻す
header("location: admin_menu.php");
exit();
