<?php
session_start();
$device_token = $_SESSION['device_token'];

$key = $_GET['numeroIndice']; 

$_SESSION['numero-selecionado-popup'] = $key; 

include '../connection.php';

$connection = DatabaseConnection::getConnection();

// $resultMsg = $connection->query("SELECT * FROM `atendentes_$device_token` WHERE id != 1");
$resultMsg = $connection->query("SELECT * FROM `atendentes_$device_token` WHERE JSON_CONTAINS_PATH(chats, 'one', '$.$key') AND id != 1");

while ($rowValue = mysqli_fetch_assoc($resultMsg)) {
    $id = $rowValue['id'];
    $nome = $rowValue['nome'];
    $chats = $rowValue['chats'];

    $JSONdecoded = json_decode($chats, true);
    $chatsLength = count($JSONdecoded);

    // $quantidadeConversas = $connection->query("SELECT JSON_LENGTH(chats) FROM atendentes AS json_element_count WHERE id = $id;");
    echo "<tr style=\"max-width: 250px;\"> <td> <div class=\"d-flex align-items-center\"> <div class=\"form-check pe-2\"> <input class=\"form-check-input\" type=\"checkbox\" value id=\"flexCheckDefault2\"> </div> <div class=\"flex-grow-1 ms-10\"> <h4 class=\"fw-semibold fs-16 mb-0\">$nome</h4> </div> </div> </td> <td id=\"indiceNumero\">$id</td> </tr>";

    // echo "<tr> <td> <div class=\"d-flex align-items-center\"> <div class=\"flex-shrink-0\"> <img data-cfsrc=\"assets/images/user-4.jpg\" class=\"rounded-circle wh-44\" alt=\"user-4\" style=\"display:none;visibility:hidden;\"><noscript><img src=\"assets/images/user-4.jpg\" class=\"rounded-circle wh-44\" alt=\"user-4\"></noscript> </div> <div class=\"flex-grow-1 ms-10\"> <h4 class=\"fw-semibold fs-16 mb-0\">$nome</h4> </div> </div> </td> <td>$id</td> <td> <div class=\"d-flex align-items-center\" style=\"display: flex; justify-content: center; align-items: center;\"></i> <span>$chatsLength</span> </div> </td> <td> <span class=\"badge bg-success bg-opacity-10 text-success py-2 px-3 fw-semibold\">Active</span> </td> </tr>";

}
