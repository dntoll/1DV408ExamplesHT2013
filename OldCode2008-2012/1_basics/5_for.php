<?php
 
  $body = "start<br/>";
  
  //For fungerar som i andra språk
  for ($i = 0; $i < 5; $i++) {
    // med .= bygger man på strängen på samma sätt som $body = $body . " "
    // Använder man en variabel i en dubbelfnuttad " sträng $i " så skrivs innehållet ut.
    // För att skriva ut dollartecknet och " "eskapar" vi med "\"
    $body .= "With \" \$i = $i in for-loop 'generating something' <br/>   ";
    //Märk skillnaden med enkla fnuttar
    $body .= 'With \' \$i = $i in for-loop "generating something" <br/>   ';
  }
  $body .= "end";
 
 
?>
<html>
  <head>
    <title>Hej Världen</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  </head>
  <body>
  <?php
    //Skriver ut innehållet i $body till dokumentet.
    echo $body;
  ?>
  </body>
</head>
