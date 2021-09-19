<?php
include_once "db_config.php";
?>


<?php
if ($_POST){
    $author = htmlspecialchars(strip_tags($_POST['author']));
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $short_message = htmlspecialchars(strip_tags($_POST['short_message']));
    $message = htmlspecialchars(strip_tags($_POST['message']));


    try {

        $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS);

        $rows = $db->exec("INSERT INTO `messages` VALUES
		(null, '$title','$short_message','$message','$author')
	");
         echo "<meta http-equiv='Refresh' content='0; URL=index.php'>";


        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br />';

    }
     catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
}
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
<a href="index.php">На главную</a>
<form action="" method="post">
    <input type="text" required name="author" placeholder="Ваше имя">
    <input type="text" required name="title" placeholder="Заголовок">
    <input type="text" required name="short_message" placeholder="Краткое сообщение">
    <textarea type="text" required name="message"  cols="30" rows="5" placeholder="Сообщение"></textarea>
    <input type="submit" >

</form>

</body>
</html>
