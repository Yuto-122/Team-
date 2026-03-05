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
    <!-- ここから「本文」-->
    <h1 class="my-5">お知らせ - 新規登録</h1>

    <?php
    // //アップロードの処理
    //   $msg = null;
    //   $alert = null;

    // if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
    //     $old_name = $_FILES['image']['tmp_name'];

    //     $new_name = $_FILES['image']['name'];
    //     if(move_uploaded_file($old_name, '../img/news/' . $new_name)){
    //         $msg = 'アップロードしました。';
    //         $alert = 'success';
    //     } else {
    //         $msg = 'アップロードできませんでした。';
    //         $alert = 'danger';
    //     }

    // }

    ?>



    <!-- <form action="info_add.php" method="post" class="needs-validation mb-3" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label d-block mb-3">【任意】 画像は投稿する前にアップロードしてください</label>
              <input type="file" name="image"  class="form-control-file">
              <input type="submit" id="select_img" value="アップロード" class="btn btn-primary btn-sm">
            </div>
        </form> -->

    <?php
    // if($msg){
    //   echo '<div class="alert alert-' . $alert .'" role="arert">'. $msg . '</div>';
    // } 
    ?>

    <form action="info_add_do.php" method="post" class="needs-validation mb-3" novalidate enctype="multipart/form-data">
      <div class="mb-3">
        <label for="title" class="form-label">タイトル</label>
        <input type="text" name="title" id="title" class="form-control" required>
        <div class="invalid-feedback">
          お知らせのタイトルを入力してください
        </div>
      </div>
      <div class="mb-3 row">
        <div class="col">
          <label for="date" class="form-label">公開日</label>
          <input type="date" name="date" id="date" class="form-control">
        </div>
        <div class="col">
          <label for="author" class="form-label">お知らせ画像名</label>
          <input type="file" name="info_img" id="info_img" class="form-control">
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
        <input type="submit" value="登録" class="btn btn-primary">
        <a href="admin_info.php" class="btn btn-secondary">一覧に戻る</a>
      </div>
    </form>
    <!-- 本文ここまで -->
    </div>

  </main>

  <!-- 画像ファイル名を送信するために上の -->
  <script>
    const selectIimg = document.getElementById('select_img');
    const infoImg = document.getElementById('info_img');
    // ファイルが選択された時に実行
    selectIimg.addEventListener('click', (event) => {
      const files = event.target.files; // 選択されたファイルリストを取得
      infoImg.value = files[0].name;
    });
  </script>


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