<?php
require_once "./util/all.php";
define("INFO_LINK", "https://gitlab.com/api/v4/user");

$token = getAccessToken("gitlab", true);
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token]
);

["name" => $name, "email" => $email] = $info;
$userId = getOrCreateUser($email, $name);
redirectToUser($userId);