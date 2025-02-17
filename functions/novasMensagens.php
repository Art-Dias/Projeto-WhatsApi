<?php
session_start();
$device_token = $_SESSION['device_token'];

call_user_func('criarListaNovasMsgs', $device_token);

function criarListaNovasMsgs($device_token)
{
    require '../connection.php';

    $array_vazio = [];

    // Buscar indice da ultima mensagem
    $connection = DatabaseConnection::getConnection();

    // Lista numeros cadastrads
    $sqlNumerosCadastros = $connection->query("SELECT chats FROM `atendentes_$device_token` WHERE id = 1");
    $rowValue3 = mysqli_fetch_assoc($sqlNumerosCadastros);
    $cadastrosJSON = $rowValue3['chats'];
    $listaChats = json_decode($cadastrosJSON, true);
    $listaNumerosCadastrados = array_keys($listaChats);
    $keyString = implode(',', $listaNumerosCadastrados);

    // $sqlQuery = $connection->query("SELECT COUNT(DISTINCT number_from) AS quantidade FROM `mensagem_infos` WHERE lido = '0' AND number_from IN (\"$keyString\");");

    $resultMsg = $connection->query("SELECT DISTINCT number_from FROM `mensagem_infos` WHERE lido = '0' AND device_token = \"$device_token\" AND number_from IN ($keyString);");
    while ($rowMsg = mysqli_fetch_assoc($resultMsg)) {
        $numeroComMensagensNovas = $rowMsg['number_from'];

        $array_vazio[] = $numeroComMensagensNovas;
    }
    // file_put_contents("arquivo.txt", $indiceUltimaMsgNovo);

    $arrayPraEnviar = json_encode($array_vazio);

    // $connection->close();
    echo $arrayPraEnviar;
}
