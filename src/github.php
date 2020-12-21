<?php
define("TOKEN_LINK", "https://github.com/login/oauth/access_token");
define("INFO_LINK", "https://api.github.com/user/emails");

[
    "GITHUB_CLIENT_ID" => $clientId,
    "GITHUB_SECRET" => $secret
] = parse_ini_file("/etc/.env");

$authCode = $_GET["code"];
$tokenRequest = curl_init(TOKEN_LINK);
curl_setopt($tokenRequest, CURLOPT_RETURNTRANSFER, true);
curl_setopt($tokenRequest, CURLOPT_POSTFIELDS, [
    "client_id" => $clientId,
    "client_secret" => $secret,
    "code" => $authCode
]);
curl_setopt($tokenRequest, CURLOPT_HTTPHEADER,
["Accept: application/json"]);

$result = json_decode(curl_exec($tokenRequest), true);
$accessToken = $result["access_token"];
curl_close($tokenRequest);

$infoContext = stream_context_create([
    "http" => [
        "method" => "GET",
        "header" => "Authorization: token " . $accessToken . "\r\n" .
                    "User-Agent: Juanmi-Medina"
    ]
]);
$info = json_decode(file_get_contents(INFO_LINK, false, $infoContext), true);
var_dump($info);