<?php
?>
<!doctype html>
<html lang="ru">
<head>
    <title>Просмотр списка</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<h1>Просмотр списка сообщений</h1>
<a href="new_message.php">Добавить сообщение</a>

</body>
</html>

<?php

include_once "db_config.php";

try {
    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
    $db = new PDO($connect_str, DB_USER, DB_PASS);


    $query = "SELECT *  FROM `messages` LIMIT 0,10";
    $result = $db->query($query);

    $error_array = $db->errorInfo();

    if ($db->errorCode() != 0000)

        echo "SQL ошибка: " . $error_array[2] . '<br /><br />';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

?><a href="message.php?id_message=<?=$row['id']?>" >
        <h3><?=$row['title']?></h3>
        <p><?=$row['short_message']?></p>
        </a><hr>

<? }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

