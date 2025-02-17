<?php
session_start();
$device_token = $_SESSION['device_token'];


// API
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://cluster.apigratis.com/api/v2/whatsapp/getAllContacts',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        "DeviceToken: $device_token",
        'Authorization: Bearer token01'
    ),
));

$response_api = curl_exec($curl);

curl_close($curl);

$array_response = json_decode($response_api, true);

$array_contatos_fotos = $array_response['response']['contacts'];



$lenArrayDosContatos = count($array_contatos_fotos);



$listaNumeroFotos = [];

$contadorContatosFotos = 0;

while ($contadorContatosFotos <= $lenArrayDosContatos) {
    $userNumber = $array_contatos_fotos["$contadorContatosFotos"]['data']['id']['user'];
    $imgUrl = $array_contatos_fotos["$contadorContatosFotos"]['data']['profilePicThumbObj']['img'];

    $listaNumeroFotos[$userNumber] = $imgUrl;

    $contadorContatosFotos++;
}




// Buscando contatos cadastrados
require '../connection.php';
$conn = DatabaseConnection::getConnection();

$atendenteId = $_SESSION['id_atendente'];
// $atendenteId = 1;

$result = $conn->query("SELECT chats FROM `atendentes_$device_token` WHERE id = \"$atendenteId\"");
$rowValue = mysqli_fetch_assoc($result);
$JSONchats = $rowValue['chats'];

$array_dos_contatos = json_decode($JSONchats, true);




$array_contatos_fotos_final = array();

foreach ($array_dos_contatos as $key => $value) {
    if (isset($listaNumeroFotos[$key])) {
        $array_contatos_fotos_final[$key] = $listaNumeroFotos[$key];
    }
}

print_r($array_contatos_fotos_final);
