<?php
session_start();
require '../../database/db_connection.php';
require '../../jwt_helper.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = connectDatabase();
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username);
    $result=$stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if($user && password_verify($password, $user['password'])) {
        $token = createJWT($user['id'],$user['username'],$user['role']);

        session_regenerate_id(true);
        $_SESSION['jwt'] = $token;

        header('Location: ../../index.php');
        exit;
    }else{
        echo "Invalid username or password<br>";
        exit;
    }
}
?>