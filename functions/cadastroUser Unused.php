<?php
if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
    $nome = strip_tags(trim($_POST['nome']));
    //   $nv_acesso = strip_tags(trim($_POST['nv_acesso']));
    //   $cpf = strip_tags(trim($_POST['cpf']));
    $email = strip_tags(trim($_POST['email']));
    //   $datanasc = strip_tags(trim($_POST['datanasc']));
    $nm_login = strip_tags(trim($_POST['nm_login']));
    $nm_senha = password_hash($_POST['nm_senha'], PASSWORD_DEFAULT);

    //   $foto = 'images/user.png';

    $data = date("d/m/Y");

    if (empty($nome)) {
        echo '01';
        print '<div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Algo errado!</strong> Lembrando que todos os campos são de preenchimento obrigatório!!!
                                </div>';
    } else {
        echo '02';
        include '../co/class.php';

        Conectar();

        $stmt = $conn->prepare("INSERT INTO usuarios (nome, nv_acesso, email, nm_login, nm_senha, menu,  data, device_token, bearer_token) VALUES ('$nome', '1', '$email', '$nm_login', '$nm_senha', '1', now()), '', ''");
        $stmt->bind_param("s", $nomeAtendente);

        // Execute the query
        $stmt->execute();

        // Close the statement
        $stmt->close();
    }
}

echo 'bala';

$nome = strip_tags(trim($_POST['nome']));

$email = strip_tags(trim($_POST['email']));

$nm_login = strip_tags(trim($_POST['nm_login']));
$nm_senha = password_hash($_POST['nm_senha'], PASSWORD_DEFAULT);

echo "$nome e $email e $nm_login e $nm_senha";

if (empty($nome)) {
    echo "<br>";
    echo '01';
    print '<div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Algo errado!</strong> Lembrando que todos os campos são de preenchimento obrigatório!!!
                            </div>';
} else {
    echo "<br>";
    echo '02';
    // include '../co/class.php';

    // Conectar();

    include '../connection.php';

    $conn = DatabaseConnection::getConnection();

    // SQL query for insertion
    $sql = "INSERT INTO usuarios (nome, email, nm_login, nm_senha, menu,  data,  nv_acesso, device_token, bearer_token) VALUES ('$nome', '$email', '$nm_login', '$nm_senha', '1', now(), '1', '', '')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
