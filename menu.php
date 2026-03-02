<?php

require_once __DIR__ . '/functions/function.php';

// DBに接続
try {
    $db = db_connect();

    $sql = 'SELECT menus.id , menus.name AS menus_name , shops.name AS shops_name , menus.menu_img, menus.amount , menus.price, shops.booth FROM menus INNER JOIN shops ON menus.shop_id = shops.id';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}

//boothの連想配列を作る、データを固定で仮実装
$booth_array = array(
    'booth1' => array(
        'coords' => '85,401,191,500',
        'num' => 1
    ),
    'booth2' => array(
        'coords' => '207,347,322,454',
        'num' => 2
    ),
    'booth3' => array(
        'coords' => '354,339,466,446',
        'num' => 3
    ),
    'booth4' => array(
        'coords' => '410,463,533,565',
        'num' => 4
    ),
    'booth5' => array(
        'coords' => '364,586,473,686',
        'num' => 5
    ),
    'booth6' => array(
        'coords' => '232,601,332,699',
        'num' => 6
    ),
    'booth7' => array(
        'coords' => '108,537,220,633',
        'num' => 7
    )
);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- meta個別設定 -->
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="ふくおか餃子FESは、ご当地餃子や創作餃子が楽しめるフードフェス!メニュー一覧ページです" />
    <meta name=" keywords" content="メニュー,餃子">
    <meta name="author" content="ふくおか餃子FES実行委員会">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="メニュー｜ふくおか餃子FES">
    <!-- ※トップページはここも”ふくおか餃子FES” -->
    <meta property="og:description" content="ご当地餃子や創作餃子が楽しめるフードフェス！">
    <meta property=" og:image" content="">
    <meta property="og:image:alt" content="メニュー｜ふくおか餃子FES">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <!-- ファビコン -->
    <link rel="icon" href="./img/fav/favc.png" type="image/png" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <title>メニュー｜ふくおか餃子FES</title>
</head>

<body class="menu-page">

    <?php include('inc/header.php');
    ?>

    <main class="l-main-menu">
        <div class="l-menu-contents"></div>
        <h1 class="c-section-title l-menu-contents" data-sub-title="Menu">メニュー</h1>
        <!-- shop-map -->
        <div class="l-shop-map">
            <img src="img/menu/menu-shopMap.jpg" usemap="#ImageMap" alt="店舗の地図" />
            <map name="ImageMap">
                <!-- SP （どちらの座標が正しいか不明のため履歴を残す）-->
                <!-- <area shape="rect" coords="28,154,76,198" href="./menu-b-01.html" alt="ブース1の詳細ページへとぶ" />
                    <area shape="rect" coords="79,130,131,181" href="./menu-b-02.html" alt="ブース2の詳細ページへとぶ" />
                    <area shape="rect" coords="134,129,189,178" href="./menu-b-03.html" alt="ブース3の詳細ページへとぶ" />
                    <area shape="rect" coords="156,177,214,225" href="./menu-b-04.html" alt="ブース4の詳細ページへとぶ" />
                    <area shape="rect" coords="137,226,193,271" href="./menu-b-05.html" alt="ブース5の詳細ページへとぶ" />
                    <area shape="rect" coords="89,231,134,277" href="./menu-b-06.html" alt="ブース6の詳細ページへとぶ" />
                    <area shape="rect" coords="36,208,90,254" href="./menu-b-07.html" alt="ブース7の詳細ページへとぶ" /> -->

                <!-- PC -->
                <?php foreach ($booth_array as $list): ?>
                    <area shape="rect" coords="<?php echo $list['coords']; ?>" href="./menu-b.php?id=<?php echo $list['num']; ?>"
                        alt="ブース<?php echo $list['num']; ?>の詳細ページへとぶ" />
                <?php endforeach; ?>
            </map>
        </div>
        <!-- menu-card -->
        <div class="menu-wrapper">
            <ul class="l-menu-list l-menu-contents">
                <!-- todo:画像なかった場合の処理余裕あったら書く 詳細はこちら-->
                <?php foreach ($menus as $list): ?>
                    <li class="c-menu-card c-menu-card--b01">
                        <h2>
                            <?php echo $list['menus_name']; ?>
                        </h2>
                        <img class="c-menu-card__img" src="./img/menu/<?php echo $list['menu_img']; ?>" alt="<?php echo $list['menus_name']; ?>">
                        <p class="c-menu-card-boothnum"><?php echo $list['booth']; ?></p>
                        <p class="c-menu-card-price"><?php echo $list['amount']; ?>個入り <?php echo $list['price']; ?>円（税込）</p>
                        <p class="c-menu-card-shopname"><?php echo $list['shops_name']; ?></p>
                        <!-- SNSへの共有リンク / アイコンは疑似要素で挿入 -->
                        <a class="c-share-link" href="#">「#ふくおか餃子FES」で共有</a>
                        <!-- メニュー詳細ページへのリンク / アイコンは疑似要素で挿入  -->
                        <a class="c-button-goto-booth" href="./menu-b.php?id=<?php echo $list['id']; ?>">
                            詳細はこちら
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/image-map-resizer/1.0.10/js/imageMapResizer.min.js"></script>
    <script>
        imageMapResize();
    </script>
</body>

</html>