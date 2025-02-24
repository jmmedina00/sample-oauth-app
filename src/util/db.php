<?php

function getDbConnection() {
  [
    "DB_NAME" => $dbName,
    "DB_USER" => $user,
    "DB_PASSWORD" => $password
  ] = parse_ini_file("/etc/.env");

  return new PDO(
    "mysql:host=database;dbname=$dbName", 
    $user, $password, 
    [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
  );
}

function getExistingUser(int $id) {
  $connection = getDbConnection();

  $stmt = $connection->prepare("SELECT * FROM user WHERE id=?");
  $stmt->execute([$id]);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  return $user;
}

function getOrCreateUser(string $email, string $name) {
  $connection = getDbConnection();

  $stmtUpdate = $connection->prepare(
    "UPDATE user SET accesses = accesses + 1 WHERE email=?"
  );
  $stmtUpdate->execute([$email]);
  $userId = 0;

  if ($stmtUpdate->rowCount()) {
    $stmtFetch = $connection->prepare("SELECT id FROM user WHERE email=?");
    $stmtFetch->execute([$email]);
    $userId = $stmtFetch->fetch(PDO::FETCH_ASSOC)["id"];
  } else {
    $stmtCreate = $connection->prepare("INSERT INTO user (name, email) VALUES (?,?);");
    $stmtCreate->execute([$name, $email]);
    $userId = $connection->lastInsertId();
  }

  return $userId;
}