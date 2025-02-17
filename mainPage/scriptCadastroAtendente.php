<?php
session_start();
$device_token = $_SESSION['device_token'];

$nomeAtendente = $_POST['nome'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$nm_login = $_POST['usuario'];
$nv_acesso = $_POST['adm'];

$device_token = $_SESSION['device_token'];

// Include the database connection file
include '../connection.php';

// Function to set a new atendente
function setarNovoAtendente($nomeAtendente, $senha, $nm_login, $nv_acesso, $device_token)
{
    global $array_vazio; // You may need to define $array_vazio somewhere

    try {
        // Get a database connection
        $connection = DatabaseConnection::getConnection();

        // Use a prepared statement to avoid SQL injection
        $stmt = $connection->prepare("INSERT INTO `atendentes_$device_token` (nome, chats) VALUES (?, '{}')");
        $stmt->bind_param("s", $nomeAtendente);

        // Execute the query
        $stmt->execute();

        // Close the statement
        $stmt->close();

        // Output the nomeAtendente
        echo $nomeAtendente;

        cadastratAtendente($nomeAtendente, $senha, $nm_login, $nv_acesso, $device_token);

        // Close the database connection
        // $connection->close();
    } catch (Exception $e) {
        // Handle exceptions (log the error, show a user-friendly message, etc.)
        echo "Error: " . $e->getMessage();
    }
}

function cadastratAtendente($nomeAtendente, $senha, $nm_login, $nv_acesso, $device_token)
{
    $connection = DatabaseConnection::getConnection();

    $result_atendente = "SELECT id, nome FROM `atendentes_$device_token` WHERE nome = '$nomeAtendente'";
    $resultado_atendente = mysqli_query($connection, $result_atendente);
    $row_atendentes = mysqli_fetch_assoc($resultado_atendente);
    $idAtendente = $row_atendentes['id'];
    $nomeAtendente = $row_atendentes['nome'];

    // $result_usuarios = "SELECT * FROM usuarios WHERE id = 1";
    // $resultado_usuarios = mysqli_query($connection, $result_usuarios);
    // $row_usuarios = mysqli_fetch_assoc($resultado_usuarios);
    // $device_token = $row_usuarios['device_token'];
    // $bearer_token = $row_usuarios['bearer_token'];

    // Criando usuário
    $sql = $connection->prepare("INSERT INTO usuarios (nome, email, nm_login, nm_senha, menu, data, nv_acesso, device_token, bearer_token, id_atendente, nome_atendente) VALUES (?, 'null', '$nm_login', '$senha', '1', now(), '$nv_acesso', '$device_token', '', '$idAtendente', '$nomeAtendente')");
    $sql->bind_param("s", $nomeAtendente);

    $sql->execute();

    $sql->close();
}


$conn = DatabaseConnection::getConnection();

$sql = "SELECT nm_login FROM usuarios WHERE nm_login = '$nm_login'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Name already exists in the database
    // echo "The name already exists.";
    echo "usuario já existe";
} else {
    // Name doesn't exist in the database
    // Call the function
    setarNovoAtendente($nomeAtendente, $senha, $nm_login, $nv_acesso, $device_token);
}

