<?php
require_once "../util/all.php";
define("INFO_LINK", "https://openidconnect.googleapis.com/v1/userinfo");

$token = getAccessToken("google", true);
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token]
);

["name" => $name, "email" => $email] = $info;
$userId = getOrCreateUser($email, $name);
redirectToUser($userId);