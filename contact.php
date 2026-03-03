<?php
require_once __DIR__ . "../functions/function.php";
session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <!-- meta個別設定 -->
    <meta name="description" content="お問い合わせ｜ふくおか餃子FES" />
    <meta name="keywords" content="お問い合わせ,質問,餃子">
    <meta name="author" content="ふくおか餃子FES実行委員会">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="お問い合わせ｜ふくおか餃子FES">
    <meta property="og:description" content="ご当地餃子や創作餃子が楽しめるフードフェス！">
    <meta property="og:image" content="">
    <meta property="og:image:alt" content="お問い合わせ｜ふくおか餃子FES">
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
    <title>お問い合わせ｜ふくおか餃子FES</title>
</head>
<style>
    textarea {
        resize: none;
    }
</style>

<body class="l-body-sub">
    
    <!-- ヘッダーphp -->
    <?php include("inc/header.php"); ?>

    <main class="l-main-faq-cu">
        <h1 class="c-section-title c-faq-cu" data-sub-title="Contact Us">お問い合わせ</h1>
        <P class="c-describe">お問い合わせは、以下のメールフォームをご利用ください。</P>
        <p class="c-caution">※回答に数日を要する場合がございますこと予めご了承ください。</p>

        <form class="l-form" action="confirm.php" method="post">
            <div class="l-form-main">
                <label class="c-label" for="name"><span class="c-required">必須</span>お名前</label><br>
                <input type="text" id="name" name="name" placeholder="餃子 太郎" value="<?php echo !empty(h($_SESSION["name"])) ? h($_SESSION["name"]) : ""; ?>" required><br>
                <label class="c-label" for="kana"><span class="c-required">必須</span>フリガナ</label><br>
                <input type="text" id="kana" name="kana" placeholder="ギョウザ タロウ" value="<?php echo !empty(h($_SESSION["kana"])) ? h($_SESSION["kana"]) : ""; ?>" required><br>

                <!-- メールアドレス -->
                <label class="c-label" for="email"><span class="c-required">必須</span>メールアドレス</label><br>
                <input type="email" id="email" name="email" placeholder="tarogyouza@xxxx.ne.jp" value="<?php echo !empty(h($_SESSION["email"])) ? h($_SESSION["email"]) : ""; ?>"><br>

                <!-- 問い合わせ内容 -->
                <label class="c-message" for="message"><span class="c-required">必須</span>お問い合わせ内容</label><br>
                <textarea id="message" name="message" required><?php echo !empty(h($_SESSION["message"])) ? h($_SESSION["message"]) : ""; ?></textarea>
            </div>

            <!-- 確認ボタン -->
            <div class="c-btn c-btn--yellowred">
                <button class="c-btn_link c-btn-confirm" type="submit">確認する</button>
            </div>
        </form>
    </main>

    <!-- フッターphp -->
    <?php include("inc/footer.php"); ?>

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
    <script src="./js/check.js"></script>

</body>

</html>