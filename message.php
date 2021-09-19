<?php
include_once "db_config.php";
?>
<!doctype html>
<html lang="ru">
<head>
    <title>Комментарии</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<h1>Просмотр коментариев к сообщению</h1>
<a href="index.php">На главную</a>

<?php
if ($_GET['id_message']){
    $id_message = (int)$_GET['id_message'];
    try {

        $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS);

        $query = "SELECT id,message  FROM `messages`  WHERE id = $id_message";
        $result = $db->query($query);

        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br /><br />';

        $row = $result->fetch(PDO::FETCH_ASSOC);

        ?>
        <h3><?= $row['message'] ?></h3>
        <a href="changes.php?id_message=<?= $row['id'] ?>" >
            <p> Редактировать Сообщение</p>
        </a>
        <a href="message.php?id_message=<?= $row['id'] ?>&del_message=<?= $row['id'] ?>" >
            <p>Удалить сообщение</p>
        </a>
        <hr>
        <?


        $query = "SELECT messages.id, messages.title, messages.message, messages.short_message, messages.author, comments.comment, comments.id as c_id FROM `comments` 
LEFT JOIN  `messages` ON comments.id_message = messages.id WHERE comments.id_message = $id_message";
        $result = $db->query($query);

        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br /><br />';



        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <h3><?= $row['comment'] ?></h3>

            <a href="message.php?id_message=<?= $row['id'] ?>&update=<?= $row['c_id'] ?>" >
            <p> Редактировать комментарий</p>
            </a>
            <a href="message.php?id_message=<?= $row['id'] ?>&del_comment=<?= $row['c_id'] ?>" >
                <p>Удалить комментарий</p>
            </a>
            <hr>


            <?
        }
    }
    catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
if ($_GET['del_comment']){

    try {

        $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS);
        $del_comment = (int)$_GET['del_comment'];
        $rows = $db->exec("DELETE FROM `comments` WHERE id = $del_comment");

        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br />';

    }
    catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    echo "<meta http-equiv='Refresh' content='0; URL=message.php?id_message=$id_message'>";

}
if ($_GET['del_message']){

    try {

        $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS);
        $id_message = (int)$_GET['id_message'];
        $rows = $db->exec("DELETE FROM `messages` WHERE id = $id_message");





        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br />';

    }
    catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
      echo "<meta http-equiv='Refresh' content='0; URL=index.php'>";
}
if ($_GET['update']){
    $c_id=(int)$_GET['update'];
        echo "<meta http-equiv='Refresh' content='0; URL=changes_comment.php?c_id=$c_id&id_message=$id_message'>";

}



?>


<a href="new_comment.php?id_message=<?=$id_message?>">Добавить Комментарий</a>
</body>
</html>
