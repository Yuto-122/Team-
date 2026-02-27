<?php
require_once __DIR__ . "/../functions/function.php";

session_start();

if (!empty($_POST)) {
    if (!empty($_POST["name"]) && !empty($_POST["id"])) {
        $name = $_POST["name"];
        $password = $_POST["password"];
        $id = (int)$_POST["id"];

        // ユーザー名の書式チェック（半角英数4文字以上）
        if (!preg_match("/^[a-zA-Z0-9_-]{4,}$/", $name)) {
            // 上記に満たさないnameだった場合
            header("location:user_edit.php");
            exit();
        }

        // ユーザー名の重複チェック
        try {
            $db = db_connect();
            // 一致するか件数を取得して確認する
            // 名前が同じでIDが異なるものがあるかどうか = 他ユーザーと名前が重複
            // IDが同じなら同じデータを扱いたいのでスルーしてOK
            $sql = "SELECT COUNT(name) FROM users WHERE name=:name AND id!=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            // キーを連番で取り出す(FETCH_NUM)
            $result = $stmt->fetch(PDO::FETCH_NUM);

            if ($result[0] !== 0) {
                // 0でない(1)時はすでにユーザー名が登録されている状態
                header("location:user_edit.php");
                exit();
            }

            // パスワードが入力された時だけ
            // パスワードをハッシュ化（password_hash関数を使用）
            if (!empty($password)) {
                $password_h = password_hash($password, PASSWORD_DEFAULT);
            }

            $sql_2 = !empty($password) ?
                "UPDATE users SET name=:name,password=:password WHERE id=:id" :
                "UPDATE users SET name=:name WHERE id=:id";

            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(":name", $name, PDO::PARAM_STR);
            if (!empty($password)) {
                $stmt_2->bindParam(":password", $password_h, PDO::PARAM_STR);
            }
            $stmt_2->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt_2->execute();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            // TODO nagata-t: エラーメッセージを入れるか検討（余裕があったら）
            header("location:user_edit.php");
            exit();
        }
    }
}

header("location:admin_user.php");
exit();
