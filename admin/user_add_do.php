<?php
require_once __DIR__ . "/../functions/function.php";

if (!empty($_POST)) {
    if (!empty($_POST["name"]) && !empty($_POST["password"])) {
        $name = $_POST["name"];
        $password = $_POST["password"];

        // ユーザー名の書式チェック（半角英数4文字以上）
        if (!preg_match("/^[a-zA-Z0-9_-]{4,}$/", $name)) {
            // 上記に満たさないnameだった場合
            set_admin_system_message(MsgContent::USER_PREG_MATCH->value, MsgStatus::WARNING);
            header("location:user_add.php");
            exit();
        }

        // ユーザー名の重複チェック
        try {
            $db = db_connect();
            // 一致するか件数を取得して確認する
            $sql = "SELECT count(*) FROM users WHERE name=:name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();

            // キーを連番で取り出す(FETCH_NUM)
            $result = $stmt->fetch(PDO::FETCH_NUM);

            if ($result[0] !== 0) {
                // 0でない(1)時はすでにユーザー名が登録されている状態
                set_admin_system_message(MsgContent::COMMON_USED->value . $name, MsgStatus::WARNING);
                header("location:user_add.php");
                exit();
            }

            // パスワードをハッシュ化（password_hash関数を使用）
            $password_h = password_hash($password, PASSWORD_DEFAULT);

            $sql_2 = "INSERT INTO users (name,password,create_date) VALUE(:name,:password,now())";
            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt_2->bindParam(":password", $password_h, PDO::PARAM_STR);
            $stmt_2->execute();
            set_admin_system_message(MsgContent::USER_ADD->value . $name, MsgStatus::SUCCESS);
            header("location:admin_user.php");
            exit();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:user_add.php");
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_user.php");
exit();
