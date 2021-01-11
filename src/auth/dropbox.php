<?php
require_once "../util/all.php";
define("INFO_LINK", "https://api.dropboxapi.com/2/users/get_current_account");

$token = getAccessToken("dropbox", true);
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token, "method" => "POST"]
);

[
    "name" => [
        "display_name" => $name
    ],
    "email" => $email
] = $info;

$userId = getOrCreateUser($email, $name);
redirectToUser($userId);