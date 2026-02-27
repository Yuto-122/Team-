<?php
require_once __DIR__ . '/../functions/function.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['title']) && !empty($_POST['body'])) {
        // TODO: 必須項目チェック（空の場合）
        $title = $_POST['title'];
        $body = $_POST['body'];
        // 日付けが空文字だったら当日のデータ、空文字じゃなかったら送信されたデータを代入
        $public_date = empty($_POST['public_date']) ? date('Y-m-d') : $_POST['public_date'];
        $update_date = empty($_POST['pdate_date']) ? date('Y-m-d') : $_POST['pdate_date'];
        $created_date = empty($_POST['created_date']) ? date('Y-m-d') : $_POST['created_date'];

        var_dump($_POST);

        // DBに接続
        try {
            $db = db_connect();
            // infoテーブルに1行挿入するSQL
            $sql = 'INSERT INTO info (title,body,info_img,public_date,update_date,created_date) VALUES (:title,:body,:info_img,:public_date,:update_date,:created_date)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':info_img', $info_img, PDO::PARAM_STR);
            $stmt->bindParam(':public_date', $public_date, PDO::PARAM_STR);
            $stmt->bindParam(':update_date', $update_date, PDO::PARAM_STR);
            $stmt->bindParam(':created_date', $created_date, PDO::PARAM_STR);
            $stmt->execute();

            // トップページへ画面遷移
            header('location:admin_info.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: '.$e->getMessage());
        }
    }
}


