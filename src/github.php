<?php
require_once "./util/token.php";
require_once "./util/resource.php";
require_once "./util/db.php";
define("INFO_LINK", "https://api.github.com/user");

$token = getAccessToken("github");
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token]
);

var_dump($info);
$name = $info["name"];

$emailInfo = getResourceWithAuthorization(
    ["link" => INFO_LINK . "/emails", "token" => $token]
);

var_dump($emailInfo);
$mainEmailObject = array_filter($emailInfo, function ($foo) {
    return $foo["primary"];
});

$email = array_values($mainEmailObject)[0]["email"];
$userId = getOrCreateUser($email, $name);

var_dump($userId);