<?
require_once './functions.php';

$tag = $_POST['tag'];
$field = $_POST['field'];
$req = null;

if (isset($_POST['btn_add'])) {
    $req = add_field_tag($field, $tag);
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
    <title>Привязка тега к области знаний</title>
</head>

<body>
    <header>
        <?= get_nav(); ?>
    </header>
    <main class="pt-5">
        <div class="container">
            <h3>Привязка тега к области знаний</h3>
            <? if ($req) : ?>
                <h6><?= $req ?></h6>
            <? endif; ?>
            <form class="mb-4" method="post">
                <div class="mb-2">
                    <label for="tag" class="form-label">Тег</label>
                    <select class="form-control" id="tag" name="tag" required>
                        <? foreach (get_tags() as $tag) : ?>
                            <option value="<?= $tag['id'] ?>"><?= $tag['title'] ?></option>
                        <? endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="field" class="form-label">Область знаний</label>
                    <select class="form-control" id="field" name="field" required>
                        <? foreach (get_fields() as $field) : ?>
                            <option value="<?= $field['id'] ?>"><?= $field['title'] ?></option>
                        <? endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="btn_add">Добавить</button>
            </form>
        </div>
    </main>
</body>

</html>