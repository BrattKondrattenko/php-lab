<?
require_once './functions.php';

$field = $_GET['field'];

$tags = get_field_tag($field);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <title>Область знаний</title>
</head>

<body>
    <header>
        <?= get_nav(); ?>
    </header>
    <main class="pt-5">
        <div class="container">
            <h3>Выберите область знаний</h3>
            <form class="mb-4 d-flex align-items-end" method="get">
                <div class="me-3 flex-grow-1">
                    <label for="tag" class="form-label">Область знаний</label>
                    <select class="form-control" id="tag" name="field" required>
                        <? foreach (get_fields() as $filed) : ?>
                            <option value="<?= $filed['id'] ?>"><?= $filed['title'] ?></option>
                        <? endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Поиск</button>
            </form>
            <h3>Теги</h3>
            <? if ($tags->num_rows < 1) : ?>
                <div>Теги не найдены</div>
            <? else : ?>
                <ol class="list-group list-group-numbered">
                    <? foreach ($tags as $tag) : ?>
                        <li class="list-group-item"><?= $tag['title'] ?></li>
                    <? endforeach; ?>
                </ol>
            <? endif ?>
        </div>
    </main>
</body>

</html>