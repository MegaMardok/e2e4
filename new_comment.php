<?php
include_once "db_config.php";
?>


<?php
if ($_POST){
    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $id_message = (int)$_GET['id_message'];
    var_dump($id_message);
    try {

        $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS);

        $rows = $db->exec("INSERT INTO `comments` VALUES
		(null, '$id_message','$comment')
	");
        echo "<meta http-equiv='Refresh' content='0; URL=message.php?id_message=$id_message'>";


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
    <title>Новый комментарий</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<a href="index.php">На главную</a>
<form action="" method="post">

    <textarea type="text" required name="comment"  cols="30" rows="5" placeholder="новый комментарий"></textarea>
    <input type="submit" >

</form>

</body>
</html>
