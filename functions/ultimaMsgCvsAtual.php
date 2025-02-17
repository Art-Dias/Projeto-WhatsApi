<?php
session_start();
$device_token = $_SESSION['device_token'];

$numero = $_GET['numero'];
$idMaquina = $_GET['idMaquina'];

call_user_func('setarUltimaMsg', "$numero", $idMaquina, $device_token);

function setarUltimaMsg($numero, $idMaquina, $device_token)
{
    // Include the database connection file
    require '../connection.php';

    $connection = DatabaseConnection::getConnection();

    $result = $connection->query("SELECT id FROM `mensagem_infos` WHERE (number_from = \"$numero\" or number_to = \"$numero\") AND device_token = \"$device_token\" ORDER BY id DESC LIMIT 1");
    $rowValue = mysqli_fetch_assoc($result);
    $indexUltimaMsg = $rowValue['id'];
    
    file_put_contents("../indicesCvs/indiceMsgCvsAtual$idMaquina.txt", $indexUltimaMsg);
    echo "aa $indexUltimaMsg";

    $connection->close();
}
