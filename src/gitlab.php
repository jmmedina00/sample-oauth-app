<?php
require_once "./util/util.php";
define("INFO_LINK", "https://gitlab.com/api/v4/user");

$token = getAccessToken("gitlab", true);
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token]
);

var_dump($info);