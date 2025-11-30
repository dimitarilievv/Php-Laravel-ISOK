<?php
require '../../database/db_connection.php';
require '../../jwt_helper.php';
session_start();
session_unset();
session_destroy();
header('Location: ../../pages/auth/login.php');
exit();
?>