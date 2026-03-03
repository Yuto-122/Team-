<?php
require_once __DIR__ . "/../functions/function.php";

session_start();

if (!empty($_POST)) {
    if (!empty($_POST["name"]) && !empty($_POST["booth"]) && !empty($_POST["description"])) {
        $name = $_POST["name"];
        $booth = $_POST["booth"];
        $desc = $_POST["description"];
        $kana = $_POST["kana"];
        $id = (int)$_POST["id"];

        if (!empty($_POST["kana"])) {
            // 店舗名の読み仮名チェック（全角かなカナ1文字以上）
            if (!preg_match("/^[ぁ-んァ-ヴ¥s¥x20 ]{1,}$/", $kana)) {
                // 上記に満たさないkanaだった場合
                //header("location:admin_shop.php");
                exit('エラー: ' . $e->getMessage());
            }
        }

        try {
            $db = db_connect();
            // 一致するか件数を取得して確認する
            // 名前が同じでIDが異なるものがあるかどうか = 他ユーザーと名前が重複
            // IDが同じなら同じデータを扱いたいのでスルーしてOK
            $sql = 'SELECT COUNT(booth) FROM shops WHERE booth=:booth AND id!=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":booth", $booth, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            // キーを連番で取り出す(FETCH_NUM)
            $result = $stmt->fetch(PDO::FETCH_NUM);

            if ($result[0] !== 0) {
                // 存在するブースと登録したいブースを比較、存在すれば登録できない
                exit('そのブースは登録済みです');
            }

            // $sql2 = 'SELECT COUNT(id) FROM shops WHERE id=:id';
            // $stmt = $db->prepare($sql2);
            // $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            // $stmt->execute();

            // $result = $stmt->fetch(PDO::FETCH_NUM);

            // if ($result[0] !== 0) {
            //     // idが一致している
            //     exit('idが一致しています');
            // }

            // $sql_2 = !empty($password) ?
            //     "UPDATE users SET name=:name,password=:password WHERE id=:id" :
            //     "UPDATE users SET name=:name WHERE id=:id";

            // $stmt_2 = $db->prepare($sql_2);
            // $stmt_2->bindParam(":name", $name, PDO::PARAM_STR);
            // if (!empty($password)) {
            //     $stmt_2->bindParam(":password", $password_h, PDO::PARAM_STR);
            // }
            // $stmt_2->bindParam(":id", $id, PDO::PARAM_INT);
            // $stmt_2->execute();


            $sql_2 =  "UPDATE shops SET name=:name, kana=:kana, booth=:booth, description=:description , update_date=now()";

            $stmt = $db->prepare($sql_2);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":kana", $kana, PDO::PARAM_STR);
            $stmt->bindParam(":booth", $booth, PDO::PARAM_STR);
            $stmt->bindParam(":description", $desc, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            // TODO nagata-t: エラーメッセージを入れるか検討（余裕があったら）
            //header("location:shop_add.php");
            exit('エラー: ' . $e->getMessage());
        }
    }
}

//header("location:admin_shop.php");
exit('エラー: ' . $e->getMessage());
