<?php

if (isset($_POST['numeroDoContatoAtual'], $_POST['device'], $_POST['imagem64'])) {
  $numeroDoContatoAtual = $_POST['numeroDoContatoAtual'];
  $deviceToken = $_POST['device'];
  $imagem64 = $_POST['imagem64'];
} else {
  // Handle missing parameters
  http_response_code(404); // Bad Request
  // echo "{ \"error\": { \"code\": 404, \"message\": \"Not Found\", \"description\": \"The requested resource could not be found on the server.\" } }";
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://cluster.apigratis.com/api/v2/whatsapp/sendFile64',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{
  "number": ' . "$numeroDoContatoAtual" . ',
  "path": "' . "$imagem64" . '",
  "caption": " "
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    "DeviceToken: $deviceToken",
    'Authorization: Bearer token01'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
