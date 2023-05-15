<?

$URI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

session_start();

$connect = new mysqli('localhost', 'root', '', 'tags');

function db_select($table, $args = []) //получение записи из БД
{
    global $connect;

    $where_sql = "";

    if (!empty($args) && is_array($args)) {
        $where_sql = "WHERE ";

        foreach ($args as $column => $value) {
            $where_sql .= "`$column`='$value' AND";
        }

        $where_sql = substr($where_sql, 0, -4);
    }

    return $connect->query("SELECT * FROM `$table` $where_sql");
}

function db_insert($table, $args = []) // создание записей в табллице
{
    global $connect;

    $column_sql = "";
    $value_sql = "";

    if (!empty($args) && is_array($args)) {
        foreach ($args as $column => $value) {
            $column_sql .= "`$column`,";
            $value_sql .= "'$value',";
        }

        $column_sql = substr($column_sql, 0, -1);
        $value_sql = substr($value_sql, 0, -1);
    }

    return $connect->query("INSERT INTO `$table`($column_sql) VALUES ($value_sql)");
}

function get_tags()
{
    return db_select('tag');
}

function get_fields()
{
    return db_select('field');
}

function get_channels()
{
    return db_select('channel');
}

function get_field_tag($field_id = null)
{
    global $connect;

    $where_sql = '';

    if ($field_id) {
        $where_sql = "WHERE `field_id` = '$field_id'";
    }

    $sql = "SELECT * FROM `field_tag` JOIN `tag` ON `tag`.`id`=`field_tag`.`tag_id` $where_sql";

    return $connect->query($sql);
}

function get_messages($tag_id = null)
{
    global $connect;

    $where_tag_sql = '';
    $where_user_sql = '';

    $select_sql = "SELECT `message`.*, `user`.`name` as `user_name`, `channel`.`title` as `channel` FROM `message`";
    $join_sql = "JOIN `user` ON `user`.`id`=`message`.`user_id` JOIN `channel` ON `channel`.`id`=`message`.`channel_id`";

    if ($tag_id) {
        $where_tag_sql = "`tag_id`='$tag_id' AND";
    }

    if (empty($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $where_user_sql = "UNION $select_sql $join_sql WHERE $where_tag_sql `user_id`='$user_id' AND `is_save` = '1'";
    }

    $user_id = $_SESSION['user']['id'];

    $sql = "$select_sql $join_sql WHERE $where_tag_sql `is_save` = '0' $where_user_sql";

    return $connect->query($sql);
}

function get_favorite_messages()
{
    global $connect;

    $user_id = $_SESSION['user']['id'];

    $sql = "SELECT `favorite`.`id` as `favorite_id`, `message`.*, `user`.`name` as `user_name`, `channel`.`title` FROM `favorite`
    JOIN `message` ON `message`.`id`=`favorite`.`message_id`
    JOIN `channel` ON `channel`.`id`=`message`.`channel_id`
    JOIN `user` ON `user`.`id`=`message`.`user_id`
    WHERE `favorite`.`user_id`='$user_id'";

    return $connect->query($sql);
}

function login($email, $password)
{
    $password = md5($password);

    $get_user = db_select(
        'user',
        [
            'email' => $email,
            'password' => $password
        ]
    );

    if ($get_user->num_rows < 1) return 'Неправильный логин или пароль';

    $_SESSION['user'] = $get_user->fetch_assoc(); // нормализация для PHP
    header("Location: /message.php"); // переводит на message.php
}

function register($name, $email, $password)
{
    global $connect;

    $password = md5($password); //хешируется

    $get_user = db_select('user', [
        'email' => $email
    ]);

    if ($get_user->num_rows > 0) return 'Email уже существует'; //

    $query = db_insert('user', [
        'name' => $name,
        'email' => $email,
        'password' => $password
    ]);

    if (!$query) return 'Ошибка, все плохо :(';

    $user_id = mysqli_insert_id($connect); //получаю id из созданной id
    $_SESSION['user'] = db_select('user', [
        'id' => $user_id
    ])->fetch_assoc(); //ищу user после создаю сессию
    header("Location: /message.php");
}

function set_message($query, $access = null, $error = null)
{
    return $query ? ($access ?? 'Добавлено') : ($error ?? 'Ошибка при добавлении');
}

function add_field($title, $description)
{
    $query = db_insert('field', [
        'title' => $title,
        'description' => $description
    ]);

    return set_message($query);
}

function add_channel($title, $description)
{
    $query = db_insert('channel', [
        'title' => $title,
        'description' => $description
    ]);

    return set_message($query);
}

function add_field_tag($field_id, $tag_id)
{
    global $connect;

    $get_field_tag = db_select('field_tag', [
        'field_id' => $field_id,
        'tag_id' => $tag_id
    ]);

    if ($get_field_tag->num_rows > 0) return 'Связь уже существует';

    $query = db_insert('field_tag', [
        'field_id' => $field_id,
        'tag_id' => $tag_id
    ]);

    return set_message($query);
}

function add_message($channel_id, $tag_id, $data, $is_save)
{
    $query = db_insert('message', [
        'channel_id' => $channel_id,
        'tag_id' => $tag_id,
        'user_id' => $_SESSION['user']['id'],
        'data' => $data,
        'is_save' => $is_save
    ]);

    return set_message($query);
}

function add_favorite($message_id)
{
    $get_favorite = db_select('favorite', [
        'message_id' => $message_id,
        'user_id' => $_SESSION['user']['id']
    ]);

    if ($get_favorite->num_rows > 0) return;

    $query = db_insert('favorite', [
        'message_id' => $message_id,
        'user_id' => $_SESSION['user']['id']
    ]);

    return $query;
}

function delete_favorite($favorite_id)
{
    global $connect;

    $user_id = $_SESSION['user']['id'];

    return $connect->query("DELETE FROM `favorite` WHERE `id`='$favorite_id' AND `user_id`='$user_id'"); // проверка если UserId создал фаворит
}

require_once __DIR__ . './components/nav.php';
