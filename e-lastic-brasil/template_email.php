<?php
error_reporting(0);
?>
<?php

session_start();

$obj = $_SESSION['obj'];

$url = "http://localhost/e-lastic/correios-rastreio/api/obj.php?obj={$obj}";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$rastreio = json_decode(curl_exec($ch), true);

//header("Location: processa_envio1.php");



if (isset(($rastreio[0]['action']))) {
    $titulo = ($rastreio[0]['action']);
}else {
    $titulo = ($rastreio['msg']);
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body style="
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica,
        'Apple Color Emoji', Arial, sans-serif, 'Segoe UI Emoji',
        'Segoe UI Symbol';
    ">
    <a class="navbar-brand" href="https://elastic.fit/">
        <img src="http://e-lastic.scprojetista.com/logo-color-small.png" width="150" height="30" alt="logo" />
    </a>
    <hr />
    <br />
    <h3 style="color: #0c80a3">
        <img src="http://e-lastic.scprojetista.com/icone.jpg" width="20" height="20" alt="ícone" />
        <?echo $titulo;?>
    </h3>

    <? if ($rastreio[0]['action'] === "Objeto entregue ao destinatário") {?>
    <img src="http://e-lastic.scprojetista.com/entregue.jpg" width="400" height="40" alt="" />
    <?}
        elseif($rastreio[0]['action'] === "Objeto em trânsito - por favor aguarde"){?>
    <img src="http://e-lastic.scprojetista.com/encaminhando.png" width="400" height="40" alt="logo" />
    <?}else {?>
    <img src="http://e-lastic.scprojetista.com/horario_limite.jpg" width="400" height="40" alt="logo" />
    <?}?>
    <p>
        Você pode acompanhar o envio com o códio de rastreamento
        <a href="https://www2.correios.com.br/sistemas/rastreamento/default.cfm">
            <?
           print $obj;
       ?>
        </a>
        <br />
    </p>

    <?try {
       foreach($rastreio as $key=>
    $obj){ ?>
    <hr />
    <table>
        <tr>
            <td>
                <? 
                if ($obj['date'] !== 'O') {
                    echo 
                    $obj['date']."<br />". $obj['hour']."<br />".
          $obj['location']; } ?>
            </td>
            <td>
                <?
                if ($obj['date'] !== 'O') {
                 echo
                 $obj['message'];
                 } ?>
            </td>
        </tr>
    </table>
    <?}}
   
   catch (Exception $e) {
       $obj['erro'] = true;
       header('Location: area_protegida.php');
   }?>

    <h4 style="line-height: 0px">Dados do Envio</h4>
    <b>Gabriel Victor da Silva Quintino</b><br />
    Telefone: <a href="tel:+55 61 991191190">(61) 991191190</a><br />
    Passagem do Maciambu,<br />
    Palhoça/SC<br /><br />

    <p style="font-weight: bold; font-size: 10px">Falta Pouco!</p>
    <p style="font-weight: bold; font-size: 10px">Equipe da E-lastic Brasil</p>
    <hr />
    <p style="font-size: 8px">Não responda este email.</p>
</body>

</html>