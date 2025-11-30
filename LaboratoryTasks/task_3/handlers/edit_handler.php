<?php
include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';
if(!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])){
    header('Location: ../pages/auth/login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['name'] ?? '';
    $location = $_POST['location'] ?? '';
    $date = $_POST['date'] ?? '';
    $price = intval($_POST['price']) ?? 0;
    $type = $_POST['type'] ?? '';

    $db=connectDatabase();

    $query = <<<SQL
    UPDATE cameras
    SET name = :name, location = :location, date = :date, price = :price, type = :type
    WHERE id = :id
    SQL;

    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id,SQLITE3_INTEGER);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':location', $location);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':type', $type);
    $stmt->execute();
    $db->close();
    header("Location: ../index.php");
}
?>