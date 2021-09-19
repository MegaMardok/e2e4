<?php
include_once "db_config.php";
$homepage = file_get_contents('head.html');
echo $homepage;

if ($_POST) {
    $author = htmlspecialchars(strip_tags($_POST['author']));
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $short_message = htmlspecialchars(strip_tags($_POST['short_message']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    try {
        include_once "connect.php";

        $rows = $db->exec("INSERT INTO `messages` VALUES
		(null, '$title','$short_message','$message','$author')
	");
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
    <input type="text" required name="author" placeholder="Ваше имя">
    <input type="text" required name="title" placeholder="Заголовок">
    <input type="text" required name="short_message" placeholder="Краткое сообщение">
    <textarea type="text" required name="message" cols="30" rows="5" placeholder="Сообщение"></textarea>
    <input type="submit">
</form>
</body>
</html>