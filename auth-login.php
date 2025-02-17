<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Acessar</title>
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


</head>

<body>


    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4">
                        <h4>Acessar</h4>
                        <p class="text-muted mb-4">Faça seu login para prosseguir.</p>

                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-3">
                                <form action="requires/validate-login.php" method="post">

                                    <div class="mb-3">
                                        <label class="form-label">Usuário</label>
                                        <div class="input-group mb-3 bg-light-subtle rounded-3">
                                            <span class="input-group-text text-muted" id="basic-addon3">
                                                <i class="ri-user-2-line"></i>
                                            </span>
                                            <input type="text" name="emaillogin" class="form-control form-control-lg border-light bg-light-subtle" placeholder="Inserir Usuário" aria-label="Enter Username" aria-describedby="basic-addon3">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <!-- <div class="float-end">
                                            <a href="auth-recoverpw.php" class="text-muted font-size-13">Esqueceu a senha?</a>
                                        </div> -->
                                        <label class="form-label">Senha</label>
                                        <div class="input-group mb-3 bg-light-subtle rounded-3">
                                            <span class="input-group-text text-muted" id="basic-addon4">
                                                <i class="ri-lock-2-line"></i>
                                            </span>
                                            <input type="password" name="passlogin" class="form-control form-control-lg border-light bg-light-subtle" placeholder="********" aria-label="Enter Password" aria-describedby="basic-addon4">

                                        </div>
                                    </div>

                                    <!-- Esse btn agr por algum motivo não está chegando até $btnLogin -->
                                    <!-- <div class="mb-3 row mt-4">
                                        <input type="hidden" name="btnLogin" value="Acessar">
                                        <div>
                                            <div class="col-6 text-end ">
                                                <button class="btn btn-primary w-md waves-effect waves-light">Acessar</button>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>Não possui uma conta ? <a href="auth-register.php" class="fw-medium text-primary"> Cadastre-se </a> </p>
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