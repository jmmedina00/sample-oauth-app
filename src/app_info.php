<?php

$env = parse_ini_file("/etc/.env");

$response = array_filter($env, function ($key) {
    return preg_match("/^DB_/", $key) === 0 
    && preg_match("/_SECRET$/", $key) === 0;
}, ARRAY_FILTER_USE_KEY);

foreach ($response as $key => $value) {
    [$service] = explode("_", $key);
    $bytes = random_bytes(63);
    setcookie($service . "_STATE", base64_encode($bytes));
}

header("Content-Type: application/json");
echo json_encode($response);