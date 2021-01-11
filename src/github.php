<?php
require_once "./util/all.php";
define("INFO_LINK", "https://api.github.com/user");

$token = getAccessToken("github");
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token]
);
$name = $info["name"];

$emailInfo = getResourceWithAuthorization(
    ["link" => INFO_LINK . "/emails", "token" => $token]
);
$mainEmailObject = array_filter($emailInfo, function ($foo) {
    return $foo["primary"];
});

$email = array_values($mainEmailObject)[0]["email"];
$userId = getOrCreateUser($email, $name);
redirectToUser($userId);