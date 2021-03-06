<?php

session_start();

require_once 'functions/db.php';
require_once 'functions/filters.php';
require_once 'functions/template.php';
require_once 'functions/time.php';
require_once 'functions/auth.php';

$config = require 'config.php';
$connection = connect($config['db']);
$categories = get_all_categories($connection);
$lots = get_all_lots($connection);
$user = auth_user_by_session($connection);

$page_content = include_template(
    'index.php',
    ['categories' => $categories,
    'lots' => $lots]
);

$layout_content = include_template(
    'layout.php',
    ['title' => 'YetiCave - Главная страница',
    'user' => $user,
    'categories' => $categories,
    'content' => $page_content,]
);

print($layout_content);
