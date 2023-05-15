<?
require_once './functions.php';

$title = $_POST['title'];
$decription = $_POST['decription'];
$req = null;

if (isset($_POST['btn_add'])) {
    $req = add_field($title, $decription);
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
    <title>Добавление области знаний</title>
</head>

<body>
    <header>
        <?= get_nav(); ?>
    </header>
    <main class="pt-5">
        <div class="container">
            <h3>Добавление области знаний</h3>
            <? if ($req) : ?>
                <h6><?= $req ?></h6>
            <? endif; ?>
            <form class="mb-4" method="post">
                <div class="mb-2">
                    <label for="title" class="form-label">Название</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="btn_add">Создать</button>
            </form>
        </div>
    </main>
</body>

</html>