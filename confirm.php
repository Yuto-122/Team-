<?php
require_once __DIR__ . "../functions/function.php";

session_start();
$name = $_POST["name"];
$kana = $_POST["kana"];
$email = $_POST["email"];
$message = $_POST["message"];

$_SESSION["name"] = $name;
$_SESSION["kana"] = $kana;
$_SESSION["email"] = $email;
$_SESSION["message"] = $message;
?>

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
    .c-btn {
        display: flex;
        justify-content: center;
        gap: 8em;
    }

    .c-btn_link {
        margin: 2em 0 0 0;
    }

    .l-form-main {
        background-color: #b8b8b8;
    }

    #message {
        background-color: transparent;
    }
</style>

<body class="l-body-sub">

<!-- ヘッダーphp -->
 <?php include("inc/header.php"); ?>
    <main class="l-main-faq-cu">
        <h1 class="c-section-title c-faq-cu" data-sub-title="Contact Us">お問い合わせ</h1>
        <p class="c-describe"><b>以下の内容で送信してもよろしいですか？</b></p>
        <p class="c-caution">※回答に数日を要する場合がございますこと予めご了承ください。</p>
        <form class="l-form" action="send.php" method="post">
            <div class="l-form-main">
                <label class="c-label" for="name"><span class="c-required">必須</span>お名前</label><br>
                <input type="hidden" id="name" name="name" value="<?php echo h($name); ?>" readonly>
                <p><?php echo h($name); ?></p><br>
                <label class="c-label" for="kana"><span class="c-required">必須</span>フリガナ</label><br>
                <input type="hidden" id="kana" name="kana" value="<?php echo h($kana); ?>" readonly>
                <p><?php echo h($kana); ?></p><br>

                <!-- メールアドレス -->
                <label class="c-label" for="email"><span class="c-required">必須</span>メールアドレス</label><br>
                <input type="hidden" id="email" name="email" value="<?php echo h($email); ?>" readonly>
                <p><?php echo h($email); ?></p><br>

                <!-- 問い合わせ内容 -->
                <label class="c-message" for="message"><span class="c-required">必須</span>お問い合わせ内容</label><br>
                <textarea id="message" name="message" readonly><?php echo h($message); ?></textarea>
            </div>

            <!-- 確認ボタン -->
            <div class="c-btn c-btn--yellowred">
                <a href="contact.php"><button class="c-btn_link c-btn-confirm" type="button">入力画面に戻る</button></a>
                <button class="c-btn_link c-btn-confirm" type="submit" value="送信">送信する</button>
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

</body>

</html>