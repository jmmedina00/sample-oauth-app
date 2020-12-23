<?php
define("TOKEN_LINK", "https://www.reddit.com/api/v1/access_token");
define("INFO_LINK", "https://oauth.reddit.com/api/v1/me");

[
    "REDDIT_CLIENT_ID" => $clientId,
    "REDDIT_SECRET" => $secret
] = parse_ini_file("/etc/.env");

$authCode = $_GET["code"];
$tokenRequest = curl_init(TOKEN_LINK);
curl_setopt($tokenRequest, CURLOPT_RETURNTRANSFER, true);
curl_setopt($tokenRequest, CURLOPT_POSTFIELDS, [
    "code" => $authCode,
    "grant_type" => "authorization_code",
    "redirect_uri" => "http://localhost/reddit.php"
]);
curl_setopt($tokenRequest, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($tokenRequest, CURLOPT_HTTPHEADER,
["Accept: application/json"]);

$result = json_decode(curl_exec($tokenRequest), true);
var_dump($result);
$accessToken = $result["access_token"];

$infoContext = stream_context_create([
    "http" => [
        "method" => "GET",
        "header" => "Authorization: bearer " . $accessToken . "\r\n" .
        "User-Agent: php:juanmi.testingoauth:v1" . "\r\n"
    ]
]);
$info = json_decode(file_get_contents(INFO_LINK, false, $infoContext), true);
var_dump($info);