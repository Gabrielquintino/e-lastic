 <!DOCTYPE html>
 <html lang="pt-br">

 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>E-lastic Brasil</title>
     <link rel="icon" href="img/logo-icon.png" />
     <link rel="stylesheet" href="css/main.css">

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
                         <a class="nav-item nav-link " href="https://www.elastic.fit/#como-funciona">Como Funciona</a>
                         <a class="nav-item nav-link" href="https://www.elastic.fit/blog/">Blog</a>
                         <a class="nav-item nav-link"
                             href="https://materials.elastic.fit/falar-com-um-consultor?utm_campaign=home-falar_com_consultor_botao_menu&utm_medium=referral&utm_source=site&utm_content=&utm_term=">Assine</a>
                         <a class="nav-item nav-link" href="sair.php" style="color: #e5005b;">
                             Sair
                         </a>
                     </div>
                 </div>
         </nav>
     </section>

     <section>
         <div class="d-flex justify-content-center">
             <div class="card mt-5">
                 <form action="processa_envio.php" method="POST" accept-charset="utf-8">
                     <h1 class="text-center">Seja Bem Vindo!
                         <?php
                          session_start();
                          if(!isset($_SESSION['usuarioNome']))
                          {
                              header("location: index.php");
                              exit;
                          }
                          echo " ". $_SESSION['usuarioNome'];	
                         ?>
                     </h1>
                     <h6 class="text-center">Enviaremos a Situação do Objeto por email!</h6>
                     <div class="form-group mt-3">
                         <label for="exampleInputEmail1">Email:</label>
                         <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                             aria-describedby="emailHelp" placeholder="nome@example.com">
                     </div>
                     <div class="form-group mt-3">
                         <label for="exampleInputPassword1">Código de Rastreio:</label>
                         <input name="codigo" type="text" class="form-control" id="exampleInputPassword1"
                             placeholder="Ex: OA016913717BR" maxlength="13">
                     </div>
                     <button type="submit">Pesquisar</button>
                 </form>
             </div>
         </div>
     </section>

     <!-- SCRIPT JS -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
         integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
     </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
         integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
     </script>
 </body>

 </html>