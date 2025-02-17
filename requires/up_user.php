<?php
if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
  $nome = strip_tags(trim($_POST['nome']));
  $nv_acesso = strip_tags(trim($_POST['nv_acesso']));
  // $cpf = strip_tags(trim($_POST['cpf']));
  $email = strip_tags(trim($_POST['email']));
  $datanasc = strip_tags(trim($_POST['datanasc']));
  $nm_login = strip_tags(trim($_POST['nm_login']));
  $nm_senha = password_hash($_POST['nm_senha'], PASSWORD_DEFAULT);

  $foto = 'images/user.png';

  $data = date("d/m/Y");

  if (empty($nome)) {
    print '<div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Algo errado!</strong> Lembrando que todos os campos são de preenchimento obrigatório!!!
                                </div>';
  } else {
    $cadastrar = mysql_query("INSERT INTO usuario (nome, nv_acesso, cpf, email, datanasc, nm_login, nm_senha, foto, menu,  data) VALUES ('$nome', '$nv_acesso', '$cpf', '$email', '$datanasc', '$nm_login', '$nm_senha', '$foto', '1', now())");
    date_default_timezone_set('America/Sao_Paulo');
    $dataLocal = date('Y-m-d H:i:s', time());
    $log = mysql_query("INSERT INTO log (cd_user, atividade, hora, data ) VALUES ('$getUserID', 'Cadastrou o usuário - $nome',  '$dataLocal', '$dataLocal')");
    print '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                </button>
                                                <strong>Terminado!</strong> Usuário cadastrado com sucesso!
                                            </div>';
  }
}
