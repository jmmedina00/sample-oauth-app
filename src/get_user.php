<?php

require_once "./util/db.php";

$id = (int)$_GET["id"] ?? 0;
$user = getExistingUser($id);

header("Content-Type: application/json");
echo json_encode($user);