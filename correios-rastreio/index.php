<?php 


 $email = "gabrielv.quintino@gmail.com";
 $obj = "OA016913717BR";

 $url = "http://localhost/e-lastic/correios-rastreio/api/obj.php?obj={$obj}";

 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
 $rastreio = json_decode(curl_exec($ch), true);


 echo "<pre>";
 var_dump($rastreio);

?>