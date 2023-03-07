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
        <div class="answer">
            <textarea name="headers" id="output" cols="45" rows="13">
                <?php
                $url = "http://httpbin.org/post";
                print_r(get_headers($url));
                ?>
            </textarea>
        </div>
    </main>
    <footer>
        <h2 class="footer__title">Кондратенко Андрей Викторович 221-322</h2>
    </footer>
</div>
</body>
</html>
