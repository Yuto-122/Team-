<?php
require_once __DIR__ . '/functions/function.php';

try {
    $db = db_connect();
    $stmt = $db->prepare("SELECT * FROM faq_category");
    $stmt->execute();
    $faq_category = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt_faq = $db->prepare("SELECT * FROM faq");
    $stmt_faq->execute();
    $faq = $stmt_faq->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('接続失敗: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <!-- meta個別設定 -->
    <meta name="description" content="よくあるご質問｜ふくおか餃子FES" />
    <meta name="keywords" content="よくある質問,FAQ,質問,餃子">
    <meta name="author" content="ふくおか餃子FES実行委員会">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="よくある質問｜ふくおか餃子FES">
    <meta property="og:description" content="ご当地餃子や創作餃子が楽しめるフードフェス！">
    <meta property="og:image" content="">
    <meta property="og:image:alt" content="よくある質問｜ふくおか餃子FES">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <!-- ファビコン -->
    <link rel="icon" href="./img/fav/favc.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>よくある質問｜ふくおか餃子FES</title>
</head>

<body class="l-body-sub">
    
    <?php include('inc/header.php'); ?>

    <main class="l-main-faq-cu">
        <h1 class="c-section-title c-faq-cu" data-sub-title="FAQ">よくあるご質問</h1>
        <nav class="c-nav-page">
            <ul class="l-section-list">
                <?php foreach ($faq_category as $list): ?>
                    <li class="c-section-btn">
                        <a href=#<?php echo $list["link_id"]; ?>><?php echo $list["category"] . "▼"; ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </nav>

        <?php foreach ($faq_category as $list): ?>
            <section id="<?php echo $list["link_id"]; ?>" class="c-section">
                <h2 class="c-subsection-title"> <?php echo $list["category"]; ?></h2>
                <?php foreach ($faq as $text): ?>
                    <dl class="l-qa-list">
                        <?php if ($text["type"] === $list["id"]): ?>
                            <dt class="c-question"><span class="c-q">Q. </span><?php echo $text["question"]; ?></dt>
                            <dd class="c-answer"><span class="c-a">A. </span><?php echo $text["answer"]; ?></dd>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </dl>
            </section>
        <?php endforeach; ?>

       <div class="c-btn c-btn--yellowred">
            <a class="c-btn_link c-contact-btn" href="contact.html">お問い合わせ</a>
        </div>
    </main>

    <?php include('inc/footer.php'); ?>
   
    <!-- トップに戻るボタン -->
    <div id="page-top">
        <a href="#pagetop" class="c-pagetop-btn c-pagetop-btn-position"><img src="./img/top.svg" alt="トップへ戻る"></a>
    </div>
    <script src="./js/humberger-menu.js"></script>
    <!-- js -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./js/pagetop-btn.js"></script>

</body>

</html>