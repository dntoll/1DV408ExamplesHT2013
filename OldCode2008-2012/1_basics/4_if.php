<?php
 
  //skapar en ny variabel och tilldelar den värdet av en sträng
  $age = 9; 
 
  if ($age >= 18) { 			//jämförelseoperator större eller lika med...
    $body = "Du är $age år...";
  } else if ($age < 7 ){ 		//som vi är vana vid...
    $body = "Din ålder är $age. Välkommen i vuxet sällskap";
  } elseif ($age < 15 ){ 		//elseif sammanskrivet går också bra
   // $body = "Din ålder är $age. ";
  } else {
    $body = "Din ålder är $age. Kom tillbaka när du är 18 år eller äldre";
  }
 
 
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
