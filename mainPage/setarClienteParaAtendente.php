<?php
session_start();
$device_token = $_SESSION['device_token'];

$atendenteId = $_POST['atendente'];
$nomeCliente = $_POST['name'];
$numeroCliente = $_POST['number'];

$numeroClienteFormatado0 = '55' . $numeroCliente;
$numeroClienteFormatado1 = str_replace(' ', '', $numeroClienteFormatado0);


// echo "$atendenteId, $nomeCliente, $numeroClienteFormatado1";


call_user_func('setarNovoCliente', $atendenteId, $nomeCliente, $numeroClienteFormatado1, $device_token);

function setarNovoCliente($atendenteId, $nomeCliente, $numeroClienteFormatado, $device_token)
{
    require 'connection.php';

    // $array_vazio = [];

    // Buscar indice da ultima mensagem
    $connection = DatabaseConnection::getConnection();

    $connection->query("UPDATE `atendentes_$device_token` SET chats = JSON_SET(chats, '$.$numeroClienteFormatado', '$nomeCliente') WHERE id = $atendenteId");
    if ($atendenteId != 1) {
        $connection->query("UPDATE `atendentes_$device_token` SET chats = JSON_SET(chats, '$.$numeroClienteFormatado', '$nomeCliente') WHERE id = 1");
    }


    // $arrayPraEnviar = json_encode($array_vazio);

    // echo $arrayPraEnviar;

    $connection->close();
    echo "Numero cadastrado";
}
