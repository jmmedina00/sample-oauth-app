<?php

function getResourceWithAuthorization(array $data): array {
  $defaults = [
    "authType" => "Bearer",
    "agent" => "Juanmi-Medina",
    "method" => "GET"
  ];

  [
    "link" => $link,
    "token" => $accessToken,
    "authType" => $authType,
    "agent" => $agent,
    "method" => $method
  ] = $data + $defaults;

  $context = stream_context_create([
    "http" => [
        "method" => $method,
        "header" => "Authorization: " . $authType . " " . $accessToken . "\r\n" .
        "User-Agent: " . $agent . "\r\n"
    ]
  ]);
  
  return json_decode(file_get_contents($link, false, $context), true);
}

function redirectToUser(int $id) {
  header("Location: http://localhost/user.html?id=$id");
  die();
}