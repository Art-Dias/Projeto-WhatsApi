<?php
session_start();
$device_token = $_SESSION['device_token'];

$numero = $_SESSION['numero-selecionado-popup'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the 'selectOption' field is set in the POST data
    if (isset($_GET["id"])) {
        // Retrieve the selected value
        $id = $_GET["id"];

        // Now you can use $selectedValue as needed
        // echo "Selected value: " . $numero;
    }
}

// include ('../co/class.php');
include '../connection.php';

$conn = DatabaseConnection::getConnection();

// $sqlAtendentes = "SELECT * FROM atendentes ORDER BY id ASC";
$conn->query("UPDATE `atendentes_$device_token` SET chats = JSON_REMOVE(chats, '$.$numero') WHERE JSON_CONTAINS_PATH(chats, 'one', '$.$numero') AND id = $id;");
