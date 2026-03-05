<?php
require_once __DIR__ . "/../functions/function.php";

session_start();
debug_check($_POST);
debug_check($_FILES);

$menu_img = $_POST["menu_img"];
$menu_img_pc = $_POST["menu_img_pc"];
$menu_img_sp = $_POST["menu_img_sp"];

$menu_img_old = $_POST["menu_img"];
$menu_img_pc_old = $_POST["menu_img_pc"];
$menu_img_sp_old = $_POST["menu_img_sp"];

if (isset($_FILES["menu_img"]) && isset($_FILES["menu_img_pc"]) && isset($_FILES["menu_img_sp"]) && $_FILES["menu_img"]["error"] == 0 && $_FILES["menu_img_pc"]["error"] == 0 && $_FILES["menu_img_sp"]["error"] == 0) {
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
    $upload_img_pc = $img_date_pc . "-pc" . "." . $path_pc;
    $upload_img_sp = $img_date_sp . "-sp" . "." . $path_sp;

    echo $upload_img_pc;
    echo $upload_img_sp;

    //画像名を変更してimgフォルダへ移動
    rename($tmp_img_name, "../img/menu/" . $upload_img);
    rename($tmp_imgPc_name, "../img/menu-b/" . $upload_img_pc);
    rename($tmp_imgSp_name, "../img/menu-b/" . $upload_img_sp);
}

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
            $sql = "UPDATE menus SET name=:name,body=:body,amount=:amount,price=:price,menu_img=:menu_img,menu_b_pc_img=:menu_b_pc_img,menu_b_sp_img=:menu_b_sp_img,update_date=now() WHERE id=:id";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":body", $body, PDO::PARAM_STR);
            $stmt->bindParam(":amount", $amount, PDO::PARAM_INT);
            $stmt->bindParam(":price", $price, PDO::PARAM_INT);
            if ($_FILES["menu_img"]["error"] === 0) {
                $stmt->bindParam(":menu_img", $upload_img, PDO::PARAM_STR);
                $old_img = __DIR__ . "/../img/menu/" . $menu_img_old;
                unlink($old_img);
            } else {
                $stmt->bindParam(":menu_img", $menu_img, PDO::PARAM_STR);
            }
            if ($_FILES["menu_img_pc"]["error"] === 0 && $_FILES["menu_img_sp"]["error"] === 0) {
                $stmt->bindParam(":menu_b_pc_img", $upload_img_pc, PDO::PARAM_STR);
                $stmt->bindParam(":menu_b_sp_img", $upload_img_sp, PDO::PARAM_STR);

                $old_img_pc = __DIR__ . "/../img/menu-b/" . $menu_img_pc_old;
                $old_img_sp = __DIR__ . "/../img/menu-b/" . $menu_img_sp_old;
                unlink($old_img_pc);
                unlink($old_img_sp);
            } else {
                $stmt->bindParam(":menu_b_pc_img", $menu_img_pc, PDO::PARAM_STR);
                $stmt->bindParam(":menu_b_sp_img", $menu_img_sp, PDO::PARAM_STR);
            }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            set_admin_system_message(MsgContent::MENU_EDIT->value . $name, MsgStatus::SUCCESS);
            header('location:admin_menu.php');
            exit();
        } catch (PDOException $e) {
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:menu_edit.php?id=" . $id);
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_menu.php");
exit();
