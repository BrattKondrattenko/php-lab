<?
require_once __DIR__ . './../functions.php';

$id = $_REQUEST['id'];
$req = delete_favorite($id);

$message = $req ? 'Удалено' : 'Произошла ошибкка';

header("Refresh:2; url=" . $_SERVER['HTTP_REFERER']);

?>

<div class="container pt-5">
    <div class="alert alert-primary" role="alert">
        <?= $message ?>
    </div>
</div>