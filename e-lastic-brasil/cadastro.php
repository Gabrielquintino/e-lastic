<?php
	//Inicializado primeira a sessão para posteriormente recuperar valores das variáveis globais. 
    session_start();
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-lastic Brasil</title>
    <link rel="icon" href="img/logo-icon.png" />
    <link rel="stylesheet" href="css/main.css" />

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
</head>

<body>
    <section>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="https://elastic.fit/">
                    <img src="img/logo-color-small.png" width="150" height="30" alt="logo" />
                </a>
                <div class="" id="navbarNav">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="https://www.elastic.fit/#como-funciona">Como Funciona</a>
                        <a class="nav-item nav-link" href="https://www.elastic.fit/blog/">Blog</a>
                        <a class="nav-item nav-link"
                            href="https://materials.elastic.fit/falar-com-um-consultor?utm_campaign=home-falar_com_consultor_botao_menu&utm_medium=referral&utm_source=site&utm_content=&utm_term=">Assine</a>
                        <a class="nav-item nav-link active" href="index.php">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <section>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card mt-5">
                    <h4 class="text-center mt-5">Cadastre-se em nosso Sistema</h4>
                    <form class="login-signup-form" method="POST" action="realiza_cadastro.php">
                        <!-- nome -->
                        <div class="form-group mt-3">
                            <!-- Label -->
                            <label class="pb-1">Nome </label>
                            <!-- Input group -->
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" placeholder="informe seu nome" name="nome" />
                            </div>
                        </div>
                        <!-- email -->
                        <div class="form-group mt-3">
                            <!-- Label -->
                            <label class="pb-1"> Endereço de email </label>
                            <!-- Input group -->
                            <div class="input-group input-group-merge">
                                <input type="email" class="form-control" placeholder="nome@endereco.com"
                                    name="email_usuario" />
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group mt-2">
                            <!-- Label -->
                            <label class="pb-1"> Senha </label>
                            <!-- Input group -->
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" placeholder="Insira sua senha"
                                    name="senha" />
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit">Cadastrar</button>
                        <a class="mt-3" href="index.php" style="float: right">Voltar</a>
                    </form>

                    <p class="text-center text-danger mt-2">
                        <?php 
                                //Recuperando o valor da variável global, os erro de login.
                                if(isset($_SESSION['cadastro_sucesso'])){
                                    echo $_SESSION['cadastro_sucesso'];
                                    unset($_SESSION['cadastro_sucesso']);
                            }?>
                    </p>
                    <p class="text-center text-danger">
                        <?php 
                                //Recuperando o valor da variável global, deslogado com sucesso.
                                if(isset($_SESSION['cadastro_erro'])){
                                    echo $_SESSION['cadastro_erro'];
                                    unset($_SESSION['cadastro_erro']);
                            }?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--scroll bottom to top button start-->
    <div class="scroll-top scroll-to-target primary-bg text-white" data-target="html">
        <span class="fas fa-hand-point-up"></span>
    </div>
    <!--scroll bottom to top button end-->
    <!--build:js-->
    <!-- SCRIPT JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
    <!--endbuild-->
</body>

</html>