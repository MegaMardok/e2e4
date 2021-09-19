<?php
include_once "db_config.php";
$homepage = file_get_contents('head.html');
echo $homepage;
if ($_GET) {
    $c_id = (int)$_GET['c_id'];
    include_once "connect.php";
    try {

        $query = "SELECT *  FROM `comments` WHERE id = $c_id";
        $result = $db->query($query);

        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br />';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            $comment = $row['comment'];

        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_POST) {

    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $id_message = (int)$_GET['id_message'];
    include_once "connect.php";
    try {

        $rows = $db->exec("UPDATE `comments` SET 
        comment='$comment' WHERE id = $c_id");

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
    <p> Комментарий</p>
    <textarea type="text" required name="comment" cols="30" rows=5"><?= $comment ?></textarea>
    <input type="submit">
</form>
</body>
</html>