<?php
session_start();
$device_token = $_SESSION['device_token'];

$numero = $_GET['numero'];

call_user_func('atualizarMensagensLidas', $numero, $device_token);

function atualizarMensagensLidas($numero, $device_token)
{
    require '../connection.php';

    // Buscar indice da ultima mensagem
    $connection = DatabaseConnection::getConnection();

    //Update nos numeros que cliquei
    $connection->query("UPDATE `mensagem_infos` SET lido = '1' WHERE number_from = \"$numero\" AND lido = '0' AND device_token = \"$device_token\"");

    // Retornado uim array vazio pq sim
    $array_vazio = [];
    $arrayPraEnviar = json_encode($array_vazio);
    echo $arrayPraEnviar;
}
