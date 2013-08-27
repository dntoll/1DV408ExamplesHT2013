<?php 

//PHP kan nästlas med HTML med hjälp utav PHPs start och sluttagg
//Mellan taggarna är det "PHP-Space" och allt utanför skickas("ekas" ut) till klienten

?>

<html>
	<head>
		<title>Hej Världen</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<?php
		  	//echo skriver ut "Hej Världen" till klienten på denna plats i HTML dokumentet 
			echo "Hej Världen";
		?>
	</body>
</html>
