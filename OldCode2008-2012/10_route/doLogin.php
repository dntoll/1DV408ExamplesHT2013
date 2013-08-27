<?php

	session_start();

  if (isset($_GET["username"])) {
  		$_SESSION["welcome"] = true;
  		//header("Location: other.php");
  		
  		echo "<a href'other.php'>other</a>";
  } else {
  	echo "not logged in!";
  }