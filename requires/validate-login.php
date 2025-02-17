<?php
session_start();
// include( "../co/class.php" );

include '../connection.php';

$emaillogin = filter_input(INPUT_POST, 'emaillogin', FILTER_SANITIZE_STRING);
// $passlogin = filter_input(INPUT_POST, 'passlogin', FILTER_SANITIZE_STRING);
$passlogin = filter_input(INPUT_POST, 'passlogin');

if ((!empty($emaillogin)) and (!empty($passlogin))) {

  $conn = DatabaseConnection::getConnection();

  $result_usuario = "SELECT id, nome, nv_acesso, nm_login, nm_senha, device_token, id_atendente, nome_atendente FROM usuarios WHERE nm_login='$emaillogin' LIMIT 1";
  $resultado_usuario = mysqli_query($conn, $result_usuario);
  if ($resultado_usuario) {
    $row_usuario = mysqli_fetch_assoc($resultado_usuario);

    if (password_verify($passlogin, $row_usuario['nm_senha'])) {

      $_SESSION['cd_adm'] = $row_usuario['id'];
      $_SESSION['nome'] = $row_usuario['nome'];
      $_SESSION['nv_acesso'] = $row_usuario['nv_acesso'];

      $_SESSION['device_token'] = $row_usuario['device_token'];
      
      $_SESSION['id_atendente'] = $row_usuario['id_atendente'];

      // if($_SESSION['nv_acesso'] == "1" ){header( "Location: ../admin-corretor.php?page=in&&infos=timob" );}

      if ($_SESSION['nv_acesso'] == "1") {
        header("Location: ../mainPage/index.php");
      } elseif ($_SESSION['nv_acesso'] == "2") {
        $_SESSION['id_atendente'] = $row_usuario['id_atendente'];
        $_SESSION['nome_atendente'] = $row_usuario['nome_atendente'];
        header("Location: ../index.php");
      } else {
        header("Location: ../checking?login=check");
      }
    } else {
      $_SESSION['msg'] = "Login e senha incorreto!";
      // header("Location: ../index2.php");
      header("Location: ../auth-login.php");
      // echo "<script> alert(\"Senha Incorreta\"); </script>";
    }
  } else {
    $_SESSION['msg'] = "Login e senha incorreto!";
    // header("Location: ../index1.php");
    header("Location: ../auth-login.php");
  }
} else {
  $_SESSION['msg'] = "Login e senha incorreto!";
  // header("Location: ../index0.php");
  header("Location: ../auth-login.php");
}
