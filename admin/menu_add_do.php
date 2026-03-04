<?php
require_once __DIR__ . "/../functions/function.php";

debug_check($_POST);
if (!empty($_POST)) {
    if (!empty($_POST["name"]) && !empty($_POST["amount"]) && !empty($_POST["price"]) && !empty($_POST["body"])&& !empty($_POST["menu_img"]) &&!empty($_POST["shop"])) {
        $name = $_POST["name"];
        $amount =$_POST["amount"];
        $price = $_POST["price"];
        $body = $_POST["body"];
        $shop = $_POST["shop"];
        $menu_img = $_POST["menu_img"];
        $menu_img_pc = "1";
        $menu_img_sp = "2";

        debug_check($name);

        try {
            $db = db_connect();

            $sql = "INSERT INTO menus(id,name,body,amount,price,menu_img,menu_b_pc_img,menu_b_sp_img,shop_id,update_date,created_date) VALUE(null,:name,:body,:amount,:price,:menu_img,:menu_b_pc_img,:menu_b_sp_img,:shop,now(),now())";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":body", $body, PDO::PARAM_STR);
            $stmt->bindParam(":amount", $amount, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            $stmt->bindParam(":menu_img", $menu_img, PDO::PARAM_STR);
            $stmt->bindParam(":menu_b_pc_img", $menu_img_pc, PDO::PARAM_STR);
            $stmt->bindParam(":menu_b_sp_img", $menu_img_sp, PDO::PARAM_STR);
            $stmt->bindParam(":shop", $shop, PDO::PARAM_STR);

            $stmt->execute();

            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            debug_check($menus);
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            //TODO nagata-t: エラーメッセージを入れるか検討（余裕があったら）
            header("location:shop_add.php");
            exit('エラー: ' . $e->getMessage());
        }
    }
}

header("location:admin_menu.php");
exit();
