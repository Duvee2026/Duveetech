<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(403);
  exit;
}

/* ===============================
   READ FORM DATA
================================ */
$email     = $_POST['email'] ?? '';
$event_id  = $_POST['event_id'] ?? '';
$form_name = $_POST['form_source'] ?? 'Unknown Form';

/* ===============================
   META CONFIG
================================ */
$pixel_id = '1532750337871513';
$access_token = 'EAAMVoGnk2u4BQd8GSo7K2XG0W8QSgf8zjiYA6c5OfRANMfUISvOthniEDjxitEUk6Y6QFHmBu0tMvpZBxJqhPR0e6WpwbOWZA7tiPoZBvBI7DAT9syVatiyHZCApmRNWIkKswWqOSzvjqO7HyeSMS6avWhNNuU9TNFXcGgYkCUmZCNlw4b5QozjJWFNCFVAZDZD';

/* ===============================
   BUILD USER DATA (EMQ OPTIMISED)
================================ */
$user_data = [
  "client_ip_address" => $_SERVER['REMOTE_ADDR'],
  "client_user_agent" => $_SERVER['HTTP_USER_AGENT']
];

if (!empty($_COOKIE['_fbp'])) {
  $user_data['fbp'] = $_COOKIE['_fbp'];
}

if (!empty($_COOKIE['_fbc'])) {
  $user_data['fbc'] = $_COOKIE['_fbc'];
}

if (!empty($email)) {
  $user_data['em'] = [
    hash('sha256', strtolower(trim($email)))
  ];
}

/* ===============================
   BUILD PAYLOAD
================================ */
$payload = [
  "data" => [[
    "event_name" => "Lead",
    "event_time" => time(),
    "event_id" => $event_id,
    "event_source_url" => "https://www.duveetech.com" . $_SERVER['REQUEST_URI'],
    "action_source" => "website",
    "user_data" => $user_data,
    "custom_data" => [
      "content_name" => $form_name,
      "currency" => "INR",
      "value" => 1.00
    ]
  ]]
];

/* ===============================
   SEND TO META
================================ */
$ch = curl_init("https://graph.facebook.com/v18.0/$pixel_id/events?access_token=$access_token");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
$response = curl_exec($ch);
curl_close($ch);
file_put_contents(__DIR__.'/meta_capi_log.txt', date('Y-m-d H:i:s')." ".$response.PHP_EOL, FILE_APPEND);


/* ===============================
   REDIRECT
================================ */
header("Location: thank-you.html");
exit;