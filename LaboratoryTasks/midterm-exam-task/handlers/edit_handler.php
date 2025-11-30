<?php
    require '../jwt_helper.php';

    if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
        header("Location: ../pages/auth/login.php");
        exit;
    }

    include "../database/db_connection.php";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $id = intval($_POST["id"]);
        $amount = intval($_POST["amount"]);
        $type = $_POST["type"];
        $name = $_POST["name"];
        $date = $_POST["date"];

        $db = connectDatabase();

        $query = <<<SQL
            UPDATE expenses 
            SET amount = :amount, type = :type, name = :name, date = :date
            WHERE id = :id
        SQL;

        $stmt = $db->prepare($query);
        $stmt->bindValue(":id", $id,SQLITE3_INTEGER);
        $stmt->bindValue(":amount", $amount,SQLITE3_INTEGER);
        $stmt->bindValue(":type", $type);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":date", $date);

        $stmt->execute();

        $db->close();
        header("Location: ../index.php");
    }
?>