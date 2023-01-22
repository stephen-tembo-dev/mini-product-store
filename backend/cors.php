<?php

if (isset($_SERVER['OPTIONS'])) {
  // Key exists, send an HTTP status code of "200 OK" as the response
  http_response_code(200);
  exit;
}

// Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");


