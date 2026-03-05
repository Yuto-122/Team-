<?php
require_once __DIR__ . "/../functions/function.php";

session_start();
check_logined();

$db = db_connect();
$sql = " SELECT id,name FROM shops";

$stmt = $db->prepare($sql);

$stmt->execute();

$shops = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <?php include('admin-header.php');  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <?php include('admin-system-message.php');  ?>
    <h1 class="my-5">メニュー - 新規登録</h1>
    <div>
      <!-- ここから「本文」-->
      <form action="menu_add_do.php" method="post" class="needs-validation mb-3" novalidate enctype="multipart/form-data">
        <div class="mb-3">
          <label for="shop" class="form-label">店舗</label><br>
          <select name="shop" id="shop">
            <?php foreach ($shops as $shop): ?>
              <option value="<?php echo $shop["id"] ?>"><?php echo $shop["name"] ?></option>
            <?php endforeach; ?>
          </select>

          <div class="mb-3">
            <label for="name" class="form-label mt-3">商品名</label>
            <input type="text" name="name" id="name" class="form-control" required>
            <div class="invalid-feedback">
              商品名を入力してください
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label for="amount" class="form-label">個数</label>
              <input type="text" name="amount" id="amount" class="form-control">
            </div>
            <div class="col">
              <label for="price" class="form-label">価格</label>
              <input type="text" name="price" id="price" class="form-control">
            </div>
            <div class="mb-3 row">
              <label for="menu_img" class="form-label mt-3">商品画像</label>
              <input type="file" name="menu_img" id="menu_img">
              <div class="invalid-feedback">
                投稿者を入力してください
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col">
                <label for="image_pc" class="form-label">PC用 商品画像</label>
                <input type="file" name="menu_img_pc" id="menu_img_pc" class="form-control">
                <div class="invalid-feedback">
                  投稿者を入力してください
                </div>
              </div>
              <div class="col">
                <label for="image_sp" class="form-label">スマートフォン用 商品画像</label>
                <input type="file" name="menu_img_sp" id="menu_img_sp" class="form-control">
                <div class="invalid-feedback">
                  投稿者を入力してください
                </div>
              </div>
              <div class="mb-3">
                <label for="body" class="form-label mt-3">商品詳細</label>
                <textarea name="body" id="body" class="form-control" style="resize: none;"></textarea>
                <div class="invalid-feedback">
                  商品詳細の本文を入力してください
                </div>
              </div>
              <div class="mb-3">
                <input type="submit" value="登録" class="btn btn-primary">
                <a href="admin_menu.php" class="btn btn-secondary">一覧に戻る</a>
              </div>
            </div>
      </form>
      <!-- 本文ここまで -->
    </div>

  </main>

  <script>
    (() => {
      'use strict'

      const forms = document.querySelectorAll('.needs-validation')

      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>

</body>

</html>