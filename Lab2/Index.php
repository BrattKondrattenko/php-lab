<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP lab_1</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container">
    <header>
        <img src="img/logo.png" alt="logo" width="250px">
        <h2 class="header__title">Form Lab №2</h2>
    </header>
    <main>
        <form action="https://httpbin.org/post" method="POST">
            <div class="email__block">
                <input name="name" required placeholder="Имя" id="input__email" type="email">
                <label class="email__label" for="input__email">Ваше имя</label>
            </div>
            <div class="email__block">
                <input name="email" required placeholder="ivan@mail.ru" id="input__email" type="email">
                <label class="email__label" for="input__email">E-mail</label>
            </div>
            <select class="select__block" name="id">
                <option value="1">Благодарность</option>
                <option value="2">Жалоба</option>
                <option value="3">Предложение</option>
            </select>

            <label class="labelSms" for="sms">Вариант ответа:</label>
            <div class="form__checkbox">
                <label for="e-mail"></label>
                <input type="checkbox" name="SMS" id="sms" checked><span>sms</span>
                <input type="checkbox" name="E-mail" id="e-mail"><span>e-mail</span>
            </div>

            <button class="button" type="submit"> <span>Отправить</span></button>
            <a class="button next__btn" href="./form.php">Перейти к форме</a>
    </main>
    <footer>
        <h2 class="footer__title">Кондратенко Андрей Викторович 221-322</h2>
    </footer>
</div>
</body>
</html>