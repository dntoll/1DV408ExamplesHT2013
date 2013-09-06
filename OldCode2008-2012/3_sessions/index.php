<?php

require_once("PageView.php");
require_once("ReloadCounter.php");

//Startar sessionen eftersom klassen ReloadCounter behöver sessionen för att lagra saker i.
session_start();

//Skapar en instans(objekt) av klassen ReloadCounter
$counter = ReloadCounter::getInstance();

//Anropar en metod på klassen och tar emot resultatet i $reloads
$reloads = $counter->GetReloadCount();


//Skapar en instans av klassen PageView och skickar med ett argument till klassens konstruktor
$view = new PageView("UTF-8");

//Anropar en metod på klassen och skickar med ett argument
$cssFile = "style.css";
$view->AddStyleSheet($cssFile);



//Lägg märke till hur jag använder variabeln direkt i strängen (men bara i dubbelfnuttad ("") sträng)
$body = "<p>The page has been reloaded $reloads times, in this session</p>";
$title = "An example title";

//Anropar en metod på PageView objektet
//$pageHTML = $view->GetHTMLPage($title, $body);
$pageHTML = $view->GetXHTML10StrictPage($title, $body);

//skriver ut resultatet till klienten
echo $pageHTML;
