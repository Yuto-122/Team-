<?php
require_once __DIR__ . "/../functions/function.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["msg"]) || !isset($_SESSION["msg_status"])) {
    // セッション内にメッセージ関連のデータが無かったら何もしない
    return;
}

$border_color = "";

$status = Msg_Status::Success;
$status = $_SESSION["msg_status"];

$msg_bg_color = match ($status) {
    Msg_Status::Success => "bg-success-subtle",
    Msg_Status::Warning => "bg-warning-subtle",
    Msg_Status::Error => "bg-danger-subtle",
};
?>

<!-- メッセージログの表示 -->
<div class="mt-2 border border-2 <?php echo $msg_bg_color ?>">
    <p class="m-3">
        <?php echo $_SESSION["msg"]; ?>
    </p>
</div>

<?php
// セッション内のメッセージデータを削除
unset_admin_system_message();
?>