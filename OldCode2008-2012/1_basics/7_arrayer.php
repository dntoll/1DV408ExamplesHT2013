<html>
  <head>
    <title>Hej Världen</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  </head>
  <body>
<?php
  /** NOTE den här typen av nästlade HTML/PHP filer är ingen bra ide */

  //Skapa en array med hjälp utav "array()"
  $numbers = array(1, 3, 5, 7, 9);
  
  //Kom åt innehållet i en array med hakparanteser
  echo "7 == " . $numbers[3];
  
  //Lägg till ett element sist i arrayen
  $numbers[] = 11;
  
  //Lägg till ett element på ett index i arrayen
  $numbers[24] = 76;
  
  //Lägg till ett element på ett sträng-index i arrayen
  $numbers['age'] = 32;
  
  //eka ut innehållet i arrayen
  //var_dump($numbers);
 
  //Gå igenom en array med foreach
  /*foreach ($numbers as $value) {
    echo "Value $value<br/>";
  }*/
  
  //Gå igenom en array med foreach
  foreach ($numbers as $key => $value) {
    echo "Key '$key' has value '$value'<br/>";
  }
  
 
?>
  </body>
</head>
