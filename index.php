<?php

include_once "db_config.php";
$homepage = file_get_contents('head.html');
echo $homepage;

if (isset($_GET['page'])){

    $page =(int) $_GET['page'];

}else {
    $page = 1;
    };
$kol = 2;
$art = ($page * $kol) - $kol;
?>
    <body>
    <h1>Просмотр списка сообщений</h1>
    <a href="new_message.php">Добавить сообщение</a>
    </body>
    </html>

<?php
include_once "connect.php";
try {

    $query = "SELECT *  FROM `messages` LIMIT $art,$kol";
    $result = $db->query($query);

    $error_array = $db->errorInfo();

    if ($db->errorCode() != 0000)

        echo "SQL ошибка: " . $error_array[2] . '<br /><br />';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        ?><a href="message.php?id_message=<?= $row['id'] ?>" >
        <h3><?= $row['title'] ?></h3>
        <p><?= $row['short_message'] ?></p>
        </a>
        <hr>

    <?};


    $query = "SELECT *  FROM `messages`";
    $result = $db->query($query);
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    ?><div  class="str"><?
    for ($i = 1 ; $i < count($row); $i++) {

        ?><a class="button" href="?page=<?= $i ?>" >
        <p>Страница №<?= $i ?></p>
        </a>

         <? };
    ?>

    </div >
<?

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>