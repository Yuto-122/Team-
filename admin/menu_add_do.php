<?php
require_once __DIR__ . "/../functions/function.php";

//画像と画像名を受け取り
$menu_img = $_FILES["menu_img"]["name"];
$tmp_img_name = $_FILES["menu_img"]["tmp_name"];
//pc用画像と画像名受け取り
$menu_img_pc = $_FILES["menu_img_pc"]["name"];
$tmp_imgPc_name = $_FILES["menu_img_pc"]["tmp_name"];
//sp用画像と画像名受け取り
$menu_img_sp = $_FILES["menu_img_sp"]["name"];
$tmp_imgSp_name = $_FILES["menu_img_sp"]["tmp_name"];

//受け取りデータの取得
$img_date = date("Y-m-d_His");
$img_date_pc = date("Y-m-d_His");
$img_date_sp =  date("Y-m-d_His");

//画像の形式を取得
$file_path = pathinfo($menu_img);
$file_path_pc = pathinfo($menu_img_pc);
$file_path_sp = pathinfo($menu_img_sp);

//拡張子を取得
$path = $file_path["extension"];
$path_pc = $file_path_pc["extension"];
$path_sp = $file_path_sp["extension"];

//受け取りデータと拡張子を繋げて画像名にする
$upload_img = $img_date . "." . $path;
$upload_img_pc = $img_date_pc . "." . $path_pc;
$upload_img_sp = $img_date_sp . "." .$path_sp;

//画像名を変更してimgフォルダへ移動
rename($tmp_img_name,"../img/menu/" . $upload_img);
rename($tmp_imgPc_name,"../img/menu-b/" .$upload_img_pc);
rename($tmp_imgSp_name,"../img/menu-b/" .$upload_img_sp);


if (!empty($_POST)) {
    if (!empty($_POST["name"]) && !empty($_POST["amount"]) && !empty($_POST["price"]) && !empty($_POST["body"]) &&!empty($_POST["shop"])) {
        $name = $_POST["name"];
        $amount =$_POST["amount"];
        $price = $_POST["price"];
        $body = $_POST["body"];
        $shop = $_POST["shop"];

        debug_check($name);

        try {
            $db = db_connect();

            $sql = "INSERT INTO menus(id,name,body,amount,price,menu_img,menu_b_pc_img,menu_b_sp_img,shop_id,update_date,created_date) VALUE(null,:name,:body,:amount,:price,:menu_img,:menu_b_pc_img,:menu_b_sp_img,:shop,now(),now())";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":body", $body, PDO::PARAM_STR);
            $stmt->bindParam(":amount", $amount, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            $stmt->bindParam(":menu_img", $upload_img, PDO::PARAM_STR);
            $stmt->bindParam(":menu_b_pc_img", $upload_img_pc, PDO::PARAM_STR);
            $stmt->bindParam(":menu_b_sp_img", $upload_img_sp, PDO::PARAM_STR);
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
