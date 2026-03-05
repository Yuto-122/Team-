<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

if (!empty($_POST)) {
    if (!empty($_POST["name"]) && !empty($_POST["booth"]) && !empty($_POST["description"])) {
        $name = $_POST["name"];
        $booth = $_POST["booth"];
        $desc = $_POST["description"];
        $kana = $_POST["kana"];

        if (!empty($_POST["kana"])) {
            // 店舗名の読み仮名チェック（全角かなカナ1文字以上）
            if (!preg_match("/^[ぁ-んァ-ヴ¥s¥x20 ]{1,}$/", $kana)) {
                // 上記に満たさないkanaだった場合
                set_admin_system_message(MsgContent::SHOP_PREG_MATCH->value, MsgStatus::WARNING);
                header("location:shop_add.php");
                exit();
            }
        }

        try {
            $db = db_connect();

            $sql = 'SELECT count(*) FROM shops WHERE booth=:booth';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":booth", $booth, PDO::PARAM_STR);
            $stmt->execute();

            // キーを連番で取り出す(FETCH_NUM)
            $result = $stmt->fetch(PDO::FETCH_NUM);

            if ($result[0] !== 0) {
                // 0でない(1)時はすでにユーザー名が登録されている状態
                set_admin_system_message(MsgContent::SHOP_USED_BOOTH->value . $booth, MsgStatus::WARNING);
                header("location:shop_add.php");
                exit();
            }

            $sql_2 = "INSERT INTO shops(name,kana,booth,description,created_date,update_date) VALUE(:name,:kana,:booth,:description,now(),now())";
            $stmt = $db->prepare($sql_2);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":kana", $kana, PDO::PARAM_STR);
            $stmt->bindParam(":booth", $booth, PDO::PARAM_STR);
            $stmt->bindParam(":description", $desc, PDO::PARAM_STR);
            $stmt->execute();

            set_admin_system_message(MsgContent::SHOP_ADD->value . $name, MsgStatus::SUCCESS);
            header("location:admin_shop.php");
            exit();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:shop_add.php");
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_shop.php");
exit();
