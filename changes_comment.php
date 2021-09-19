<?php
include_once "db_config.php";
?>
<?php
if ($_GET){
    $c_id = (int)$_GET['c_id'];




    try {

        $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS);

        $query = "SELECT *  FROM `comments` WHERE id = $c_id";
        $result = $db->query($query);


        $error_array = $db->errorInfo();

        if ($db->errorCode() != 0000)

            echo "SQL ошибка: " . $error_array[2] . '<br />';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

           $comment = $row['comment'];

        }
    }
    catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_POST){

    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $id_message = (int)$_GET['id_message'];

    try {

        $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS);

        $rows = $db->exec("UPDATE `comments` SET 
        comment='$comment' WHERE id = $c_id");

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
    <title>Просмотр списка</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<a href="index.php">На главную</a>
<form action="" method="post">


    <p> Комментарий</p>
    <textarea type="text" required name="comment"  cols="30" rows=5"><?=$comment ?></textarea>
    <input type="submit" >

</form>

</body>
</html>