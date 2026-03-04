<?php
require_once __DIR__ . '/../functions/function.php';

var_dump($_FILES);

// 再び画像がアップロードされたときだけの処理
if (isset($_FILES['info_img']) && $_FILES['info_img']['error'] === UPLOAD_ERR_OK) {
$info_img = $_FILES['info_img']['name'];//写真の名前受け取り忘れないで

// 画像ファイルの処理 一時保存場所のパス +++
$tmp_name_img = $_FILES ["info_img"]['tmp_name'];

//画像の名前を変更して移動する処理
//ファイル名にするための時間を取得
$new_time = date("Y-m-d_His");
//ファイル名から拡張子を取得
$file_path = pathinfo($info_img);
$file_extension = $file_path['extension'];
//時間と拡張子合体
$new_name = $new_time . '.' . $file_extension;
//画像の移動と名前変更
rename($tmp_name_img, '../img/news/' . $new_name);

}

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

        $id = (int)$_POST["id"];

        // DBに接続
        try {
            $db = db_connect();
            // infoテーブルに1行挿入するSQL
            $sql = 'UPDATE info SET title=:title,body=:body,info_img=:info_img,public_date=:public_date,update_date=:update_date,created_date=:created_date WHERE id=:id';
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            // $info_img から $new_nameに変更忘れずに
            $stmt->bindParam(':info_img', $new_name, PDO::PARAM_STR);
            $stmt->bindParam(':public_date', $public_date, PDO::PARAM_STR);
            $stmt->bindParam(':update_date', $update_date, PDO::PARAM_STR);
            $stmt->bindParam(':created_date', $created_date, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            // トップページへ画面遷移
            header('location:admin_info.php');
            
            exit();
            
        } catch (PDOException $e) {
            exit('エラー: '.$e->getMessage());
        }
    }
}


