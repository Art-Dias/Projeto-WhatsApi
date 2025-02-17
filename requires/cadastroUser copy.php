<?php

// $nome = strip_tags(trim($_POST['nome']));

// $email = strip_tags(trim($_POST['email']));

// $nm_login = strip_tags(trim($_POST['nm_login']));
// $nm_senha = password_hash($_POST['nm_senha'], PASSWORD_DEFAULT);

// $device_token = $_POST['device_token'];


$nome = "Genivaldo Dias";

$email = "dias@hotmail.com";

$nm_login = "Dias";
$nm_senha = "123";

$device_token = "a4fa2b63-44e8-4894-96f2-d229af0d63a7";


include '../connection.php';

$conn = DatabaseConnection::getConnection();

$sql0 = "SELECT nm_login FROM usuarios WHERE nm_login = '$nm_login'";
$result = $conn->query($sql0);

if ($result->num_rows > 0) {
    echo "usuario ja existeAAAAAAAAAAAAAAA";
} else {
    echo "fffff1";
    call_user_func('cadastrarUsuario', $nome, $email, $nm_login, $nm_senha, $device_token);
}

// if ($result->num_rows > 0) {
//     // Name already exists in the database
//     // echo "The name already exists.";
//     echo "usuario ja existe";
// } elseif (empty($nome) || empty($email) || empty($nm_login) || empty($nm_senha) || empty($device_token)) {
//     echo "campo vazio";
// } else {
//     // Name doesn't exist in the database
//     // Call the function
//     call_user_func('cadastrarUsuario', $nome, $email, $nm_login, $nm_senha, $device_token);
// }

// call_user_func('cadastrarUsuario', $nome, $email, $nm_login, $nm_senha, $device_token);

function cadastrarUsuario($nome, $email, $nm_login, $nm_senha, $device_token)
{
    echo "<br>";
    echo "bbbb";
    echo "<br>";
    echo "$nome";
    echo "<br>";
    echo "$email";
    echo "<br>";
    echo "$nm_login";
    echo "<br>";
    echo "$nm_senha";
    echo "<br>";
    echo "$device_token";

    if (empty($nome)) {
    if (empty($nome)) {
    if (empty($nome)) {
        print '<div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Algo errado!</strong> Lembrando que todos os campos são de preenchimento obrigatório!!!
                                </div>';
    } else {
        echo "<br>";
        echo "DDDDDDDDDDDDDDDDDD";

        include '../connection.php';

        $sql1 = "SELECT nm_login FROM usuarios WHERE nm_login = '$nm_login'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            echo "usuario ja existeAAAAAAAAAAAAAAA";
        } else {
            echo "fffff1";
            // call_user_func('cadastrarUsuario', $nome, $email, $nm_login, $nm_senha, $device_token);
        }


        // $result_usuario = "SELECT id FROM `atendentes_$device_token` WHERE id=1";
        // $resultado_usuario = mysqli_query($conn, $result_usuario);
        // if (mysqli_num_rows($resultado_usuario) == 0) {
        //     echo "<br>";
        //     echo "GGGGGGGGGGGGGG";
        // } else {
        //     echo "<br>";
        //     echo "HHHHHHHHHHH";
        // }
    }
}
function cadastrarUsuario0($nome, $email, $nm_login, $nm_senha, $device_token)
{
    if (empty($nome)) {
        print '<div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Algo errado!</strong> Lembrando que todos os campos são de preenchimento obrigatório!!!
                                </div>';
    } else {

        echo "aaaaaaa";

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
}


// function cadastrarUsuario($nome)
// {
// if (empty($nome)) {

//     print '<div class="alert alert-danger">
//                                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
//                                     <strong>Algo errado!</strong> Lembrando que todos os campos são de preenchimento obrigatório!!!
//                                 </div>';
// } else {
//     echo "aaaaaaaaaa";

//     // include '../co/class.php';

//     // Conectar();

//     include '../connection.php';

//     $conn = DatabaseConnection::getConnection();

//     // SQL query for insertion
//     $sql = "INSERT INTO usuarios (nome, email, nm_login, nm_senha, menu,  data,  nv_acesso, device_token, bearer_token, id_atendente, nome_atendente) VALUES ('$nome', '$email', '$nm_login', '$nm_senha', '1', now(), '1', '', '', '', '')";

//     $result_usuario = "SELECT id FROM `atendentes_$device_token` WHERE id=1";
//     $resultado_usuario = mysqli_query($conn, $result_usuario);
//     if (mysqli_num_rows($resultado_usuario) == 0) {
//         // No results found

//         // $sql0 = "INSERT INTO atendentes (nome) VALUES ('ADM')";
//         // $conn->query("INSERT INTO atendentes (nome, chats) VALUES ('ADM', '{}')");
//         $conn->query("INSERT INTO `atendentes_$device_token`(nome, chats) VALUES ('ADM', '{}')");


//         // $sql1 = "INSERT INTO atendentes (nome) VALUES ('$nome')";
//         // $conn->query("INSERT INTO atendentes (nome, chats) VALUES ('$nome', '{}')");
//         $conn->query("INSERT INTO `atendentes_$device_token` (nome, chats) VALUES ('$nome', '{}')");
//     } else {
//         // Results found
//         // You can fetch the result if needed
//         $row = mysqli_fetch_assoc($resultado_usuario);
//         $id = $row['id'];
//         // echo "Result found: $id";
//     }


//     // Execute query
//     if ($conn->query($sql) === TRUE) {
//         echo "Record inserted successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }
// }