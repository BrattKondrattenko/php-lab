<?
require_once './functions.php';

if (!empty($_SESSION['user'])) {
    header('Location: /message.php');
}

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($_POST['btn_log'])) {
    login($email, $password);
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
    <title>Вход</title>
</head>

<body>
    <header>
        <?= get_nav(); ?>
    </header>
    <main class="pt-5">
        <div class="container">
            <h3>Вход</h3>
            <form class="mb-4" method="post">
                <div class="mb-2">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label" name="password">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="btn_log">Войти</button>
            </form>
            <a class="link" href="/register.php">Регистрация</a>
        </div>
    </main>
</body>

</html>