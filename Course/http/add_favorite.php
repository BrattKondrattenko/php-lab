<?
require_once __DIR__ . './../functions.php';

$id = $_REQUEST['id'];


$req = add_favorite($id);

if ($req) {
    echo 'Успешно добавлено в избранное';
} else {
    echo 'Произошла ошибка';
}

header("Refresh:2; url=" . $_SERVER['HTTP_REFERER']);
