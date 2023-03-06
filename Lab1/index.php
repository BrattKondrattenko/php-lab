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
        <h2 class="header__title">Hello, world! Lab №1</h2>
    </header>
    <main>
        <?php
        $pics = array("img/image1.jpg", "img/image2.jpg", "img/image3.jpg", "img/image4.jpg", "img/image5.jpg", "img/image4.jpg");
        for ( $i = 0 ; $i < 6 ; $i++ ) {
            echo "<img src=\"$pics[$i]\" width=\"400px\">";
        }
        ?>
    </main>
    <footer>
        <h2 class="footer__title">Кондратенко Андрей Викторович 221-322</h2>
    </footer>
</div>
</body>
</html>