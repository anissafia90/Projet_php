<?php

require_once (__DIR__ . '/../../config/database.php');

$stm = $pdo->prepare("SELECT i.title as title FROM item as i WHERE i.title LIKE ?");
$stm->bindValue(1, '%' . $_POST['title'] . '%');
$stm->execute();

$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

$json = [];

foreach ($rows as $r) {
    $json[] = $r['title'];
}

echo json_encode($json);

exit();
