<?php
require_once __DIR__ . "/../inc/db_info.php";

function debug_check($array)
{
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function db_connect()
{
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}

function check_logined()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["admin_session_id"])) {
        header("location:login.php");
        exit();
    }
}

// Admin内のシステムメッセージの種類
enum MsgStatus
{
    case SUCCESS;
    case WARNING;
    case ERROR;
}

// メッセージ本文
enum MsgContent: string
{
    // 共通文言
    case COMMON_ERROR = "問題が発生しました。";
    case COMMON_EXCEPTION = "例外が発生しました。<br>";
    case COMMON_USED = "すでに使用されています。<br>";

    case USER_PREG_MATCH = "ユーザー名は 半角英数4文字以上 にしてください";
    case USER_ADD = "ユーザーを追加しました。<br>ユーザー名: ";
    case USER_DELETE = "ユーザーを削除しました。";
    case USER_EDIT = "ユーザーを編集しました。<br>ユーザー名: ";

    case SUPPORT_STATUS_ADD = "対応状況ステータスを追加しました。<br>ステータス名: ";
    case SUPPORT_STATUS_EDIT = "対応状況ステータスを編集しました。<br>ステータス名: ";

    case FAQ_CATEGORY_ADD = "質問カテゴリを追加しました。<br>質問カテゴリ名: ";
    case FAQ_CATEGORY_EDIT = "質問カテゴリを修正しました。<br>質問カテゴリ名: ";

    case FAQ_ADD = "FAQを追加しました。<br>質問: ";
    case FAQ_DELETE = "FAQを削除しました。";
    case FAQ_EDIT = "FAQを編集しました。<br>質問: ";

    case CONTACT_EDIT = "お問い合わせのステータスを変更しました。<br>ID: ";
    case CONTACT_DELETE = "お問い合わせを削除しました。<br>ID: ";

    case SHOP_ADD = "店舗情報を追加しました。<br>店舗名: ";
    case SHOP_EDIT = "店舗情報を変種しました。<br>店舗名: ";
    case SHOP_USED_BOOTH = "そのブースは登録済みです<br>ブース名: ";
    case SHOP_PREG_MATCH = "読み仮名は 全角ひらがなカタカナ を使用してください";

    case LOGOUT = "ログアウトしました。";
    case LOGIN_FAILD = "ログイン失敗しました。";
}

// Admin内のシステムメッセージを登録
function set_admin_system_message($msg, $msg_status)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION["msg"] = $msg;
    $_SESSION["msg_status"] = $msg_status;
}

// Admin内のシステムメッセージを削除
function unset_admin_system_message()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    unset($_SESSION["msg"]);
    unset($_SESSION["msg_status"]);
}

// ログファイルにメッセージを追記
function set_error_log($msg)
{
    http_response_code(500);
    date_default_timezone_set("Asia/Tokyo");
    //呼び出し元のファイル情報を取得
    $associative_array = debug_backtrace();
    $err_msg = "[" . date('Y-m-d H:i:s') . "]" . "[" . $associative_array[0]["file"] . "]" . $msg . "\n";
    // 追記モードでエラー文をログファイルに書き込む
    file_put_contents(__DIR__ . "/../log/error.txt", $err_msg, FILE_APPEND);
}

// ソートパラメータ取得処理
function get_sort_params($sortable, $sort, $dir, $default_sort = "id", $default_dir = "asc")
{
    if (!isset($sortable[$sort])) {
        $sort = $default_sort;
    }

    if ($dir !== "asc" && $dir !== "desc") {
        $dir = $default_dir;
    }

    return [
        "sort" => $sort,
        "dir" => $dir,
        "order_by" => $sortable[$sort] . " " . strtoupper($dir),
    ];
}

// ソート切り替え処理
function next_sort_dir($current_sort, $clicked_sort, $current_dir)
{
    if ($current_sort === $clicked_sort) {
        return $current_dir === "asc" ? "desc" : "asc";
    }
    return "asc";
}
