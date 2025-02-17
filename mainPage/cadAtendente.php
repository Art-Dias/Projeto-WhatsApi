<?php
session_start();
$device_token = $_SESSION['device_token'];

include '../co/class.php';
Proteger2();

?>

<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from templates.hibootstrap.com/farol/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Mar 2024 11:28:31 GMT -->

<?php
include '../connection.php';
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="assets/css/remixicon.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/sidebar-menu.css">
    <link rel="stylesheet" href="assets/css/simplebar.css">
    <link rel="stylesheet" href="assets/css/apexcharts.css">
    <link rel="stylesheet" href="assets/css/prism.css">
    <link rel="stylesheet" href="assets/css/rangeslider.css">
    <link rel="stylesheet" href="assets/css/sweetalert.min.css">
    <link rel="stylesheet" href="assets/css/quill.snow.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="icon" type="image/png" href="assets/images/favicon2.png">

    <!-- Include SweetAlert JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.3/dist/sweetalert2.all.min.js"></script> -->
    <script src="../assets/fonts/sweetalert2.all.min.js"></script>

    <title>Cadastro Atendente</title>
</head>

<body>

    <div class="preloader" id="preloader">
        <div class="preloader">
            <div class="waviy position-relative">
                <span class="d-inline-block">T</span>
                <span class="d-inline-block">O</span>
                <span class="d-inline-block">U</span>
                <span class="d-inline-block">C</span>
                <span class="d-inline-block">H</span>
            </div>
        </div>
    </div>


    <div class="sidebar-area" id="sidebar-area">
        <div class="logo position-relative">
            <a href="index-2.html" class="d-block text-decoration-none">
                <script type="text/javascript" style="display:none">
                    //<![CDATA[
                    window.__mirage2 = {
                        petok: "E6OShBzfzyzOVqRNZ7yq5IBtP.uhC5gRDVyNGSDFiZg-1800-0.0.1.1"
                    };
                    //]]>
                </script>
                <!-- <script type="text/javascript" src="../../ajax.cloudflare.com/cdn-cgi/scripts/04b3eb47/cloudflare-static/mirage2.min.js"></script> -->
                <img data-cfsrc="assets/images/logo-icon.png" alt="logo-icon" style="display:none;visibility:hidden;"><noscript><img src="assets/images/logo-icon.png" alt="logo-icon"></noscript>
                <span class="logo-text fw-bold text-dark">Touch</span>
            </a>
            <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
                <i data-feather="x"></i>
            </button>
        </div>
        <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
            <ul class="menu-inner">
                <li class="menu-item mb-0" style="padding-bottom: 15px;">
                    <a href="index.php" class="menu-link">
                        <i data-feather="home" class="menu-icon tf-icons"></i>
                        <span class="title">Inicio</span>
                    </a>
                </li>
            </ul>
            </li>

            <!--  -->
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">Atendentes</span>

            </li>
            <li class="menu-item">
                <a href="selecionarAtendente.php" class="menu-link">
                    <i data-feather="message-square" class="menu-icon tf-icons"></i>
                    <span class="title">Selecionar Atendente</span>
                </a>
            </li>

            <!-- <li class="menu-item">
                <a href="wizard.php" class="menu-link">
                    <i data-feather="file-text" class="menu-icon tf-icons"></i>
                    <span class="title">Gerenciar Clientes</span>
                </a>
            </li> -->

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="columns" class="menu-icon tf-icons"></i>
                    <span class="title">Gerenciar Clientes</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="wizard.php" class="menu-link">
                            Vincular Cliente a Atendente
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="listaClientes.php" class="menu-link">
                            Gerenciar Clientes
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="cadAtendente.php" class="menu-link">
                    <i data-feather="user" class="menu-icon tf-icons"></i>
                    <span class="title">Gerenciar Atendentes</span>
                </a>
            </li>
            <!--  -->

            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">APPS</span>

            </li>
            <!-- <li class="menu-item">
                <a href="../index.php" class="menu-link">
                    <i data-feather="message-square" class="menu-icon tf-icons"></i>
                    <span class="title">Chat</span>
                </a> -->
            </li>

            <li class="menu-item">
                <a href="#" onclick="submitForm(event)" class="menu-link">
                    <i data-feather="message-square" class="menu-icon tf-icons"></i>
                    <span class="title">Chat</span>
                </a>
            </li>

            <form id="postForm" action="../index.php" method="POST" style="display: none;">
                <input type="hidden" name="atendente" id="atendenteInput" value="">
                <!-- Add more hidden inputs as needed -->
            </form>

            <script>
                function submitForm(event) {
                    event.preventDefault(); // Prevent default link behavior

                    // Set the value of the hidden input
                    document.getElementById("atendenteInput").value = "1, ADM";

                    // Submit the form
                    document.getElementById("postForm").submit();
                }
            </script>
            </ul>
            </li>


            <!-- </li> -->
            <!-- </ul> -->
        </aside>
        <div class="bg-white z-1 admin">
            <div class="d-flex align-items-center admin-info border-top">
                <div class="flex-shrink-0">
                    <a href="profile.html" class="d-block">
                        <img data-cfsrc="assets/images/admin.jpg" class="rounded-circle wh-54" alt="admin" style="display:none;visibility:hidden;"><noscript><img src="assets/images/admin.jpg" class="rounded-circle wh-54" alt="admin"></noscript>
                    </a>
                </div>
                <div class="flex-grow-1 ms-3 info">
                    <a href="#" class="d-block name"><?php echo $_SESSION['nome'] ?></a>
                    <a href="logout.php">Encerrar Sessão</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="main-content d-flex flex-column">

            <header class="header-area bg-white mb-4 rounded-bottom-10" id="header-area">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-sm-6 col-md-4">
                        <div class="left-header-content">
                            <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                                <li>
                                    <button class="header-burger-menu bg-transparent p-0 border-0" id="header-burger-menu">
                                        <i data-feather="menu"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-6 col-md-8">
                        <div class="right-header-content mt-2 mt-sm-0">
                            <ul class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                                <li class="header-right-item d-none d-md-block">
                                    <div class="today-date">
                                        <span id="digitalDate"></span>
                                        <i data-feather="calendar"></i>
                                    </div>
                                </li>
                                <li class="header-right-item">
                                    <div class="dropdown admin-profile">
                                        <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor" data-bs-toggle="dropdown">
                                            <div class="flex-shrink-0">
                                                <img class="rounded-circle wh-54" data-cfsrc="assets/images/admin.jpg" alt="admin" style="display:none;visibility:hidden;"><noscript><img class="rounded-circle wh-54" src="assets/images/admin.jpg" alt="admin"></noscript>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-none d-xxl-block">
                                                        <span class="degeneration">Admin</span>
                                                        <div class="d-flex align-content-center">
                                                            <h3>Adison Jeck</h3>
                                                            <div class="down">
                                                                <i data-feather="chevron-down"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu border-0 bg-white w-100 admin-link">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-body" href="profile.html">
                                                    <i data-feather="user"></i>
                                                    <span class="ms-2">Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-body" href="account.html">
                                                    <i data-feather="settings"></i>
                                                    <span class="ms-2">Setting</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-body" href="logout.html">
                                                    <i data-feather="log-out"></i>
                                                    <span class="ms-2">Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">

            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <h4 class="fs-18 mb-4">Cadastro Atendente</h4>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
                                    <div class="tab-content" id="myTabstepContent">
                                        <div class="tab-pane fade show active" id="step1-tab-pane" role="tabpanel" aria-labelledby="step1-tab" tabindex="0">
                                            <!-- <h4 class="fs-18 fw-semibold"></h4> -->
                                            <p class="text-gray-light mb-4">Preencha os campos para Cadastrar um novo atendente</p>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4">
                                                            <label class="label">Nome</label>
                                                            <div class="form-group position-relative">
                                                                <input type="text" id="nome-cadastro" class="form-control text-dark ps-5 h-58" placeholder="Inserir Nome" required>
                                                                <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4">
                                                            <label class="label">Usuário</label>
                                                            <div class="form-group position-relative">
                                                                <input type="text" id="usuario-cadastro" class="form-control text-dark ps-5 h-58" placeholder="Usuário" required>
                                                                <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4">
                                                            <label class="label">Senha</label>
                                                            <div class="form-group position-relative">
                                                                <input type="password" id="senha-cadastro" class="form-control text-dark ps-5 h-58" placeholder="****" required>
                                                                <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkBoxAdm">
                                                        <label class="form-check-label fw-semibold fs-16 mb-0 text-dark" for="checkBoxAdm">
                                                            ADM
                                                        </label>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group d-flex gap-3">
                                                            <button type="button" class="btn btn-primary py-3 px-5 fw-semibold text-white" onclick="showSweetAlertCad()">Finalizar</button>
                                                        </div>
                                                        <script>
                                                            function showSweetAlertCad() {
                                                                var nome = document.getElementById('nome-cadastro').value;
                                                                Swal.fire({
                                                                    // title: '',
                                                                    text: `Confirmar Cadastro de ${nome}?`,
                                                                    // icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    cancelButtonText: 'Cancelar',
                                                                    confirmButtonText: 'Confirmar!'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        cadastrar();
                                                                    }
                                                                });
                                                            }

                                                            function cadastrar() {
                                                                var nome = document.getElementById('nome-cadastro').value;
                                                                var senha = document.getElementById('senha-cadastro').value;
                                                                var user = document.getElementById('usuario-cadastro').value;
                                                                // 1 == checked and 2 == not checked
                                                                var checkBoxAdm = document.getElementById('checkBoxAdm').checked ? 1 : 2;

                                                                document.getElementById('nome-cadastro').value = '';
                                                                document.getElementById('senha-cadastro').value = '';
                                                                document.getElementById('usuario-cadastro').value = '';

                                                                console.log(`${nome}`);

                                                                var xhttp = new XMLHttpRequest();
                                                                xhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        var resposta = this.responseText;
                                                                        if (resposta == "usuario já existe") {
                                                                            Swal.fire({
                                                                                text: `Usuário indisponivel`,
                                                                                icon: "error"
                                                                            });
                                                                        } else {
                                                                            console.log(`oi ${resposta}`);

                                                                            Swal.fire({
                                                                                text: `Concluido`,
                                                                                icon: "success"
                                                                            });
                                                                        }
                                                                    }
                                                                };
                                                                xhttp.open("POST", "scriptCadastroAtendente.php", true);
                                                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                                xhttp.send("nome=" + encodeURIComponent(nome) + "&senha=" + encodeURIComponent(senha) + "&usuario=" + encodeURIComponent(user) + "&adm=" + checkBoxAdm);

                                                            };

                                                            function criarContaAtendente() {
                                                                var nome = document.getElementById('nome-cadastro').value;

                                                                document.getElementById('nome-cadastro').value = '';

                                                                console.log(`${nome}`);

                                                                var xhttp = new XMLHttpRequest();
                                                                xhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        var a = this.responseText;
                                                                        console.log(`oi ${a}`);

                                                                        Swal.fire({
                                                                            text: `Concluido`,
                                                                            icon: "success"
                                                                        });
                                                                    }
                                                                };
                                                                xhttp.open("GET", "scriptCadastroAtendente.php?nome=" + nome, true);
                                                                xhttp.send();
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <h4 class="fs-18 mb-4">Remover Atendente</h4>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
                                    <div class="tab-content" id="myTabstepContent">
                                        <div class="tab-pane fade show active" id="step1-tab-pane" role="tabpanel" aria-labelledby="step1-tab" tabindex="0">
                                            <!-- <h4 class="fs-18 fw-semibold"></h4> -->
                                            <p class="text-gray-light mb-4">Selcione atendente para ser removido</p>
                                            <form action="excluirAtendente.php" method="post" target="resultFrame">
                                                <!-- <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-4">
                                                            <label class="label">Nome</label>
                                                            <div class="form-group position-relative">
                                                                <input type="text" id="nome-cadastro" class="form-control text-dark ps-5 h-58" placeholder="Enter Name" required>
                                                                <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group d-flex gap-3">
                                                            <button type="button" class="btn btn-primary py-3 px-5 fw-semibold text-white" onclick="cadastrar()">Finalizar</button>
                                                        </div>
                                                        <script>
                                                            function cadastrar() {
                                                                var nome = document.getElementById('nome-cadastro').value;

                                                                document.getElementById('nome-cadastro').value = '';

                                                                console.log(`${nome}`);

                                                                var xhttp = new XMLHttpRequest();
                                                                xhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        var a = this.responseText;
                                                                        console.log(`oi ${a}`);

                                                                        window.confirm("Cadastrado");
                                                                    }
                                                                };
                                                                xhttp.open("GET", "scriptCadastroAtendente.php?nome=" + nome, true);
                                                                xhttp.send();

                                                            };
                                                        </script>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-4">
                                                        <label class="label">Atendente</label>
                                                        <div class="form-group position-relative">

                                                            <!-- voltar aqui -->
                                                            <select name="idSelecionado" id="idSelecionado" class="form-select  ps-5 h-58 js-example-basic-single form-control" aria-label="Default select example" style="color: black;">
                                                                <?php

                                                                try {
                                                                    // $conn = mysqli_connect($server, $usuario, $senha, $banco);
                                                                    $conn = DatabaseConnection::getConnection();

                                                                    $sqlAtendentes = "SELECT * FROM `atendentes_$device_token` WHERE id != 1 ORDER BY id ASC";

                                                                    $resultSql = mysqli_query($conn, $sqlAtendentes);
                                                                    while ($row = mysqli_fetch_assoc($resultSql)) {
                                                                        $getName = $row['nome'];
                                                                        $getId = $row['id'];
                                                                        echo "<option value=\"$getId\">$getName</option>";
                                                                    }

                                                                    mysqli_close($conn);
                                                                } catch (Exception $e) {
                                                                    // Code to handle the exception
                                                                    $error = $e->getMessage();
                                                                    echo "Caught exception: " . $e->getMessage();
                                                                    echo "<option value=\"$getName\">$e</option>";
                                                                    echo "<option value=\"$getName\">$error</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            <i class="ri-list-ordered position-absolute top-50 start-0 translate-middle-y fs-20 ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex gap-3">
                                                        <button type="button" class="btn btn-primary py-3 px-5 fw-semibold text-white" onclick="showSweetAlertRemover()">Finalizar</button>
                                                    </div>
                                                </div>
                                                <iframe name="resultFrame" style="display:none;"></iframe>
                                            </form>
                                            <script>
                                                function showSweetAlertRemover() {
                                                    Swal.fire({
                                                        title: 'Está certo disto?',
                                                        text: 'Não será possivel reverter!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        cancelButtonText: 'Cancelar',
                                                        confirmButtonText: 'Sim, continuar!'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            remover();
                                                        }
                                                    });
                                                }

                                                function remover() {
                                                    var id = document.getElementById('idSelecionado').value;

                                                    // document.getElementById('nome-cadastro').value = '';

                                                    console.log(`${id}`);

                                                    var xhttp = new XMLHttpRequest();
                                                    xhttp.onreadystatechange = function() {
                                                        if (this.readyState == 4 && this.status == 200) {
                                                            var a = this.responseText;
                                                            console.log(`oi ${a}`);

                                                            Swal.fire({
                                                                text: 'Removido!',
                                                                icon: "success"
                                                            });
                                                            // window.confirm("Cadastrado");
                                                        }
                                                    };
                                                    xhttp.open("GET", "excluirAtendente.php?idSelecionado=" + id, true);
                                                    xhttp.send();

                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-grow-1"></div>

            <footer class="footer-area bg-white text-center rounded-top-10">
                <p class="fs-14">© <span class="text-primary">Touch</span></p>

        </div>
    </div>


    <button class="btn btn-danger theme-settings-btn p-0 position-fixed z-2 text-center" style="bottom: 30px; right: 30px; width: 40px; height: 40px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <i data-feather="settings" class="wh-20 text-white position-relative" style="top: -1px; outline: none;" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Click On Theme Settings"></i>
    </button>
    <div class="offcanvas offcanvas-end bg-white" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
        <div class="offcanvas-header bg-body-bg py-3 px-4 mb-4">
            <h5 class="offcanvas-title fs-18" id="offcanvasScrollingLabel">Configurações de Aparencia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-4">
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">RTL / LTR</h4>
            <div class="settings-btn rtl-btn">
                <label id="switch" class="switch">
                    <input type="checkbox" onchange="toggleTheme()" id="slider">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">Claro / Escuro</h4>
            <button class="switch-toggle settings-btn dark-btn" id="switch-toggle">
                Click Para <span class="dark">Escuro</span> <span class="light">Claro</span>
            </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">Barra Lateral Clara / Escura</h4>
            <button class="sidebar-light-dark settings-btn sidebar-dark-btn" id="sidebar-light-dark">
                Click Para <span class="dark1">Escuro</span> <span class="light1">Claro</span>
            </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">Barra Superior Claro / Escuro</h4>
            <button class="header-light-dark settings-btn header-dark-btn" id="header-light-dark">
                Click Para <span class="dark2">Escuro</span> <span class="light2">Claro</span>
            </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">Barra Inferior Claro / Escuro</h4>
            <button class="footer-light-dark settings-btn footer-dark-btn" id="footer-light-dark">
                Click Para <span class="dark3">Escuro</span> <span class="light3">Claro</span>
            </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">Estilo Circular / Quadrado</h4>
            <button class="card-radius-square settings-btn card-style-btn" id="card-radius-square">
                Click Para <span class="square">Square</span> <span class="radius">Radius</span>
            </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">Estilo BG Branco / Cinza</h4>
            <button class="card-bg settings-btn card-bg-style-btn" id="card-bg">
                Click Para <span class="white">White</span> <span class="gray">Gray</span>
            </button>
            <div class="mb-4 pb-2"></div>
            <h4 class="fs-15 fw-semibold border-bottom pb-2 mb-3">Container Style Fluid / Boxed</h4>
            <button class="boxed-style settings-btn fluid-boxed-btn" id="boxed-style">
                Click To <span class="fluid">Fluid</span> <span class="boxed">Boxed</span>
            </button>
        </div>
    </div>


    <!-- <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/dragdrop.js"></script>
    <script src="assets/js/rangeslider.min.js"></script>
    <script src="assets/js/sweetalert.js"></script>
    <script src="assets/js/quill.min.js"></script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/js/prism.js"></script>
    <script src="assets/js/clipboard.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/simplebar.min.js"></script>
    <script src="assets/js/apexcharts.min.js"></script>
    <script src="assets/js/amcharts.js"></script>
    <!-- <script src="assets/js/custom/ecommerce-chart.js"></script> -->
    <script src="assets/js/custom/custom.js"></script>
</body>

<!-- Mirrored from templates.hibootstrap.com/farol/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Mar 2024 11:29:14 GMT -->

</html>