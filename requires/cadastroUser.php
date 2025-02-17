<?php

$nome = strip_tags(trim($_POST['nome']));

$email = strip_tags(trim($_POST['email']));

$nm_login = strip_tags(trim($_POST['nm_login']));
$nm_senha = password_hash($_POST['nm_senha'], PASSWORD_DEFAULT);

$device_token = $_POST['device_token'];


// Checando de usuario já existe
include '../connection.php';

$conn = DatabaseConnection::getConnection();

$sql0 = "SELECT nm_login FROM usuarios WHERE nm_login = '$nm_login'";
$result = $conn->query($sql0);

if ($result->num_rows > 0) {
    echo "usuario ja existe";
} else if (empty($nome) || empty($email) || empty($nm_login) || empty($nm_senha) || empty($nm_senha) || empty($device_token)) {
 
    echo "campo vazio";

    // print '<div class="alert alert-danger">
    //                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    //                                 <strong>Algo errado!</strong> Lembrando que todos os campos são de preenchimento obrigatório!!!
    //                             </div>';

} else {
    // include '../co/class.php';

    // Conectar();

    include '../connection.php';

    $conn = DatabaseConnection::getConnection();

    // SQL query for insertion
    $sql = "INSERT INTO usuarios (nome, email, nm_login, nm_senha, menu,  data,  nv_acesso, device_token, bearer_token, id_atendente, nome_atendente) VALUES ('$nome', '$email', '$nm_login', '$nm_senha', '1', now(), '1', '', '', '', '')";

    $result_usuario = "SELECT id FROM `atendentes_$device_token` WHERE id=1";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    if (mysqli_num_rows($resultado_usuario) == 0) {
        // No results found

        // $sql0 = "INSERT INTO atendentes (nome) VALUES ('ADM')";
        // $conn->query("INSERT INTO atendentes (nome, chats) VALUES ('ADM', '{}')");
        $conn->query("INSERT INTO `atendentes_$device_token`(nome, chats) VALUES ('ADM', '{}')");


        // $sql1 = "INSERT INTO atendentes (nome) VALUES ('$nome')";
        // $conn->query("INSERT INTO atendentes (nome, chats) VALUES ('$nome', '{}')");
        $conn->query("INSERT INTO `atendentes_$device_token` (nome, chats) VALUES ('$nome', '{}')");
    } else {
        // Results found
        // You can fetch the result if needed
        $row = mysqli_fetch_assoc($resultado_usuario);
        $id = $row['id'];
        // echo "Result found: $id";
    }


    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
