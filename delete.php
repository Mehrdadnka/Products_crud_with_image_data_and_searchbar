<?php
    /** @var $pdo \PDO */

    require_once "sys/connection.php";


    $id = $_POST['id'] ?? null;
    if(!$id)
    {
        header('LOCATION: index.php');
        exit;
    }

    $stmt = $pdo->prepare('DELETE FROM product WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header('LOCATION: index.php');