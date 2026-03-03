<?php

require_once __DIR__ . '/functions/function.php';

// DBに接続
try {
  $db = db_connect();

  $sql = 'SELECT menus.id , menus.name AS menus_name , shops.name AS shops_name, menus.menu_img, menus.amount , menus.price, shops.booth FROM menus INNER JOIN shops ON menus.shop_id = shops.id';
  $stmt = $db->prepare($sql);
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
  <!-- meta個別設定 -->
  <meta name="robots" content="noindex, nofollow" />
  <meta name="description"
    content="定番のご当地餃子から、驚きの創作餃子まで、ここはまるで餃子のテーマパーク。香ばしく焼き上げられた皮のパリッとした食感、ジューシーな肉汁、個性あふれるタレのハーモニー…ひとくち食べるたびに、新しい味、新しい驚き、新しい発見が待っています。さあ、あなたもこの美味しい冒険に出かけませんか？">
  <meta name="keywords" content="餃子,ご当地,博多,餃子専門店,長浜公園,福岡">
  <meta name="author" content="ふくおか餃子FES実行委員会" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="" />
  <meta property="og:site_name" content="ふくおか餃子FES">
  <meta property="og:title" content="ふくおか餃子FES">
  <meta property="og:description" content="福岡の人気餃子が一堂に集結！ふくおか餃子FESは、ご当地餃子や創作餃子が楽しめるフードフェスです" />
  <meta property="og:image" content="" />
  <meta property="og:image:alt" content="ふくおか餃子FES" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <!-- ファビコン -->
  <link rel="icon" href="./img/fav/favc.png" type="image/png">
  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&family=Zen+Antique+Soft&family=Zen+Maru+Gothic&display=swap"
    rel="stylesheet">
  <!-- css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <title>ふくおか餃子FES｜公式サイト</title>
</head>


<body>

  <?php include('inc/header.php');
  ?>

  <main>

    <div class="l-mv-hero">
      <div class="l-mv-hero-title">
        <h1>ふくおか餃子フェス</h1>
        <p>ひとくちごとに、新しい体験。</p>
      </div>
      <dl class="l-mv-hero-address">
        <dt class="l-mv-hero-address-title">開催会場</dt>
        <dd class="l-mv-hero-address-detail">長浜公園</dd>
      </dl>
    </div>

    <div class="l-mv-schedule l-mv-schedule-flex">
      <dl class="l-mv-schedule-date">
        <dt class="c-mv-schedule-title c-mv-schedule-title--date">
          開催日程
        </dt>
        <dd class="c-mv-schedule-detail c-mv-schedule-detail--date">
          <time datetime="2030-04-27">2030年<br />4/27(日)</time>ー<time datetime="2030-05-12">5/12(日)</time>
        </dd>
      </dl>
      <dl class="l-mv-schedule-time">
        <dt class="c-mv-schedule-title c-mv-schedule-title--time">
          営業時間
        </dt>
        <dd class="c-mv-schedule-detail c-mv-schedule-detail--time">
          平日 16:00&nbsp;～&nbsp;22:00<br />
          土日祝 11:00&nbsp;～&nbsp;22:00<br />
          <span class="e-last-time">最終入場受付21:00(L.O.&nbsp;21:15)</span>
        </dd>
      </dl>
    </div>

    <div class="l-mv-catchcopy l-mv-catchcopy-bg">
      <div class="l-catchcopy-flex">
        <img class="l-catchcopy-img" src="./img/top-catchcopy.png" alt="餃子の画像" />
        <p class="l-catchcopy-attention">
          福岡の<br />
          餃子文化が<br />
          一堂に集結！
        </p>
      </div>
      <div class="l-catchcopy-other">
        <p class="l-catchcopy-other-title">
          定番のご当地餃子から、驚きの創作餃子まで、<br />
          ここはまるで餃子のテーマパーク。
        </p>
        <p class="l-catchcopy-other-desc">
          香ばしく焼き上げられた皮の<span class="c-catchcopy-sound--pari">パリッ</span>とした食感、<br />
          <span class="c-catchcopy-sound--jucy">ジューシー</span>な肉汁、個性あふれるタレの<span
            class="c-catchcopy-sound--harmony">ハーモニー</span>&hellip;<br />
          ひとくち食べるたびに、新しい味
          、新しい驚き、新しい発見が待っています。
        </p>
        <p class="l-catchcopy-other-introduction">
          さあ、あなたもこの美味しい<b class="c-catchcopy-accent">冒険</b>に出かけませんか？
        </p>
      </div>
    </div>

    <section class="l-sec l-sec--menu">
      <div class="l-content-wrap">
        <h2 class="c-sec-title l-sec-title--menu" data-sub-title="Menu">メニュー</h2>
        <ul class="l-menu-list">
          <?php foreach ($menus as $list): ?>
            <li class="c-menu-card c-menu-card--b01">
              <h3><?php echo $list['menus_name']; ?></h3>
              <img class="c-menu-card__img" src="./img/menu/<?php echo $list['menu_img']; ?>" alt="<?php echo $list['menus_name']; ?>">
              <p class="c-menu-card-price"><?php echo $list['amount']; ?>個入り&nbsp;<?php echo $list['price']; ?>円（税込）</p>
              <p class="c-menu-card-shopname"><?php echo $list['shops_name']; ?></p>
              <a class="c-share-link" href="#">「#ふくおか餃子FES」で共有</a>
              <a class="c-button-goto-booth" href="./menu-b.php?id=<?php echo $list['id']; ?>">詳細はこちら</a>
            </li>
          <?php endforeach; ?>
        </ul>
        <!-- メニュー一覧btn -->
        <div class="l-btn-layout">
          <div class="c-btn c-btn--yellowred">
            <a class="c-btn_link c-btn_link--yellowred" href="menu.php">メニュー一覧へ</a>
          </div>
        </div>
      </div>
    </section>

    <img class="l-rest-image" src="./img/top-rest-gyoza.jpg" alt="" />

    <section class="l-sec l-sec--info" id="top-infomation">
      <div class="l-content-wrap">
        <h2 class="c-sec-title l-sec-title--info" data-sub-title="Information">開催概要</h2>
        <dl class="l-info-list">
          <dt class="c-info-list-title">期間</dt>
          <dd class="c-info-list-desc">2030.4.27(日)&nbsp;～&nbsp;5.12(日)</dd>
          <dt class="c-info-list-title">営業時間</dt>
          <dd class="c-info-list-desc">
            平日&nbsp;16:00&nbsp;~&nbsp;22:00<br>
            土日祝&nbsp;11:00&nbsp;~&nbsp;22:00<br>
            最終入場受付&nbsp;21:00&nbsp;(L.O.&nbsp;21:15)
          </dd>
          <dt class="c-info-list-title">料金</dt>
          <dd class="c-info-list-desc">入場料無料&nbsp;※飲食代別途（現金、QRコード決済、各種電子マネー利用可能）</dd>
          <dt class="c-info-list-title">会場</dt>
          <dd class="c-info-list-desc">
            長浜公園<br>
            〒810-0073<br>
            福岡県福岡市中央区舞鶴1丁目7
          </dd>
          <dt class="c-info-list-title">アクセス</dt>
          <dd class="c-info-list-desc">
            <iframe class="l-googlemap"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d659.4577417374079!2d130.3936563315363!3d33.593402390845505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3541918916ac1a97%3A0x38ef1af8385772cc!2z6ZW35rWc5YWs5ZyS!5e0!3m2!1sja!2sjp!4v1766986989523!5m2!1sja!2sjp"
              width=100% height=100% style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
            <dl class="l-access-list">
              <div class="l-access-list-flex">
                <dt class="c-access-list-title">地下鉄天神駅から徒歩10分</dt>
                <dd>
                  <a class="c-access-list-button" target="_blank" href="https://maps.app.goo.gl/q6LJtK4AdoUq5qSx7">会場までの経路</a>
                </dd>
              </div>
              <div class="l-access-list-flex">
                <dt class="c-access-list-title">西鉄天神駅から徒歩10分</dt>
                <dd>
                  <a class="c-access-list-button" target="_blank" href="https://maps.app.goo.gl/ggTNmnoiJLQbkfSq5">会場までの経路</a>
                </dd>
              </div>
              <div class="l-access-list-flex">
                <dt class="c-access-list-title">西鉄バス「長浜一丁目」から徒歩2分</dt>
                <dd><a class="c-access-list-button" target="_blank" href="https://maps.app.goo.gl/ZwwSuwodm2Z7TvZS9">会場までの経路</a>
                </dd>
              </div>
              <div class="l-access-list-flex">
                <dt class="c-access-list-title">西鉄バス「福祉センター前(浜の町病院入口)」から徒歩2分</dt>
                <dd>
                  <a class="c-access-list-button" target="_blank" href="https://maps.app.goo.gl/RZkppEVMzXW1DBMr7">会場までの経路</a>
                </dd>
              </div>
            </dl>
          </dd>
        </dl>
      </div>
    </section>

    <section class="l-sec l-sec--news l-sec--news-bg">
      <div class="l-content-wrap">
        <h2 class="c-sec-title l-sec-title--news" data-sub-title="News">お知らせ</h2>
        <ul class="l-news-item__list">
          <li class="c-news-list c-news-list--2030.02.25">
            <a class="c-news-list-content" href="news.php?open=news1">
              <time class="c-news-item__data" datetime="2030-02-25">2030.2.25（月）</time>
              <p class="c-news-item__summary">出店者インタビュー&emsp;博多区で人気の「博多ぎょうざ堂」</p>
            </a>
          </li>
          <li class="c-news-list c-news-list--2030.2.23">
            <a class="c-news-list-content" href="news.php?open=news2">
              <time class="c-news-item__data" datetime="2030-02-23">2030.2.23（土）</time>
              <p class="c-news-item__summary">出店企業様募集中！</p>
            </a>
          </li>
          <li class="c-news-list c-news-list--2030.2.16">
            <a class="c-news-list-content" href="news.php?open=news3">
              <time class="c-news-item__data" datetime="2030-02-16">2030.2.16（土）</time>
              <p class="c-news-item__summary">ふくおか餃子FES開催決定！</p>
            </a>
          </li>
        </ul>
        <!-- お知らせー一覧btn -->
        <div class="l-btn-layout">
          <div class="c-btn c-btn--whitered">
            <a class="c-btn_link c-btn_link--whitered" href="news.php">お知らせ一覧へ</a>
          </div>
        </div>
      </div>
    </section>


  </main>

  <?php include('inc/footer.php');
  ?>

  <div id="page-top">
    <a href="#pagetop" class="c-pagetop-btn c-pagetop-btn-position"><img src="./img/top.svg" alt="トップへ戻る"></a>
  </div>
  <!-- js -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="./js/pagetop-btn.js"></script>
  <script src="./js/humberger-menu.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="./js/animation.js"></script>
</body>

</html>