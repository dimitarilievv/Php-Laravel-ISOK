<?php
session_start();
require '../../database/db_connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = connectDatabase();
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, 'user')");
    try {
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->execute();
        echo "Register success! <a href='../../pages/auth/login.php'>Login</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == "23000") {
            echo "Username already taken!";
        } else {
            die("Something went wrong!" . $e->getMessage());
        }
    }
}
?>