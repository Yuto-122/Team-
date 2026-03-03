    <?php
    require_once __DIR__ . "/../functions/function.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top px-3">
        <a class="navbar-brand" href="./index.php">管理者ページ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="./logout.php">ログアウト</a></li>
            </ul>
        </div>
        <?php if (isset($_SESSION["name"])): ?>
            <span class="text-light">ログイン: <?php echo $_SESSION["name"]; ?></span>
        <?php endif; ?>
    </nav>