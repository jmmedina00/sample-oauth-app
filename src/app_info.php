<?php

$env = parse_ini_file("/etc/.env");

$response = array_filter($env, function ($key) {
    return preg_match("/^DB_/", $key) === 0 
    && preg_match("/_SECRET$/", $key) === 0;
}, ARRAY_FILTER_USE_KEY);

header("Content-Type: application/json");
echo json_encode($response);