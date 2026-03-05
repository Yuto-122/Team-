<?php
require_once __DIR__ . '/../functions/function.php';


// TODO: データ受け取り
// var_dump($_POST);

$info_img = $_FILES['info_img']['name']; //写真の名前受け取り忘れないで

// 画像ファイルの処理 一時保存場所のパス +++
$tmp_name_img = $_FILES["info_img"]['tmp_name'];


//画像を移動する処理
// 保存先のパス
// $save_path = '../img/news/' . $_FILES['info_img']['name'];
//　画像の移動
// move_uploaded_file($tmp_name_img, $save_path);


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

// var_dump($tmp_name_img);

if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['title']) && !empty($_POST['body'])) {
        // TODO: 必須項目チェック（空の場合）
        $title = $_POST['title'];
        $body = $_POST['body'];
        // 日付けが空文字だったら当日のデータ、空文字じゃなかったら送信されたデータを代入
        $public_date = empty($_POST['date']) ? date('Y-m-d') : $_POST['date'];

        // DBに接続
        try {
            $db = db_connect();
            // infoテーブルに1行挿入するSQL
            $sql = 'INSERT INTO info (title,body,info_img,public_date,update_date,created_date) VALUES (:title,:body,:info_img,:public_date,now(),now())';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            // $info_img から $new_nameに変更忘れずに
            $stmt->bindParam(':info_img', $new_name, PDO::PARAM_STR);
            $stmt->bindParam(':public_date', $public_date, PDO::PARAM_STR);
            $stmt->execute();

            // トップページへ画面遷移
            set_admin_system_message(MsgContent::INFO_ADD->value . $title, MsgStatus::SUCCESS);
            header('location:admin_info.php');
            exit();
        } catch (PDOException $e) {
            // 失敗したら入力画面へ戻す
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:info_add.php");
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_info.php");
exit();
