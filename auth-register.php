<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive Bootstrap 5 Chat App" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/faviconchat.png">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap2.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <!-- SweetAlert -->
    <script src="assets/fonts/sweetalert2.all.min.js"></script>
</head>

<body>


    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4">

                        <h4>Cadastro</h4>
                        <p class="text-muted mb-4">Crie sua conta.</p>

                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-3">
                                <!-- <form action="requires/cadastroUser.php" method="post"> -->
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Nome</label>
                                        <div class="input-group bg-light-subtle mb-3 rounded-3">
                                            <span class="input-group-text border-light text-muted" id="basic-addon6">
                                                <i class="ri-user-2-line"></i>
                                            </span>
                                            <input type="text" id="nome-cadastro" name="nome" class="form-control form-control-lg bg-light-subtle border-light" placeholder="Inserir Nome" aria-label="Enter Username" aria-describedby="basic-addon6">

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="input-group bg-light-subtle rounded-3  mb-3">
                                            <span class="input-group-text text-muted" id="basic-addon5">
                                                <i class="ri-mail-line"></i>
                                            </span>
                                            <input type="email" id="email-cadastro" name="email" class="form-control form-control-lg bg-light-subtle border-light" placeholder="Email" aria-label="Enter Email" aria-describedby="basic-addon5">

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Usuário</label>
                                        <div class="input-group bg-light-subtle mb-3 rounded-3">
                                            <span class="input-group-text border-light text-muted" id="basic-addon6">
                                                <i class="ri-user-2-line"></i>
                                            </span>
                                            <input type="text" id="usuario-cadastro" name="nm_login" class="form-control form-control-lg bg-light-subtle border-light" placeholder="Inserir Usuário" aria-label="Enter Username" aria-describedby="basic-addon6">

                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Senha</label>
                                        <div class="input-group bg-light-subtle mb-3 rounded-3">
                                            <span class="input-group-text border-light text-muted" id="basic-addon7">
                                                <i class="ri-lock-2-line"></i>
                                            </span>
                                            <input type="password" id="senha-cadastro" name="nm_senha" class="form-control form-control-lg bg-light-subtle border-light" placeholder="*******" aria-label="Enter Password" aria-describedby="basic-addon7">

                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Seu Token</label>
                                        <div class="input-group bg-light-subtle mb-3 rounded-3">
                                            <span class="input-group-text border-light text-muted" id="basic-addon7">
                                                <i class="ri-lock-2-line"></i>
                                            </span>
                                            <input type="text" id="device-token" name="device_token" class="form-control form-control-lg bg-light-subtle border-light" placeholder="Inserir Token" aria-label="Enter Token" aria-describedby="basic-addon7">

                                        </div>
                                    </div>


                                    <div class="d-grid">
                                        <!-- <input type="hidden" name="acao" value="cadastrar" /> -->
                                        <!-- <input type="submit" class="btn btn-primary" value="Cadastrar Usuário" /> -->
                                        <!-- <button class="btn btn-primary waves-effect waves-light" type="submit">Confirmar</button> -->
                                        <button class="btn btn-primary waves-effect waves-light" type="button" onclick="cadastrar()">Confirmar</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="text-muted mb-0">Ao criar conta você concorda com os <a href="#" class="text-primary">Termos</a></p>
                                    </div>

                                    <script>
                                        function cadastrar() {
                                            var nome = document.getElementById('nome-cadastro').value;
                                            var email = document.getElementById('email-cadastro').value;
                                            var user = document.getElementById('usuario-cadastro').value;
                                            var senha = document.getElementById('senha-cadastro').value;
                                            var deviceToken = document.getElementById('device-token').value;



                                            document.getElementById('nome-cadastro').value = '';
                                            document.getElementById('senha-cadastro').value = '';
                                            document.getElementById('usuario-cadastro').value = '';
                                            document.getElementById('email-cadastro').value = '';
                                            document.getElementById('device-token').value = '';


                                            console.log(`${nome}`);

                                            var xhttp = new XMLHttpRequest();
                                            xhttp.onreadystatechange = function() {
                                                if (this.readyState == 4 && this.status == 200) {
                                                    var resposta = this.responseText;
                                                    console.log(`oi ${resposta}`);
                                                    if (resposta == "usuario ja existe") {
                                                        Swal.fire({
                                                            text: `Usuário indisponivel`,
                                                            icon: "error"
                                                        });
                                                        document.getElementById('nome-cadastro').value = `${nome}`;
                                                        document.getElementById('email-cadastro').value = `${email}`;
                                                        document.getElementById('device-token').value = `${deviceToken}`;
                                                    } else if (resposta == "campo vazio") {
                                                        Swal.fire({
                                                            text: `Campos incompletos`,
                                                            icon: "error"
                                                        });
                                                        document.getElementById('nome-cadastro').value = `${nome}`;
                                                        document.getElementById('email-cadastro').value = `${email}`;
                                                        document.getElementById('usuario-cadastro').value = `${user}`;
                                                        document.getElementById('device-token').value = `${deviceToken}`;
                                                    } else if (resposta == "Record inserted successfully") {
                                                        console.log(`oi ${resposta}`);
                                                        Swal.fire({
                                                            text: `Concluido`,
                                                            icon: "success"
                                                        });
                                                    }
                                                }
                                            };
                                            xhttp.open("POST", "requires/cadastroUser.php", true);
                                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                            xhttp.send("nome=" + encodeURIComponent(nome) + "&email=" + encodeURIComponent(email) + "&nm_login=" + encodeURIComponent(user) + "&nm_senha=" + encodeURIComponent(senha) + "&device_token=" + encodeURIComponent(deviceToken));
                                        };
                                    </script>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>Já possui uma conta ? <a href="auth-login.php" class="fw-medium text-primary"> Acessar </a> </p>
                        <p>© <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end account-pages -->



    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>