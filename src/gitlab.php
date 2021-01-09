<?php
require_once "./util/token.php";
require_once "./util/resource.php";
require_once "./util/db.php";
define("INFO_LINK", "https://gitlab.com/api/v4/user");

$token = getAccessToken("gitlab", true);
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token]
);

var_dump($info);

["name" => $name, "email" => $email] = $info;
$userId = getOrCreateUser($email, $name);

var_dump($userId);