<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <!-- meta個別設定 -->
    <meta name="description" content="お知らせ｜ふくおか餃子FES">
    <meta name="keywords" content="お知らせ,餃子,新着情報">
    <meta name="author" content="ふくおか餃子FES実行委員会">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="お知らせ｜ふくおか餃子FES">
    <meta property="og:description" content="ご当地餃子や創作餃子が楽しめるフードフェス！">
    <meta property="og:image" content="">
    <meta property="og:image:alt" content="お知らせ｜ふくおか餃子FES">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <!-- ファビコン -->
    <link rel="icon" href="./img/fav/favc.png" type="image/png">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>お知らせ | ふくおか餃子FES</title>
</head>

<body class="l-body-sub">

    <?php include('inc/header.php');
    ?>

    <main class="l-news">
        <section class="l-news-content">
            <h1 class="c-section-title" data-sub-title="News">お知らせ</h1>
            <div class="l-news-item__list">
                <article class="c-news-item">
                    <p class="c-news-item__data"><time datetime="2030-02-25">2030.2.25（月）</time></p>
                    <details class="c-news-item__details" id="news1">
                        <summary class="c-news-item__summary">
                            <h2 class="c-news-item__title">出店者インタビュー&emsp;博多区で人気の「博多ぎょうざ堂」</h2>
                        </summary>
                        <div class="c-news-item__body">
                            <p class="c-news-item__text">テキストテキストテキストテキスト</p>
                        </div>
                    </details>
                </article>
                <article class="c-news-item">
                    <p class="c-news-item__data"><time datetime="2023-02-23">2030.2.23（土）</time></p>
                    <details class="c-news-item__details" id="news2">
                        <summary class="c-news-item__summary">
                            <h2 class="c-news-item__title">出店企業様募集中！</h2>
                        </summary>
                        <div class="c-news-item__body">
                            <img class="c-news-item__img" src="./img/news/news-sample-image-s.png" alt="">
                            <p class="c-news-item__text">テキストテキストテキストテキストテキストテキストテキストテキスト<br>
                                テキストテキストテキストテキストテキストテキストテキスト<br>
                                テキストテキストテキストテキストテキスト</p>
                        </div>
                    </details>
                </article>
                <article class="c-news-item">
                    <p class="c-news-item__data"><time datetime="2023-02-16">2030.2.16（土）</time></p>
                    <details class="c-news-item__details" id="news3">
                        <summary class="c-news-item__summary">
                            <h2 class="c-news-item__title">ふくおか餃子FES開催決定！</h2>
                        </summary>
                        <div class="c-news-item__body">
                            <img class="c-news-item__img" src="./img/news/news-sample-image-l.png" alt="">
                            <p class="c-news-item__text">テキストテキストテキストテキストテキストテキストテキストテキスト<br>
                                テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>
                                テキストテキストテキストテキストテキストテキストテキスト<br>
                                テキストテキストテキストテキストテキスト</p>
                        </div>
                    </details>
                </article>
            </div>
        </section>
    </main>

    <?php include('inc/footer.php');
    ?>

    <script>
        // 開閉状態毎にクラスを付与して、その時に合わせた表示になるように実行
        document.querySelectorAll(".c-news-item__details").forEach((details) => {
            const body = details.querySelector(".c-news-item__body");
            if (!body) return;

            // 初期状態（最初からopenなら即表示）
            if (details.open) details.classList.add("is-open", "is-icon-open");

            details.addEventListener("toggle", () => {
                // 閉じるときはリセット
                if (!details.open) {
                    details.classList.remove("is-animation", "is-open", "is-icon-open");
                    return;
                }

                // 開いた瞬間にアイコンを回す（本文アニメ開始と同時）
                details.classList.add("is-icon-open");

                // アニメーション実行のためにis-animationクラスを付与
                details.classList.remove("is-open");
                details.classList.add("is-animation");

                // 終了後の状態を固定するためにアニメーション完了後にis-open, is-icon-openクラスを付与
                body.addEventListener("animationend", (e) => {
                    if (e.target !== body) return;

                    details.classList.remove("is-animation");
                    details.classList.add("is-open");
                }, {
                    once: true
                });
            });

            // IDに合わせて開く対象を判定
            // クエリからopenを取得
            const params = new URLSearchParams(location.search);
            const targetId = params.get("open");
            if (!targetId) return;

            const target = document.getElementById(targetId);
            const isDetails = target && target.tagName.toLowerCase() === "details";
            if (isDetails) {
                // 開閉処理
                target.open = true;
                // スクロール一の基準は親クラスに合わせる（念のために見つからなかったらそのままスクロール）
                const wrapper = target.closest(".c-news-item");
                (wrapper ?? target).scrollIntoView({
                    block: "start",
                    behavior: "smooth"
                });
            }
        });
    </script>
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