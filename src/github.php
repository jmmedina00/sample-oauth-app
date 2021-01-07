<?php
require_once "./util/token.php";
require_once "./util/resource.php";
define("INFO_LINK", "https://api.github.com/user");

$token = getAccessToken("github");
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token]
);

var_dump($info);

$emailInfo = getResourceWithAuthorization(
    ["link" => INFO_LINK . "/emails", "token" => $token]
);

var_dump($emailInfo);