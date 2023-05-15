<?
require_once './functions.php';

if (empty($_SESSION['user'])) {
    header('Location: /');
}

$channel = $_POST['channel'];
$tag = $_POST['tag'];
$data = $_POST['data'];
$is_save = $_POST['is_save'] ? 1 : 0;
$req = null;

if (isset($_POST['btn_add'])) {
    $req = add_message($channel, $tag, $data, $is_save);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <title>Отправка сообщения</title>
</head>

<body>
    <header>
        <?= get_nav(); ?>
    </header>
    <main class="pt-5">
        <div class="container">
            <h3>Отправка сообщения</h3>
            <? if ($req) : ?>
                <h6><?= $req ?></h6>
            <? endif; ?>
            <form class="mb-4" method="post">
                <div class="mb-2">
                    <label for="channel" class="form-label">Канал</label>
                    <select class="form-control" id="channel" name="channel" required>
                        <? foreach (get_channels() as $channel) : ?>
                            <option value="<?= $channel['id'] ?>"><?= $channel['title'] ?></option>
                        <? endforeach ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="tag" class="form-label">Тег сообщения</label>
                    <select class="form-control" id="tag" name="tag" required>
                        <? foreach (get_tags() as $tag) : ?>
                            <option value="<?= $tag['id'] ?>"><?= $tag['title'] ?></option>
                        <? endforeach ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="data" class="form-label" required>Текст сообщения</label>
                    <textarea class="form-control" id="data" name="data" rows="3" required></textarea>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="is_save" id="is_save" name="is_save">
                    <label class="form-check-label" for="is_save">Приватное?</label>
                </div>
                <button type="submit" class="btn btn-primary" name="btn_add">Отправить</button>
            </form>
        </div>
    </main>
</body>

</html>