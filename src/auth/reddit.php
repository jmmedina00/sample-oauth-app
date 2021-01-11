<?php
require_once "../util/token.php";
require_once "../util/resource.php";
define("INFO_LINK", "https://oauth.reddit.com/api/v1/me");

$token = getAccessToken("reddit", true, true);
$info = getResourceWithAuthorization([
    "link" => INFO_LINK,
    "token" => $token,
    "authType" => "bearer",
    "agent" => "php:juanmi.testingoauth:v1"
]);

var_dump($info);