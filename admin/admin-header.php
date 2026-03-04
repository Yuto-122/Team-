    <?php
    require_once __DIR__ . "/../functions/function.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top px-3">
        <a class="navbar-brand" href="./index.php">管理者ページ</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <a class="nav-link" href="./logout.php">ログアウト</a></li>
            </ul>
        </div>
        <?php if (isset($_SESSION["name"])): ?>
            <span class="text-light">ログイン: <?php echo $_SESSION["name"]; ?></span>
        <?php endif; ?>
    </nav>