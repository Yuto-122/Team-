<?php

require_once __DIR__ . '/functions/function.php';

$id = (int)$_GET['id'];

// DBに接続
try {
  $db = db_connect();

  $sql = 'SELECT  menus.name AS menus_name , shops.name AS shops_name , menus.id , menus.body , menus.menu_b_pc_img , menus.menu_b_sp_img, menus.amount , menus.price , shops.kana , shops.booth , shops.description FROM menus INNER JOIN shops ON menus.shop_id = shops.id WHERE menus.id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit('エラー: ' . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="noindex, nofollow" />
  <!-- meta個別設定 -->
  <meta name="description"
    content="定番のご当地餃子から、驚きの創作餃子まで、ここはまるで餃子のテーマパーク。【肉汁あふれる焼き餃子】香ばしく焼き上げた皮の中には、あふれんばかりの肉汁がぎっしり。厳選された国産豚とキャベツの旨味が広がる、満足感たっぷりの一品です。一口噛めば、ジュワッとした肉汁が口いっぱいに広がります。" />
  <meta name="keywords" content="焼き餃子,博多ぎょうざ堂,餃子専門店" />
  <meta name="author" content="ふくおか餃子FES実行委員会" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="" />
  <meta property="og:site_name" content="ふくおか餃子FES" />
  <meta property="og:title" content="肉汁あふれる焼き餃子｜ふくおか餃子FES" />
  <meta property="og:description" content="厳選された国産豚とキャベツの旨味が広がる、肉汁あふれる焼き餃子" />
  <meta property="og:image" content="" />
  <meta property="og:image:alt" content="肉汁あふれる焼き餃子｜ふくおか餃子FES" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <!-- ファビコン -->
  <link rel="icon" href="./img/fav/favc.png" type="image/png" />
  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&family=Zen+Maru+Gothic&display=swap"
    rel="stylesheet" />
  <!-- css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>肉汁あふれる焼き餃子｜ふくおか餃子FES</title>
</head>

<body class="l-body-sub">

  <?php include('inc/header.php');
  ?>

  <main class="l-menu-b">
    <article class="c-main-container">
      <div class="c-menu-b-wrapper c-menu-b-card l-menu-b-card">
        <?php foreach ($menus as $list): ?>
          <!-- TODO 画像がなかったらの処理 時間あったら -->
          <h1 class="c-menu-b-card-cnt_title l-menu-b-card_text">
            <span><?php echo $list['booth']; ?></span>
            <?php echo $list['menus_name']; ?>
          </h1>
          <div class="c-menu-b-card-cnt_img">
            <picture>
              <source media="(min-width: 768px)" srcset="./img/menu-b/<?php echo $list['menu_b_pc_img']; ?>" />
              <img src="./img/menu-b/<?php echo $list['menu_b_sp_img']; ?>" alt="<?php echo $list['menus_name']; ?>" />
            </picture>
          </div>
          <div class="c-menu-b-card-cnt_desc l-menu-b-card_text">
            <p>
              <?php echo $list['body']; ?>
            </p>
            <p class="u-mt10"><?php echo $list['amount']; ?>個入り <?php echo $list['price']; ?>円（税込）</p>
          </div>
          <!-- 共有btn -->
          <a class="c-share-btn c-menu-b-card-cnt_link l-menu-b-card_text" href="#">「#ふくおか餃子FES」で共有</a>
          <!-- 店舗詳細 -->
          <div class="c-menu-b-card-cnt_shop l-menu-b-card_text">
            <p><?php echo $list['shops_name']; ?>
              <?php if (!empty($list['kana'])): ?>
                （<?php echo $list['kana']; ?>）
              <?php endif; ?>
            </p>
            <p class="u-mt10">
              <?php echo $list['description']; ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    </article>
    <!-- メニュー一覧へbtn -->
    <div class="c-btn2 c-btn2--red u-mt40to50">
      <div class="c-btn2_box"></div>
      <a class="c-btn2_link" href="menu.php">メニュー一覧へ</a>
    </div>
  </main>

  <?php include('inc/footer.php');
  ?>

  <!-- トップに戻るボタン -->
  <div id="page-top">
    <a href="#pagetop" class="c-pagetop-btn c-pagetop-btn-position"><img src="./img/top.svg" alt="トップへ戻る"></a>
  </div>
  <!-- js -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="./js/pagetop-btn.js"></script>
  <script src="./js/humberger-menu.js"></script>
</body>

</html>