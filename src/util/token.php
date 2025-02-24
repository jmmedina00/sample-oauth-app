<?php

define("ACCESS_LINKS", [
  "google" => "https://oauth2.googleapis.com/token",
  "github" => "https://github.com/login/oauth/access_token",
  "gitlab" => "https://gitlab.com/oauth/token",
  "dropbox" => "https://www.dropbox.com/oauth2/token",
  "reddit" => "https://www.reddit.com/api/v1/access_token"
]);

function getAccessToken(string $service, bool $expanded = false, bool $asUserCredentials = false): string {
  $actualState = urldecode($_GET["state"]);
  $expectedState = $_COOKIE[strtoupper($service) . "_STATE"];
  
  if (!isset($_GET["code"])) {
    header("Location: http://localhost/error.html");
    die();
  }

  if ($actualState != $expectedState) {
    header("Location: http://localhost/goose.png");
    die();
  }
  
  $upperCaseService = strtoupper($service);

  [
    $upperCaseService . "_CLIENT_ID" => $clientId,
    $upperCaseService . "_SECRET" => $secret
  ] = parse_ini_file("/etc/.env");

  $authCode = $_GET["code"];

  $tokenRequest = curl_init(ACCESS_LINKS[$service]);
  curl_setopt($tokenRequest, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($tokenRequest, CURLOPT_HTTPHEADER,
  ["Accept: application/json"]);

  $postFields = [
    "code" => $authCode,
  ];

  if ($asUserCredentials) {
    curl_setopt($tokenRequest, CURLOPT_USERPWD, "$clientId:$secret");
  } else {
    $postFields += [
      "client_id" => $clientId,
      "client_secret" => $secret
    ];
  }

  if ($expanded) {
    $postFields += [
      "grant_type" => "authorization_code",
      "redirect_uri" => "http://localhost/auth/$service.php"
    ];
  }

  curl_setopt($tokenRequest, CURLOPT_POSTFIELDS, $postFields);
  $result = json_decode(curl_exec($tokenRequest), true);
  $accessToken = $result["access_token"];
  curl_close($tokenRequest);

  return $accessToken;
}