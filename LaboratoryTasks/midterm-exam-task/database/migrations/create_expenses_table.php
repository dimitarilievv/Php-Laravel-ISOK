<?php
include  '../db_connection.php';

$db=connectDatabase();
$query = <<<SQL
    CREATE TABLE IF NOT EXISTS expenses (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        date DATE NOT NULL,
        amount REAL NOT NULL,
        type TEXT NOT NULL);
SQL;

$db->exec($query);
$db->close();

