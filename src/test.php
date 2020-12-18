<?php

$connection = new PDO("mysql:host=database;dbname=oauth_test", "oauth",
"oauth", [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);

$stmt = $connection->query("SELECT id, name, surname, email FROM user;");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");
echo json_encode($results);