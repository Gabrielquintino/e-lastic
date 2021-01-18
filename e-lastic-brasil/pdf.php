<?php
    use Dompdf\ Dompdf;
    
    require "dompdf/autoload.inc.php"; //incluindo class auto load
    
    $dompdf = new Dompdf(["enable_remote" => true]);

    ob_start();
    $dompdf->loadHtml(file_get_contents('template_email.php'));

    require __DIR__ . "/template_email.php";
    $dompdf->loadHtml(ob_get_clean());
  

    $dompdf->setPaper("A4", "orientation");

    $dompdf->render();

    $dompdf->stream("email.pdf", ["Attachment" => false]);

// echo "<pre>";
// var_dump($dompdf);

?>