<?php
// セッションの開始
session_start();
require_once __DIR__ . "/../functions/function.php";

if (!empty($_POST)) {
    if (!empty($_POST["name"] && !empty($_POST["password"]))) {
        // ユーザーの認証処理
        $name = $_POST["name"];
        $password = $_POST["password"];

        try {
            $db = db_connect();
            $sql = "SELECT * FROM users WHERE name=:name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // パスワードの検証
                if (password_verify($password, $result["password"])) {
                    // セッションIDを取得して保存
                    $_SESSION["admin_session_id"] = session_id();
                    $_SESSION["admin_user_name"] = $result["name"];

                    header("location:index.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:login.php");
            exit();
        }
    }
}

set_admin_system_message(MsgContent::LOGIN_FAILD->value, MsgStatus::ERROR);
header("location:login.php");
exit();
