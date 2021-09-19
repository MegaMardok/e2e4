<?php
include_once "db_config.php";
$homepage = file_get_contents('head.html');
echo $homepage;
if ($_GET) {
    $id_message = (int)$_GET['id_message'];
    include_once "connect.php";
    try {

        $query = "SELECT *  FROM `messages` WHERE id = $id_message";
        $result = $db->query($query);

        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br />';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            $author = $row['author'];
            $title = $row['title'];
            $short_message = $row['short_message'];
            $message = $row['message'];

        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_POST) {

    $author = htmlspecialchars(strip_tags($_POST['author']));
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $short_message = htmlspecialchars(strip_tags($_POST['short_message']));
    $message = htmlspecialchars(strip_tags($_POST['message']));
    include_once "connect.php";
    try {
        $rows = $db->exec("UPDATE `messages` SET 
        title='$title', short_message='$short_message', message= '$message', author= '$author' WHERE id = $id_message");

        echo "<meta http-equiv='Refresh' content='0; URL=index.php'>";

        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br />';

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<body>
<a href="index.php">На главную</a>
<form action="" method="post">
    <p> Ваше имя</p>
    <textarea type="text" required name="author"><?= $author ?></textarea>
    <p> Заголовок</p>
    <textarea type="text" required name="title"><?= $title ?></textarea>
    <p> Краткое описание</p>
    <textarea type="text" required name="short_message"><?= $short_message ?></textarea>
    <p> Сообщение</p>
    <textarea type="text" required name="message" cols="30" rows=5"><?= $message ?></textarea>
    <input type="submit">

</form>

</body>
</html>