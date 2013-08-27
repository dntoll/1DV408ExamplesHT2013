<?php
 
  //skapar en ny variabel och tilldelar den värdet av en sträng
  $name = "Daniel";
 
  //Skapar en ny variabel och tilldelar den ett nummer
  $age = 33;
 
  //Använder variabler för att skapa en sträng "." används för att sammanfoga strängar
  $body = $name . " är " . $age . " år.";
 
  //create new object and connect to a variable
  $exception = new Exception("Something is wrong");
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
	
	
	echo "<h2> and now for something completely different...(exceptions)</h2>";
  	throw $exception;
  ?>
  </body>
</head>
