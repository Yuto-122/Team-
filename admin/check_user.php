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
                    $_SESSION["id"] = session_id();
                    $_SESSION["name"] = $result["name"];
                    header("location:index.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            exit("エラー: " . $e->getMessage());
        }
    }
}
header("location:login.php");
exit();
