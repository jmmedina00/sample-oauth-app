<?php
define("TOKEN_LINK", "https://oauth2.googleapis.com/token");
define("INFO_LINK", "https://openidconnect.googleapis.com/v1/userinfo");

[
    "GOOGLE_CLIENT_ID" => $clientId,
    "GOOGLE_SECRET" => $secret
] = parse_ini_file("/etc/.env");
$authCode = $_GET["code"];

$tokenRequest = curl_init(TOKEN_LINK);
curl_setopt($tokenRequest, CURLOPT_RETURNTRANSFER, true);
curl_setopt($tokenRequest, CURLOPT_POSTFIELDS, [
    "client_id" => $clientId,
    "client_secret" => $secret,
    "code" => $authCode,
    "grant_type" => "authorization_code",
    "redirect_uri" => "http://localhost/google.php"
]);

$result = json_decode(curl_exec($tokenRequest), true);
$accessToken = $result["access_token"];
curl_close($tokenRequest);

$infoContext = stream_context_create([
    "http" => [
        "method" => "GET",
        "header" => "Authorization: Bearer " . $accessToken . "\r\n"
    ]
]);
$info = json_decode(file_get_contents(INFO_LINK, false, $infoContext));
var_dump($info);