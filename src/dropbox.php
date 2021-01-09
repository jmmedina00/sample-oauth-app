<?php
require_once "./util/token.php";
require_once "./util/resource.php";
require_once "./util/db.php";
define("INFO_LINK", "https://api.dropboxapi.com/2/users/get_current_account");

$token = getAccessToken("dropbox", true);
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token, "method" => "POST"]
);

var_dump($info);
[
    "name" => [
        "display_name" => $name
    ],
    "email" => $email
] = $info;

$userId = getOrCreateUser($email, $name);
var_dump($userId);