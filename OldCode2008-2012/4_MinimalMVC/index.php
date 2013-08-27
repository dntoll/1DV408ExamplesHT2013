<?php
  require_once("Controller.php");
  require_once("Model.php");
  require_once("View.php");
  
  //create instances
  $model = new Model();
  $view = new View();
  $controller = new Controller();
	
  //call the controller
  $xhtml = $controller->DoControll($model, $view);
  
  //echo the result
  echo $xhtml;
