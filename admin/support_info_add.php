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
        <h1 class="my-5">対応状況DB - 新規登録</h1>
        <div>
      <!-- ここから「本文」-->
      <h1 class="my-5">お知らせ - 新規登録</h1>
      <form action="support_info_add_do.php" method="post" class="needs-validation mb-3" novalidate>
        <div class="mb-3">
          <label for="title" class="form-label">タイトル</label>
          <input type="text" name="title" id="title" class="form-control" required>
          <div class="invalid-feedback">
            お知らせのタイトルを入力してください
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col">
            <label for="date" class="form-label">登録日</label>
            <input type="date" name="date" id="date" class="form-control">
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
          <textarea name="body" id="body" class="form-control" required></textarea>
          <div class="invalid-feedback">
            お知らせの本文を入力してください
          </div>
        </div>
        <div class="mb-3">
          <input type="submit" value="投稿する" class="btn btn-primary">
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