<?

function get_nav()
{
    global $URI;

    $links_html = "";

    $links = [
        [
            'href' => '/',
            'name' => 'Авторзиация'
        ],
        [
            'href' => '/add_field.php',
            'name' => 'Добавить область знаний'
        ],
        [
            'href' => '/add_chanel.php',
            'name' => 'Создать канал'
        ],
        [
            'href' => '/add_message.php',
            'name' => 'Отправить сообщение'
        ],
        [
            'href' => '/tag_to_field.php',
            'name' => 'Добавление тега к области знания'
        ],
        [
            'href' => '/tags.php',
            'name' => 'Теги'
        ],
        [
            'href' => '/message.php',
            'name' => 'Сообщения'
        ],
        [
            'href' => '/favorite.php',
            'name' => 'Избранное'
        ]
    ];

    if (!empty($_SESSION['user'])) {
        $links = array_slice($links, 1);
    }

    foreach ($links as $link) {
        if ($URI === $link['href']) {
            $links_html .= '<a class="nav-link active" aria-current="page" href="' . $link['href'] . '">' . $link['name'] . '</a>';
            continue;
        }

        $links_html .= '<a class="nav-link" href="' . $link['href'] . '">' . $link['name'] . '</a>';
    }

    return '<nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                    ' . $links_html . '
                    </div>
                </div>
            </div>
        </nav>';
}
