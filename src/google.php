<?php
require_once "./util/token.php";
require_once "./util/resource.php";
require_once "./util/db.php";
define("INFO_LINK", "https://openidconnect.googleapis.com/v1/userinfo");

$token = getAccessToken("google", true);
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token]
);

var_dump($info);

["name" => $name, "email" => $email] = $info;
$userId = getOrCreateUser($email, $name);
var_dump($userId);