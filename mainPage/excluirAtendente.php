<?php 
session_start();
$device_token = $_SESSION['device_token'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the 'selectOption' field is set in the POST data
    if (isset($_GET["idSelecionado"])) {
        // Retrieve the selected value
        $id = $_GET["idSelecionado"];

        // Now you can use $selectedValue as needed
        echo "Selected value: " . $id;
    }
}

// include ('../co/class.php');
include '../connection.php';

$conn = DatabaseConnection::getConnection();

// $sqlAtendentes = "SELECT * FROM atendentes ORDER BY id ASC";

$conn->query("DELETE FROM `atendentes_$device_token` WHERE id = '$id';"); 
$conn->query("DELETE FROM `usuarios` WHERE id_atendente = '$id' AND device_token = `$device_token`;"); 

?>