<?php
include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';
if(!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])){
    header('Location: ../pages/auth/login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $db = connectDatabase();

    $stmt = $db->prepare("SELECT * FROM cameras WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $camera = $result->fetchArray(SQLITE3_ASSOC);

    if (!$camera) {
        echo "<p> Delete cannot be performed.</p>";
        exit;
    }
    $cameraDate = new DateTime($camera['date']);
    $currentDate = new DateTime();
    $diff = $currentDate->diff($cameraDate)->days;

    if ($diff >= 7) {
        echo "<p style='color:red;'>⚠️ Камерата е постара од 7 дена и не може да се избрише.</p>";
        echo "<a href='../index.php'>← Назад</a>";
        exit;
    }
    $delete = $db->prepare("DELETE FROM cameras WHERE id = :id");
    $delete->bindValue(':id', $id, SQLITE3_INTEGER);
    $delete->execute();

    $db->close();
    header('Location: ../index.php');
    exit;
}
?>