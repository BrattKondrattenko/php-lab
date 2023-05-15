<?
require_once './functions.php';

$tag = $_GET['tag'];

$messages = get_messages($tag);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <title>Сообщения</title>
</head>

<body>
    <header>
        <?= get_nav(); ?>
    </header>
    <main class="pt-5">
        <div class="container">
            <h3>Выберите тег</h3>
            <form class="mb-4 d-flex align-items-end">
                <div class="me-3 flex-grow-1">
                    <label for="tag" class="form-label">Тег</label>
                    <select class="form-control" id="tag" name="tag" required>
                        <? foreach (get_tags() as $tag) : ?>
                            <option value="<?= $tag['id'] ?>"><?= $tag['title'] ?></option>
                        <? endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Поиск</button>
            </form>
            <h3>Сообщения</h3>
            <? if ($messages->num_rows < 1) : ?>
                <div>Сообщений нет</div>
            <? else : ?>
                <ol class="list-group list-group-numbered">
                    <? foreach ($messages as $message) : ?>
                        <li class="list-group-item d-flex">
                            <div class="ms-2">
                                <div><strong>Канал:</strong> <?= $message['channel'] ?></div>
                                <div><strong>Пользователь:</strong> <?= $message['user_name'] ?></div>
                                <div><strong>Сообщение:</strong> <?= $message['data'] ?></div>
                                <a class="link" href="/http/add_favorite.php?id=<?= $message['id'] ?>">Добавить в избранное</a>
                            </div>
                        </li>
                    <? endforeach; ?>
                </ol>
            <? endif; ?>
        </div>
    </main>
</body>

</html>