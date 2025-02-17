<?php

session_start();
$device_token = $_SESSION['device_token'];


include 'co/class.php';

Proteger();



/***
 * CONEXÃO
 */

require 'connection.php';
$connection = DatabaseConnection::getConnection();

// Definindo var $isIncludedDirectly, para poder definir qual código sera pego pelo require
$isIncludedDirectly = !debug_backtrace();


/**
 * TOKENS, SENHAS ACESSO
 */
// $device_token = "token02";



if (!debug_backtrace()) {
    /***
     * ID DA MAQUINA
     */

    // Setando id da maquina
    $maquina;
    // $maquina = 1;

    $i = 0;
    while ($i < 1000) {

        $arqExiste = "indicesCvs/indiceMsgCvsAtual$i.txt";

        $content = file_get_contents($arqExiste);

        if ($content == '') {
            // Specify the file name and mode (in this case, 'w' for write)
            // $filename = "arquivo$i.txt";
            // $mode = 'w';

            // Open the file for writing (create if it doesn't exist)
            // $file = fopen($filename, $mode);

            // Specify the file name and mode (in this case, 'w' for write)
            $filename0 = "indicesCvs/indiceMsgCvsAtual$i.txt";
            $mode0 = 'w';

            // Open the file for writing (create if it doesn't exist)
            $file = fopen($filename0, $mode0);

            $maquina = $i;

            file_put_contents("indicesCvs/indiceMsgCvsAtual$i.txt", ".");

            break;
        }
        $i++;
    };


    /***
     * ATENDENTE
     */

    // Setando atendente

    // if (isset($_SESSION['nome_atendente'])) {

    //     // Setando id e noem do atendente via SESSION (caso ele venha direto pelo login)
    //     $atendente = $_SESSION['id_atendente'];
    //     $nomeAtendente = $_SESSION['nome_atendente'];

    //     // Setar device_token
    //     // $sqlDeviceToken = ("SELECT device_token FROM usuarios WHERE id = 1");

    //     // $resultado_usuario = mysqli_query($connection, $sqlDeviceToken);
    //     // $row_usuario = mysqli_fetch_assoc($resultado_usuario);

    //     // $_SESSION['device_token'] = $row_usuario['device_token'];
    //     // $device_token = $row_usuario['device_token'];
    // }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedUser = $_POST["atendente"];

        // Split the selected value into individual values
        $individualValues = explode(",", $selectedUser);

        // Access individual values
        $atendente = $individualValues[0];
        $nomeAtendente = $individualValues[1];
    } elseif (isset($_SESSION['nome_atendente'])) {

        // Setando id e noem do atendente via SESSION (caso ele venha direto pelo login)
        $atendente = $_SESSION['id_atendente'];
        $nomeAtendente = $_SESSION['nome_atendente'];
    }

    // $atendente = "1";

    /***
     * SEARCHIN THE NAME AND NUMBERS INTO THE ATENDETE CHATS (JSON)
     */

    //Search the name and numbers linked to the select Atendente
    // $connection = DatabaseConnection::getConnection();

    // $result = $connection->query("select chats from atendentes where id = \"$atendente\"");
    $result = $connection->query("select chats from `atendentes_$device_token` where id = \"$atendente\"");
    $rowValue = mysqli_fetch_assoc($result);
    $JSONchats = $rowValue['chats'];

    $array_dos_contatos = json_decode($JSONchats, true);

    $numeroDeContatos = count($array_dos_contatos);

    $numero = array_keys($array_dos_contatos);
}

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive Bootstrap 5 Chat App" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/faviconchat.png">

    <!-- magnific-popup css -->
    <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.theme.default.min.css">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap9.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0" />

    <!-- Preloader -->
    <link rel="stylesheet" href="assets/css/preloader3.css">


</head>

<body>


    <div class="layout-wrapper d-lg-flex">

        <!-- Start  -->
        <!-- sidebar-menu  -->
        <!-- <div class="side-menu flex-lg-column me-lg-1 ms-lg-0"> -->
        <!-- LOGO -->
        <!-- <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/" alt="" height="30">
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/" alt="" height="30">
                    </span>
                </a>
            </div> -->
        <!-- end navbar-brand-box -->

        <!-- Start side-menu nav -->
        <!-- <div class="flex-lg-column my-auto">
                <ul class="nav nav-pills side-menu-nav justify-content-center" role="tablist">
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Chats">
                        <a class="nav-link active" id="pills-chat-tab" data-bs-toggle="pill" href="#pills-chat" role="tab">
                            <i class="ri-message-3-line"></i>
                        </a>
                    </li>

                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings">
                        <a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#pills-setting" role="tab">
                            <i class="ri-settings-2-line"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown profile-user-dropdown d-inline-block d-lg-none">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="assets/images/users/avatar-1.jpg" alt="" class="profile-user rounded-circle">
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Profile <i class="ri-profile-line float-end text-muted"></i></a>
                            <a class="dropdown-item" href="#">Setting <i class="ri-settings-3-line float-end text-muted"></i></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Log out <i class="ri-logout-circle-r-line float-end text-muted"></i></a>
                        </div>
                    </li>
                </ul>
            </div> -->
        <!-- end side-menu nav -->
        <!-- 
            <div class="flex-lg-column d-none d-lg-block">
                <ul class="nav side-menu-nav justify-content-center"> -->
        <!-- <li class="nav-item">
                        <a class="nav-link light-dark-mode" href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="Dark / Light Mode">
                            <i class='ri-sun-line theme-mode-icon'></i>
                        </a>
                    </li> -->

        <!-- <li class="nav-item btn-group dropup profile-user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="assets/images/users/avatar-1.jpg" alt="" class="profile-user rounded-circle">
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Profile <i class="ri-profile-line float-end text-muted"></i></a>
                            <a class="dropdown-item" href="#">Setting <i class="ri-settings-3-line float-end text-muted"></i></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="auth-login.php">Log out <i class="ri-logout-circle-r-line float-end text-muted"></i></a>
                        </div>
                    </li> -->
        <!-- </ul>
            </div> -->
        <!-- Side menu user -->
        <!-- </div> -->
        <!-- end left sidebar-menu -->

        <!-- start chat-leftsidebar -->
        <div class="chat-leftsidebar me-lg-1 ms-lg-0">

            <div class="tab-content">
                <!-- Start Profile tab-pane -->

                <!-- End Profile tab-pane -->

                <!-- Start chats tab-pane -->
                <div class="tab-pane fade show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
                    <!-- Start chats content -->
                    <div>
                        <div class="px-4 pt-4">
                            <h4 class="mb-4"><?php echo $nomeAtendente; ?></h4>
                        </div> <!-- .p-4 -->

                        <!-- Start chat-message-list -->
                        <div class="">
                            <h5 class="mb-3 px-3 font-size-16">Conversas</h5>

                            <div class="chat-message-list px-2" data-simplebar>

                                <ul class="list-unstyled chat-list chat-user-list">

                                    <?php

                                    // Pegando fotos para mostrar no chat
                                    // API
                                    $curl = curl_init();

                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'https://cluster.apigratis.com/api/v2/whatsapp/getAllContacts',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 0,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => 'POST',
                                        CURLOPT_HTTPHEADER => array(
                                            'Content-Type: application/json',
                                            "DeviceToken: $device_token",
                                            'Authorization: Bearer token01'
                                        ),
                                    ));

                                    $response_fotos = curl_exec($curl);

                                    curl_close($curl);


                                    $array_geral_fotos = json_decode($response_fotos, true);

                                    $array_contatos_fotos = $array_geral_fotos['response']['contacts'];


                                    // Gerar array dicionário com todos os numeros e src da foto (["551388111" => "web.whats.dds/daskljdsakjdsa"])
                                    $lenArrayFotos = count($array_contatos_fotos);

                                    $listaNumeroFotos = [];

                                    $contadorPegarFotos = 0;

                                    while ($contadorPegarFotos <= $lenArrayFotos) {
                                        $userNumber = $array_contatos_fotos["$contadorPegarFotos"]['data']['id']['user'];
                                        $imgUrl = $array_contatos_fotos["$contadorPegarFotos"]['data']['profilePicThumbObj']['img'];

                                        $listaNumeroFotos[$userNumber] = $imgUrl;

                                        $contadorPegarFotos++;
                                    }

                                    // Gerar array dicionario com contatos que o atendente atende e seus nomes
                                    // $sqlPegarContatosParaFotos = $connection->query("SELECT chats FROM `atendentes` WHERE id = \"$atendente\"");
                                    $sqlPegarContatosParaFotos = $connection->query("SELECT chats FROM `atendentes_$device_token` WHERE id = \"$atendente\"");
                                    $rowValue = mysqli_fetch_assoc($sqlPegarContatosParaFotos);
                                    $JSONchats1 = $rowValue['chats'];

                                    $array_dos_contatos_comparar_fotos = json_decode($JSONchats1, true);

                                    // Gerar array dicionario com contatos que atendente atende e suas fotos
                                    $array_contatos_fotos_final = array();

                                    foreach ($array_dos_contatos_comparar_fotos as $key => $value) {
                                        if (isset($listaNumeroFotos[$key])) {
                                            $array_contatos_fotos_final[$key] = $listaNumeroFotos[$key];
                                        }
                                    }


                                    /** SHOWING THE CLIENT THAT THE ATTENDANT CAN ACESS THE CHAT ON THE "chatList" DIV
                                     * 
                                     */

                                    // Salvar os clientes que enviaram mensagem
                                    $listaClientes = array();

                                    // $array_fotos = $array_contatos_fotos_final;

                                    // Listando todos os clientes marcados com label do atendente
                                    $contador = 0;
                                    while ($contador < $numeroDeContatos) {
                                        // $contatoNumber = $array_dos_contatos["$contador"]['id']['user'];
                                        $contatoNumber = $numero[$contador];

                                        // $contato_formattedName = $array_dos_contatos["$contador"]['contact']['formattedName'];
                                        $contato_formattedName = $array_dos_contatos["$contatoNumber"];

                                        if (1 == 1) {
                                            $nomeSelecionado = $contato_formattedName;
                                            $numeroSelecionado = $contatoNumber;
                                            $zero = 0;

                                            if (array_key_exists($numeroSelecionado, $array_contatos_fotos_final)) {
                                                $profilePicture = $array_contatos_fotos_final[$numeroSelecionado];
                                                echo "<li> <a href=\"#\" onclick=\"numeroAtual('$numeroSelecionado', '$nomeSelecionado'); limparAvisoNovaMsg('$numeroSelecionado'); updateContent('$numeroSelecionado', $zero); setarUltimaMsgConversaAtual('$numeroSelecionado');\"> <div class=\"d-flex\"> <div style=\"display:none\">$contato_formattedName</div> <div class=\"chat-user-img align-self-center me-3 ms-0\"> <div class=\"avatar-xs\"> <span class=\"avatar-title rounded-circle bg-primary-subtle text-primary\"> <span class=\"material-symbols-rounded\" aria-hidden=\"true\"><img id=\"imagem$numeroSelecionado\" src=\"$profilePicture\" alt=\"FP\" style=\"max-block-size: 34px; border-radius: 50%;\"></span> </span> </div> </div> <div class=\"flex-grow-1 overflow-hidden\"> <h5 class=\"text-truncate font-size-15 mb-1\">$contato_formattedName</h5> </div> <div class=\"unread-message\" style=\"display:none; margin-bottom: 10px;\" id=\"$numeroSelecionado\"> <span class=\"badge badge-soft-danger rounded-pill\">10</span> </div> </div> </a> </li>
                                                ";
                                            } else {
                                                echo "<li> <a href=\"#\" onclick=\"numeroAtual('$numeroSelecionado', '$nomeSelecionado'); limparAvisoNovaMsg('$numeroSelecionado'); updateContent('$numeroSelecionado', $zero); setarUltimaMsgConversaAtual('$numeroSelecionado');\"> <div class=\"d-flex\"> <div style=\"display:none\">$contato_formattedName</div> <div class=\"chat-user-img align-self-center me-3 ms-0\"> <div class=\"avatar-xs\"> <span class=\"avatar-title rounded-circle bg-primary-subtle text-primary\"> <span class=\"material-symbols-rounded\" aria-hidden=\"true\">person</span><img id=\"imagem$numeroSelecionado\" src=\"assets/images/users/teste.jpg\" alt=\"FP\" style=\"display: none;\"> </span> </div> </div> <div class=\"flex-grow-1 overflow-hidden\"> <h5 class=\"text-truncate font-size-15 mb-1\">$contato_formattedName</h5> </div> <div class=\"unread-message\" style=\"display:none; margin-bottom: 10px;\" id=\"$numeroSelecionado\"> <span class=\"badge badge-soft-danger rounded-pill\">10</span> </div> </div> </a> </li>
                                                ";
                                            }


                                            array_push($listaClientes, $numeroSelecionado);
                                        }
                                        $contador++;
                                    }
                                    ?>

                                </ul>

                                <?php
                                // Criando array onde cada item é associado a sua posição na lista ['item1' => 1, 'item2' => 2]
                                $associative_array = array();

                                foreach ($listaClientes as $index => $value) {
                                    //Fazendo append no meu array
                                    $associative_array[$value] = $index + 1;
                                }
                                ?>
                            </div>
                        </div>
                        <!-- End chat-message-list -->
                    </div>

                    <audio id="notificationSound" style="display: none;">
                        <source src="assets/fonts/notification2.wav" type="audio/mpeg">
                        <!-- Your browser does not support the audio element. -->
                    </audio>

                    <!-- SCRIPT PARA ATUALIZAR CONVERSAS -->
                    <script>
                        /** ESQUEMA QUE CHECA SE EXISTEM NOVAS MENSAGENS PARA NOTIFICAR
                         * 
                         */


                        var numeroDoContatoAtual;

                        function numeroAtual(numeroSelecionado, nomeTopoChat) {
                            // Setando foto de perfil 
                            var imagemSrc = document.getElementById(`imagem${numeroSelecionado}`);

                            if (imagemSrc != null) {
                                var srcValue = imagemSrc.getAttribute("src");
                                var divFoto = document.getElementById('fotoTopoChat');
                                divFoto.src = srcValue;
                            } else {
                                console.log('teste');
                            }


                            var nome = document.getElementById('nomeTopoChat');
                            nome.innerHTML = `${nomeTopoChat}`;

                            var numero = numeroSelecionado;
                            numeroDoContatoAtual = numero;

                            // Setando numeroDeMensagens que devem carregar como 20 (resetando o carregar mais)
                            numeroDeMensagens = 20;
                        }

                        // Intervalo que a função ficara sendo chamada
                        let intervalId0;

                        var array_numeros = [];

                        // Array guardando numeros dos cantatos
                        var associative_array = <?php echo json_encode($associative_array); ?>;
                        console.log(associative_array);

                        // Pegando id da maquina
                        var idMaquina = <?php echo $maquina; ?>;

                        // Valor que irei chamar a função a pela primeira vez
                        var valor = 0;
                        updateListaChats(valor, 0);;

                        function updateListaChats(callNum, numeroAtual) {

                            // Make an AJAX request to the PHP script
                            var xhttp = new XMLHttpRequest();
                            xhttp.open("GET", "functions/novasMensagens.php?callNum=" + callNum + "&idMaquina=" + idMaquina, true);

                            xhttp.onreadystatechange = function() {
                                if (xhttp.readyState == 4 && xhttp.status == 200) {
                                    // Coloacando o json dentro de um array
                                    var array_numeros = JSON.parse(xhttp.responseText);

                                    console.log(array_numeros);

                                    // Chamando função para marcar os numeros com mensagens novas
                                    var lenArrayNumeros = array_numeros.length;
                                    console.log(lenArrayNumeros);
                                    if (lenArrayNumeros > 0) {
                                        for (let i = 0; i < lenArrayNumeros; i++) {
                                            console.log(`${array_numeros[i]}` + " e " + numeroDoContatoAtual);

                                            if (`${array_numeros[i]}` != numeroDoContatoAtual) {

                                                // console.log(`Notifica o ${array_numeros[i]}`);

                                                // Get the element by ID
                                                var element = document.getElementById(`${array_numeros[i]}`);

                                                if (element.style.display == 'none') {
                                                    element.style.display = "block";

                                                    var audio = document.getElementById("notificationSound");
                                                    audio.play();
                                                }

                                            }
                                        }
                                    }
                                }
                            };

                            // Send the AJAX request
                            xhttp.send();

                            //Chamando a função que vai rechamar esse ajax para atualizar o chat a cada 2 segundos
                            if (callNum == 0) {
                                updateListaChatsLoop(numeroAtual);
                            }
                            if (callNum == 1) {
                                clearInterval(intervalId0);
                                updateListaChatsLoop(numeroAtual);
                            }
                        }

                        function updateListaChatsLoop(numeroAtual) {
                            // Limpando o invetervalo sempre que eu chamo a função dnv, para parar o intervalo que estava rodando antes e rodar o intervalo com os novos parametros
                            clearInterval(intervalId0);

                            // Esse intervalo é tipo um loop -while (true)- que fica rodando a cada x milisegundos
                            intervalId0 = setInterval(() => {
                                // Call updateContentOpenChat with the latest parameters
                                updateListaChats(1, numeroAtual);
                            }, 10000);
                        }

                        /** CLEAR NOTIFICATION AND SET THE MESSAGES AS READ WHEN CLICK ON A CLIENT
                         *
                         */

                        function limparAvisoNovaMsg(numero) {
                            // Make an AJAX request to the PHP script
                            var xhttp = new XMLHttpRequest();
                            xhttp.open("GET", "functions/setarMensagensLidas.php?numero=" + numero, true);

                            xhttp.onreadystatechange = function() {
                                if (xhttp.readyState == 4 && xhttp.status == 200) {
                                    var element = document.getElementById(numero);

                                    element.style.display = "none";
                                };

                            }
                            // Send the AJAX request
                            xhttp.send();
                        }
                    </script>


                    <!-- Start chats content -->
                </div>
                <!-- End chats tab-pane -->

                <!-- Start settings tab-pane -->

                <!-- End settings tab-pane -->
            </div>
            <!-- end tab content -->

        </div>
        <!-- end chat-leftsidebar -->

        <!-- Start User chat -->
        <div class="user-chat w-100 overflow-hidden">
            <div class="d-lg-flex">

                <!-- start chat conversation section -->
                <div class="w-100 overflow-hidden position-relative">
                    <div class="p-3 p-lg-4 border-bottom user-chat-topbar">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-8">
                                <div class="d-flex align-items-center" style="max-height: 40px;">
                                    <div class="d-block d-lg-none me-2 ms-0">
                                        <a href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i class="ri-arrow-left-s-line"></i></a>
                                    </div>

                                    <!-- <div class="mb-4">
                                        <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-lg img-thumbnail" alt="" style="max-width: 42px; max-height: 42px">
                                    </div> -->

                                    <div class="mb-4">
                                        <!-- <span class="material-symbols-rounded" aria-hidden="true" style="margin-top: 25px">person</span> -->
                                        <img id="fotoTopoChat" src="assets/images/users/teste.jpg" alt="" style="max-width: 36px; max-height: 36px; margin-top: 20px; border-radius: 50%;">
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <!-- Aqui -->
                                        <h5 class="font-size-16 mb-0 text-truncate"><a id="nomeTopoChat" href="#" class="text-reset user-profile-show" style="margin-left: 4px;">Bem Vindo</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 col-4">
                                <ul class="list-inline user-chat-nav text-end mb-0">
                                    <li class="list-inline-item">
                                        <a class="nav-link light-dark-mode" href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="Tema escuro / claro">
                                            <i class='ri-sun-line theme-mode-icon'></i>
                                            <!-- <div style="font-size: 28px">sun</div> -->
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-fill"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- <a class="dropdown-item d-block d-lg-none user-profile-show" href="#">View profile <i class="ri-user-2-line float-end text-muted"></i></a>
                                                <a class="dropdown-item d-block d-lg-none" href="#" data-bs-toggle="modal" data-bs-target="#audiocallModal">Audio <i class="ri-phone-line float-end text-muted"></i></a>
                                                <a class="dropdown-item d-block d-lg-none" href="#" data-bs-toggle="modal" data-bs-target="#videocallModal">Video <i class="ri-vidicon-line float-end text-muted"></i></a> -->
                                                <!-- <a class="dropdown-item" href="mainPage/logout.php">Encerrar sessão <i class="ri-archive-line float-end text-muted"></i></a> -->
                                                <a class="dropdown-item" href="mainPage/logout.php">Encerrar sessão</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end chat user head -->

                    <!-- start chat conversation -->
                    <!-- <div class="chat-conversation p-3 p-lg-4" data-simplebar="init" id="chat-container"> -->
                    <div class="chat-conversation p-3 p-lg-4" data-simplebar="init" id="chat-container">

                        <div id="topButton" style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); padding: 10px; background-color: rgb(240, 240, 240); color: black; box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2); cursor: pointer; transition: opacity 0.3s ease-in-out; border-radius: 45px; margin-top: 8px; z-index: 3; " class="hidden" onclick="carregarMaisMensagens()">Carregar mais</div>

                        <div id="botButton" class="hidden0" onclick="voltarAsUltimasMensagens()">&darr;</div>

                        <!-- <ul class="list-unstyled mb-0" id="message-area"> -->
                        <div id="message-area">

                            <div class="left">
                                <div class="conversation-list">
                                    <div class="user-chat-content">
                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Bem Vindo
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:00</span>
                                                </p>
                                            </div>
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-more-2-fill"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a>
                                                    <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="right">
                                <div class="conversation-list">
                                    <div class="user-chat-content">
                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <p class="mb-0">
                                                    Escolha uma conversa para começar!
                                                </p>
                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                    <span class="align-middle">10:00</span>
                                                </p>
                                            </div>
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-more-2-fill"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a>
                                                    <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- </ul> -->

                        <script>
                            function downloadBase64(base64, nomeArquivo) {

                                var base64Data0 = base64;
                                var base64Data = base64Data0.replace(' ', '');
                                var blob = base64ToBlob(base64Data);
                                var link = document.createElement('a');
                                link.href = window.URL.createObjectURL(blob);
                                link.download = `${nomeArquivo}`;
                                link.click();
                            }

                            function base64ToBlob(base64Data) {
                                var byteCharacters = atob(base64Data);
                                var byteNumbers = new Array(byteCharacters.length);
                                for (var i = 0; i < byteCharacters.length; i++) {
                                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                                }
                                var byteArray = new Uint8Array(byteNumbers);
                                return new Blob([byteArray], {
                                    type: 'application/octet-stream'
                                });
                            }

                            // Setando o botButton como invi
                            var button = document.getElementById('botButton');
                            button.style.display = 'none';

                            // Setando intevalo onde a função sera chamada
                            let intervalId;

                            // Pegando id da maquina
                            var idMaquina0 = <?php echo $maquina; ?>;

                            // Setando quantas mensagens serão mostradas ao clicar em 'Carregar Mais'
                            var numeroDeMensagens = 20;

                            // Script para aparecer botão de carregar novas mensagens
                            const chatContainer = document.getElementById('chat-container');
                            const topButton = document.getElementById('topButton');

                            chatContainer.addEventListener('mousemove', (e) => {
                                const rect = chatContainer.getBoundingClientRect();

                                // Checar se mouse está perto do topo
                                if (e.clientY - rect.top < 50) {
                                    topButton.classList.remove('hidden');
                                } else {
                                    topButton.classList.add('hidden');
                                }
                            });

                            function mostrarbotButton() {
                                var button = document.getElementById('botButton');
                                button.style.display = 'block';
                            };


                            function voltarAsUltimasMensagens() {
                                // Setando numeroDeMensagens que devem carregar como 20 (resetando o carregar mais)
                                numeroDeMensagens = 20;

                                // Sumir com o botão
                                var button = document.getElementById('botButton');
                                button.style.display = 'none';

                                // Chamar a função pra voltar a rodar as mensagens
                                updateContent(numeroDoContatoAtual, 0);
                            }


                            function carregarMaisMensagens() {
                                // Parando de carregar mensagens
                                clearInterval(intervalId);

                                // Chamar mais 20 mensagens que for clicado dnv
                                numeroDeMensagens += 20;

                                // Make an AJAX request to the PHP script with the function name and value
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        // Display the result in the result div
                                        document.getElementById("message-area").innerHTML = this.responseText;
                                    }
                                };
                                xhttp.open("GET", "functions/mensagensAnteriores.php?numero=" + numeroDoContatoAtual + "&numeroDeMensagens=" + numeroDeMensagens, true);
                                xhttp.send();

                                mostrarbotButton()
                            }

                            var scrollableDiv = document.getElementById('message-area');

                            function updateContent(numeroSelecionado, varNum) {

                                if (varNum == 0) {
                                    // Preloader
                                    var preloader = '<div class="preloader" id="preloader"> <div class="preloader"> <div class="waviy position-relative"> <span class="d-inline-block">T</span> <span class="d-inline-block">O</span> <span class="d-inline-block">U</span> <span class="d-inline-block">C</span> <span class="d-inline-block">H</span> </div> </div> </div>'

                                    document.getElementById("message-area").innerHTML = preloader;
                                }

                                // console.log('update Content');
                                // Make an AJAX request to the PHP script with the function name and value
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        // Display the result in the result div
                                        if (varNum == 0) {
                                            document.getElementById("message-area").innerHTML = this.responseText;

                                            $('.simplebar-content-wrapper').scrollTop(scrollableDiv.scrollHeight);
                                            // document.getElementsByClassName("list-unstyled").innerHTML = this.responseText;
                                        } else if (varNum == 1) {
                                            // Create a new div element
                                            var newDiv = document.createElement("div");

                                            // Set the innerHTML of the new div
                                            newDiv.innerHTML = this.responseText;


                                            // var newLi = document.createElement("li")
                                            // newLi = this.responseText;

                                            // Append the new div to the existing contentF
                                            if (this.responseText !== '') {
                                                document.getElementById("message-area").appendChild(newDiv);

                                                $('.simplebar-content-wrapper').scrollTop(scrollableDiv.scrollHeight);

                                                // Your HTML string
                                                // var htmlString = newLi;

                                                // Create a temporary div element to hold the HTML string
                                                // var tempDiv = document.createElement('div');
                                                // tempDiv.innerHTML = htmlString;

                                                // document.getElementById("message-area").appendChild(tempDiv.firstChild);

                                                // Scroll para o final da conversa quando chega nova mensagem
                                                // scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
                                            }
                                        }

                                    }
                                };
                                xhttp.open("GET", "functions/callFunction.php?myValue=" + numeroSelecionado + "&selfCall=" + varNum + "&idMaquina=" + idMaquina0, true);
                                xhttp.send();

                                //Chamando a função que vai rechamar esse ajax para atualizar o chat a cada 2 segundos
                                if (varNum == 0) {
                                    callUpdateContentLoop(numeroSelecionado);
                                }
                                if (varNum == 1) {
                                    clearInterval(intervalId);
                                    callUpdateContentLoop(numeroSelecionado);
                                }

                            }

                            function callUpdateContentLoop(numeroSelecionado) {
                                // Limpando o invetervalo sempre que eu chamo a função dnv, para parar o intervalo que estava rodando antes e rodar o intervalo com os novos parametros
                                clearInterval(intervalId);

                                //  Intervalo é tipo um loop -while (true)- fica rodando a cada x milisegundos || Se numero selecionado for igual a 1000 a função foi chamada só para parar o loop
                                if (numeroSelecionado != 1000) {
                                    intervalId = setInterval(() => {
                                        // Call updateContentOpenChat with the latest parameters
                                        updateContent(numeroSelecionado, 1);
                                    }, 3000);
                                }
                            }

                            function setarUltimaMsgConversaAtual(numero) {
                                var xhttp = new XMLHttpRequest();
                                xhttp.open("GET", "functions/ultimaMsgCvsAtual.php?numero=" + numero + "&idMaquina=" + idMaquina0, true);

                                xhttp.onreadystatechange = function() {
                                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                                        var a = 1;
                                    }
                                };

                                // Send the AJAX request
                                xhttp.send();
                            }
                        </script>

                    </div>
                    <!-- end chat conversation end -->

                    <!-- start chat input section -->
                    <div class="chat-input-section p-3 p-lg-4 border-top mb-0">

                        <div class="row g-0">

                            <div class="col">
                                <!-- <input type="text" class="form-control form-control-lg bg-light border-light" id="messageInput" placeholder="Digite sua mensagem..."> -->
                                <textarea type="text" class="form-control form-control-lg bg-light border-light" id="messageInput" placeholder="Digite sua mensagem..." style="max-height: 15px;"></textarea>

                            </div>

                            <div class="col-auto">
                                <div class="chat-input-links ms-md-2 me-md-0">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Selcionar Arquivo">
                                            <button type="button" class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect material-symbols-rounded" id="selectImage" aria-hidden="true" style="font-size: xx-large;">
                                                <!-- <i class="ri-attachment-line"></i> -->
                                                <div style="font-size: 28px">add</div>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="submit" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light" onclick="enviarMensagem()">
                                                <i class="ri-send-plane-2-fill"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div id="imagePopup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
                                <img id="popupImage" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: 80%;">
                                <button id="sendImage" style="position: absolute; bottom: 70px; right: 15%; background-color: #4CAF50; color: white; border: 2px solid #4CAF50; border-radius: 10px; padding: 10px 20px; font-size: 16px; cursor: pointer;">Confirmar Envio</button>
                                <button id="closePopup" style="position: absolute; bottom: 10px; right: 15%; background-color: #ff0000; color: white; border: 2px solid #ff0000; border-radius: 10px; padding: 10px 20px; font-size: 16px; cursor: pointer;">Cancelar Envio</button>
                            </div>
                        </div>
                    </div>
                    <!-- end chat input section -->

                    <script>
                        /**
                         * - TOKENS
                         */
                        var device = "<?php echo $device_token ?>";

                        /** 
                         * - ENVIAR IMAGEM
                         */

                        const selectImageButton = document.getElementById('selectImage');
                        // const imageBase64 = document.getElementById('imageData');
                        var imageBase64 = '';
                        const imagePopup = document.getElementById('imagePopup');
                        const popupImage = document.getElementById('popupImage');
                        const closePopupButton = document.getElementById('closePopup');
                        const sendImageButton = document.getElementById('sendImage');

                        selectImageButton.addEventListener('click', () => {
                            // Create a file input element dynamically
                            const fileInput = document.createElement('input');
                            fileInput.type = 'file';
                            fileInput.accept = 'image/*'; // Only accept image files

                            // Add event listener to handle file selection
                            fileInput.addEventListener('change', (event) => {
                                const file = event.target.files[0];

                                // Create a FileReader object
                                const reader = new FileReader();

                                // Event listener for when the file is read as Base64 data
                                reader.onload = (e) => {
                                    // Store the Base64 data in a variable
                                    var base64Data = e.target.result;

                                    // Set base64Data into my var out of this scope 
                                    imageBase64 = base64Data

                                    // You can further process or store the base64Data as needed
                                    // Set the image source in the popup
                                    popupImage.src = base64Data;

                                    // Show the popup
                                    imagePopup.style.display = "block";
                                };

                                // Read the file as Base64 data
                                reader.readAsDataURL(file);
                            });

                            // Trigger the click event on the dynamically created file input
                            fileInput.click();
                        });

                        // Close the popup when the close button is clicked
                        closePopupButton.addEventListener('click', () => {
                            imagePopup.style.display = "none";
                            console.log(imageBase64);
                        });

                        sendImageButton.addEventListener('click', () => {

                            imagePopup.style.display = "none";

                            var numero = numeroDoContatoAtual;

                            var formData = new FormData();
                            formData.append('imagem64', imageBase64);
                            formData.append('device', device);
                            formData.append('numeroDoContatoAtual', numero);

                            // Make an AJAX request to the PHP script with the function name and value
                            var xhttp = new XMLHttpRequest();

                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    var a = this.responseText;
                                    console.log(a);

                                }
                            };

                            // Change the request method to POST and send the FormData
                            xhttp.open("POST", "functions/enviarImagem.php", true);
                            xhttp.send(formData);
                        });


                        /** 
                         * - ENVIAR MENSAGEM
                         */

                        // Enviando msg no Enter
                        document.getElementById('messageInput').addEventListener('keypress', function(event) {
                            if (event.key === "Enter" && event.shiftKey) {
                                // Prevent default behavior of pressing Enter
                                event.preventDefault();

                                // Add a line break
                                this.value += "\n";
                            } else if (event.key === 'Enter') {
                                event.preventDefault(); // Prevent the default behavior of the Enter key
                                var a = document.getElementById('messageInput').value;

                                console.log(`ATA ${a} ATA`);
                                enviarMensagem(); // Call your function to handle the submission
                            }
                        });

                        var input = document.getElementById('messageInput')

                        function enviarMensagem() {

                            console.log(numeroDoContatoAtual);
                            var numero = numeroDoContatoAtual;
                            // var mensagemTexto = input.value;
                            var mensagemTextoCrua = input.value;
                            var mensagemTexto0 = mensagemTextoCrua.replace(/"/g, "'");
//                             var mensagemTexto0 = `aaa
// bbb
// ccc`;
                            var mensagemTexto = mensagemTexto0.replace(/\n/g, "\\n");

                            input.value = "";

                            var formData = new FormData();
                            formData.append('mensagemTexto', mensagemTexto);
                            formData.append('device', device);
                            formData.append('numeroDoContatoAtual', numero);

                            // Make an AJAX request to the PHP script with the function name and value
                            var xhttp = new XMLHttpRequest();

                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    var a = this.responseText;
                                    console.log(a);
                                }
                            };

                            // Change the request method to POST and send the FormData
                            xhttp.open("POST", "functions/enviarMensagem.php", true);
                            xhttp.send(formData);
                        }


                        /** 
                         * - EXCLUIR ULTIMAMSGCVS.TXT QUANDO PAGINA É FECHADA
                         */

                        var i0 = <?php echo $i; ?>
                        // Excluindo os arquivos quando a pagina é fechada
                        window.addEventListener('beforeunload', function(event) {
                            $(document).ready(function() {
                                // Your variable 'i'
                                var i = i0;

                                // Create a new XMLHttpRequest object
                                var xhr = new XMLHttpRequest();

                                // Configure it as a synchronous POST request
                                xhr.open('POST', 'functions/delete_files.php', false);

                                // Set the Content-Type header for a POST request
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                                // Construct the request payload with 'i'
                                var data = 'i=' + encodeURIComponent(i);

                                // Send the request with the payload
                                xhr.send(data);

                                // Check if the request was successful
                                if (xhr.status === 200) {
                                    // Process the response
                                    console.log(xhr.responseText);

                                    window.close();
                                } else {
                                    // Handle errors
                                    console.error('Error:', xhr.status, xhr.statusText);
                                }
                            });

                            //event.returnValue = ''; // Standard for most browsers
                        });
                    </script>
                </div>
                <!-- end chat conversation section -->

                <!-- start User profile detail sidebar -->

                <!-- End profile user -->

                <!-- Start user-profile-desc -->
            </div>
            <!-- End User chat -->

            <!-- audiocall Modal -->
            <div class="modal fade" id="audiocallModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center p-4">
                                <div class="avatar-lg mx-auto mb-4">
                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="img-thumbnail rounded-circle">
                                </div>

                                <!-- <h5 class="text-truncate">Doris Brown</h5> -->
                                <p class="text-muted">Start Audio Call</p>

                                <div class="mt-5">
                                    <ul class="list-inline mb-1">
                                        <li class="list-inline-item px-2 me-2 ms-0">
                                            <button type="button" class="btn btn-danger avatar-sm rounded-circle" data-bs-dismiss="modal">
                                                <span class="avatar-title bg-transparent font-size-20">
                                                    <i class="ri-close-fill"></i>
                                                </span>
                                            </button>
                                        </li>
                                        <li class="list-inline-item px-2">
                                            <button type="button" class="btn btn-success avatar-sm rounded-circle">
                                                <span class="avatar-title bg-transparent font-size-20">
                                                    <i class="ri-phone-fill"></i>
                                                </span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- audiocall Modal -->

            <!-- videocall Modal -->
            <div class="modal fade" id="videocallModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center p-4">
                                <div class="avatar-lg mx-auto mb-4">
                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="img-thumbnail rounded-circle">
                                </div>

                                <!-- <h5 class="text-truncate">Doris Brown</h5> -->
                                <p class="text-muted mb-0">Start Video Call</p>

                                <div class="mt-5">
                                    <ul class="list-inline mb-1">
                                        <li class="list-inline-item px-2 me-2 ms-0">
                                            <button type="button" class="btn btn-danger avatar-sm rounded-circle" data-bs-dismiss="modal">
                                                <span class="avatar-title bg-transparent font-size-20">
                                                    <i class="ri-close-fill"></i>
                                                </span>
                                            </button>
                                        </li>
                                        <li class="list-inline-item px-2">
                                            <button type="button" class="btn btn-success avatar-sm rounded-circle">
                                                <span class="avatar-title bg-transparent font-size-20">
                                                    <i class="ri-vidicon-fill"></i>
                                                </span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->
        </div>
        <!-- end  layout wrapper -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Magnific Popup-->
        <script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- owl.carousel js -->
        <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>

        <!-- page init -->
        <script src="assets/js/pages/index.init.js"></script>

        <script src="assets/js/app.js"></script>

</body>

</html>