<?php

include '../db_connection.php';
$db=connectDatabase();

$query = <<<SQL
CREATE TABLE IF NOT EXISTS cameras (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  location TEXT NOT NULL,
  date DATE NOT NULL,
  price REAL NOT NULL,
  type TEXT NOT NULL
);
SQL;

$db->exec($query);
$db->close();
