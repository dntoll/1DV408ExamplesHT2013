<?php
session_start();

if (isset($_SESSION["welcome"])) {
	echo "Välkommen...";
	unset($_SESSION["welcome"]);
}

echo "yay other!";
