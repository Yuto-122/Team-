<?php
require_once __DIR__ . "/../functions/function.php";

if (empty($_GET)) {
    // GETが無かったら戻す
    header("location:admin_user.php");
    exit();
}

$id = (int)$_GET["id"];

$db = db_connect();
$sql = "SELECT * FROM info WHERE id=:id";
$stmt = $db->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$target = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($target);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>チーム王将 | 管理者ページ</title>
</head>

<body>
    <?php 
    include('admin-header.php');  
    ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5">お知らせ DB - 編集</h1>
        
        <form action="info_edit_do.php" method="post" class="needs-validation mb-3" novalidate>
        <div class="mb-3">
          <label for="title" class="form-label">タイトル</label>
          <input type="text" name="title" id="title" class="form-control" value="<?php echo h($target["title"]); ?>" required>
          <div class="invalid-feedback">
            お知らせのタイトルを入力してください
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col">
            <label for="date" class="form-label">登録日</label>
            <input type="date" name="date" id="date" class="form-control" value="<?php echo h(date('Y-m-d', strtotime($target["update_date"]))); ?>">
          </div>
          <div class="col">
            <label for="author" class="form-label">お知らせ画像名</label>
            <input type="text" name="info_img" id="info_img" class="form-control">
            <div class="invalid-feedback">
              投稿者を入力してください
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">本文</label>
          <textarea name="body" id="body" class="form-control"  required><?php echo h($target["body"]); ?>
          </textarea>
          <div class="invalid-feedback" >
            お知らせの本文を入力してください
          </div>
        </div>
        <div class="mb-3">
          <input type="hidden" name="id" value="<?php echo h($target["id"]); ?>">
          <input type="submit" value="編集する" class="btn btn-primary">
        </div>
      </form>

    <p><a href="info_delete_do.php" class="btn btn-info">お知らせ 一覧に戻る</a></p>
    </main>
</body>

</html>