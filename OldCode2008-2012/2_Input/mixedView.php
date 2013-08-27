<?php

//Här använder jag mig av ett annat sätt att hantera vyer, 
//kan dock inte rekomendera det. 

class FormView {
  //En konstant för att undvika felskrivningar!
  const TextFieldName = "FormViewTextField";
  
  //Hämta ut indata
  public function GetTextField() {
    if (isset($_GET[FormView::TextFieldName])) {
      return $_GET[FormView::TextFieldName];
    } else {
      return "not set";
    }
  }
  
  //Skapa utdata som ekas direkt ut
  public function CreateForm() {
    ?>
    <form method="get" action="?controller=FrontPage">
      <input type="text" name="<?php echo FormView::TextFieldName; ?>" value="<?php echo $this->GetTextField(); ?>"></input>
      <input type="submit" name="Submit" value="button1"></input>
      <input type="submit" name="Submit" value="button2"></input>
    </form>
    <p>
      <?php
        echo "<h2>\$_GET</h2>";
        var_dump($_GET); 
      ?>
    </p>
    <?php
  }
}



/**
 * Här blir jag mer eller mindre tvungen att skapa en ny "pageview" eftersom jag använder mig av mixad stil av PHP och XHTML 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head> 
     <title>Input example</title> 
     <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
     
  </head> 
  <body>
    <h2>Input Example</h2>
    <p>
      Detta sätt att eka ut data till användaren är rätt vanligt(i php applikationer) men jag använder det inte speciellt mycket.
      Trevligt dock att få <strong>färgkodning</strong> när man skriver (X)HTML.  
      En fördel med sättet är att kunna skapa php-vyer där en grafiker inte behöver veta speciellt mycket om PHP för att skapa utseende.
    </p>
    <p>
      
      Jag skriver istället HTML som strängar med formatering. Detta gör jag för att:
      <ul>
        <li>Styra vart jag vill få utskriften, ibland kanske slänga den</li>
        <li>Tydligare avgränsning mellan kod och text</li>
        <li>Lättare att återanvända kod</li>
        <li>Lättare att testa automatiskt</li>
        <li>Kunna anropa vyer i en viss ordning och få utskriften av dem i annan ordning</li>
        <li>Undvika att tecken läcker utanför DOM-dokumentet och på så sätt förstör sessionshantering, validering mm..</li>
      </ul>
    </p>
<?php
    $fv = new FormView();
    $fv->CreateForm();
?>

  </body>
</html>
