<?php
include_once "db_config.php";
$homepage = file_get_contents('head.html');
echo $homepage;

if ($_POST) {
    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $id_message = (int)$_GET['id_message'];
    var_dump($id_message);
    try {
        include_once "connect.php";

        $rows = $db->exec("INSERT INTO `comments` VALUES
		(null, '$id_message','$comment')
	");
        echo "<meta http-equiv='Refresh' content='0; URL=message.php?id_message=$id_message'>";


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
    <textarea type="text" required name="comment" cols="30" rows="5" placeholder="новый комментарий"></textarea>
    <input type="submit">
</form>
</body>
</html>