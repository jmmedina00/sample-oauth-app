<?php
require_once "./util/util.php";
define("INFO_LINK", "https://api.dropboxapi.com/2/users/get_current_account");

$token = getAccessToken("dropbox", true);
$info = getResourceWithAuthorization(
    ["link" => INFO_LINK, "token" => $token, "method" => "POST"]
);

var_dump($info);