<?php
    session_start();
	include_once("conexao.php");
	$nome  = $_POST['nome'];
    $email = $_POST['email_usuario'];
    $senha = md5($_POST['senha']);
	//echo "$nome_usuario - $email_usuario";
	
	$result_usuario = "INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `situacoe_id`, `niveis_acesso_id`, `created`, `modified`) 
    VALUES (NULL, '$nome', '$email', '$senha', '1', '1', '', NULL)";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	
	if(mysqli_affected_rows($conn) != 0){
	
                $_SESSION['cadastro_sucesso'] = "Cadastro Realizado com Sucesso";
                header("Location: cadastro.php");
			
			}else{
                $_SESSION['cadastro_erro'] = "Falha ao realizar cadastro, Preencha as informações corretamente";
                header("Location: cadastro.php");
			}
?>