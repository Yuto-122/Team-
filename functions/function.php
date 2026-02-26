<?php
require_once __DIR__ . "/../inc/db_info.php";

function debug_check($array){
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function db_connect(){
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}