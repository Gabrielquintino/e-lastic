<?php

session_start();

//RECEBE OS DADOS DO FORMULÁRIO AREA_PROTEGIDA.PHP
$email = $_POST['email'];
$obj = $_POST['codigo'];

//ENVIA O OBJETO PARA TEMPLATE_EMAIL.PHP
$_SESSION['obj'] = $obj;

//PASSA O CÓDIGO INFORMADO VIA POST PARA A URL
$url = "http://localhost/e-lastic/correios-rastreio/api/obj.php?obj={$obj}";


//INICIA A BUSCA 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//RETORNA OS DADOS EM UM ARRAY CONDICIONAL
$rastreio = json_decode(curl_exec($ch), true);

//VALIDAÇÃO DO TÍTULO
if (isset(($rastreio[0]['action']))) {
    $titulo = ($rastreio[0]['action']);
}else {
    $titulo = ($rastreio['msg']);
}

//REQUISIÇÃO DAS BIBLIOTECAS PHPMAILER
require "./biblioteca/PHPmailer/Exception.php";
require "./biblioteca/PHPmailer/OAuth.php";
require "./biblioteca/PHPmailer/PHPMailer.php";
require "./biblioteca/PHPmailer/POP3.php";
require "./biblioteca/PHPmailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//RETORNA O STATUS DO ENVIO DO EMAIL

$status = array('codigo_status' => null, 'descricao_status' => '');

function __get($atributo) {
return $this->$atributo;
}
function __set($atributo, $valor) {
$this->$atributo = $valor;
}

//CARREGA O CONTEUDO PDF

use Dompdf\ Dompdf;
    
require "dompdf/autoload.inc.php"; //incluindo class auto load

$dompdf = new Dompdf(["enable_remote" => true]);

ob_start();
$dompdf->loadHtml(file_get_contents('template_email.php'));

require __DIR__ . "/template_email.php";
$dompdf->loadHtml(ob_get_clean());


$dompdf->setPaper("A4", "orientation");

$dompdf->render();

$output = $dompdf->output("email.pdf", ["Attachment" => false]);
$file_to_save = $_SERVER['C:/xampp/htdocs/e-lastic/e-lastic-brasil/'].'email.pdf';
file_put_contents($file_to_save, $output);


//INSTÂNCIA DA CLASSE PHPMAILER
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = false;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'contato.gabrielquintino@gmail.com';                     // SMTP username
    $mail->Password   = 'naoseiasenha';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->CharSet = 'UTF-8';
    
    //Recipients
    $mail->setFrom('contato.gabrielquintino@gmail.com', 'E-lastic Brasil');
    $mail->addAddress($email);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment ('email.pdf');         // Add attachments
    //$mail->addAttachment('email.pdf', 'email.pdf');    // Optional name
    //$mail->AddStringAttachment(, $filename, $encoding = 'base64', $type = 'application/octet-stream');
    
  


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = ($titulo);
    $mail->Body    = 
    
    '<a class="navbar-brand" href="https://elastic.fit/">
        <img src="http://e-lastic.scprojetista.com/logo-color-small.png" width="150" height="30" alt="logo" />
    </a><hr /><br />'.'
    <h3 style="color: #0c80a3">
        <img src="http://e-lastic.scprojetista.com/icone.jpg" width="20" height="20" alt="ícone" />'.    
        $titulo.'
    </h3>'.'
    <p>Você pode acompanhar o envio com o códio de rastreamento
        <a href="https://www2.correios.com.br/sistemas/rastreamento/default.cfm">'.
        $_SESSION['obj'].
        '</a><br />
    </p>';
    if ($rastreio[0]['action'] === "Objeto entregue ao destinatário") {
        $mail->Body   .= 
            '<img src="http://e-lastic.scprojetista.com/entregue.jpg" width="400" height="40" alt="">';
        }
    elseif($rastreio[0]['action'] === "Objeto em trânsito - por favor aguarde"){
        $mail->Body   .= 
            '<img src="http://e-lastic.scprojetista.com/encaminhando.png" width="400" height="40" alt="logo" />';
        }
    else {
        $mail->Body   .= '<img src="http://e-lastic.scprojetista.com/horario_limite.jpg" width="400" height="40" alt="logo" />';
        }

    foreach($rastreio as $key=> $obj){
    
    $mail->Body   .= 

    '<hr />
    <table>
        <tr>
            <td>';
            if ($obj['date'] !== 'O') {
                $mail->Body   .= 
                $obj['date']."<br />". $obj['hour']."<br />". $obj['location'];
            }
            $mail->Body   .= 
            '</td>
             <td>';
             if ($obj['date'] !== 'O') {
                $mail->Body   .= 
                $obj['message'];
             }
             $mail->Body   .= 
            '</td>
        </tr>
    </table>';
}
    
    $mail->Body    .= 

    '<h4 style="line-height: 0px">Dados do Envio</h4>
    <b>Gabriel Victor da Silva Quintino</b><br />
    Telefone: <a href="tel:+55 61 991191190">(61) 991191190</a><br />
    Passagem do Maciambu,<br />
    Palhoça/SC<br /><br />
    <p style="font-weight: bold; font-size: 10px">Falta Pouco!</p>
    <p style="font-weight: bold; font-size: 10px">Equipe da E-lastic Brasil</p>
    <hr />
    <p style="font-size: 8px">Não responda este email.</p>';


    $mail->AltBody = 'Necessário usar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem';

    $mail->send();

    $status['codigo_status'] = 1;
    $status['descricao_status'] = 'Email enviado com sucesso!';

} catch (Exception $e) {
    $status['codigo_status'] = 2;
    $status['descricao_status'] = 'Não foi possível enviar esse email! Detalhes do erro: ' . $mail->ErrorInfo;
    }
?>

<!-- RETORNO DA MENSAGEM DE STATUS -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/mdb.min.css">
</head>

<body>


    <div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria- labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">

                            <? if ($status['codigo_status'] == 1) { ?>

                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <h1 class="display-4 text-success">
                                            Sucesso
                                        </h1>
                                    </div>
                                    <div class="col-6">

                                    </div>
                                </div>

                                <p>
                                    <?= $status['descricao_status'] ?>
                                </p>


                                <a href="area_protegida.php" class="btn btn-success btn-lg mt-5 text-white">Voltar
                                </a>

                            </div>

                            <? } ?>

                            <? if ($status['codigo_status'] == 2) { ?>

                            <div class="container">
                                <h1 class="display-4 text-danger">
                                    Ops!
                                </h1>
                                <p>
                                    <?= $status['descricao_status'] ?>
                                </p>

                                <div class="modal-footer">
                                    <a href="area_protegida.php" class="btn btn-danger btn-lg mt-5 text-white">Voltar
                                    </a>
                                </div>

                            </div>
                            <? } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- END MODAL -->

    <!-- end pedir meu chip -->
    <!-- SCRIPT JS -->
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/all.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#exemplomodal').modal('show');
    })
    </script>
</body>

</html>