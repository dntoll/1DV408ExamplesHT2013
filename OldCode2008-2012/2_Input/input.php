<?php

require_once("./Views/Page.php");
require_once("./Views/PageView.php");
require_once("./Controllers/InputExampleController.php");
require_once("./Controllers/FormInputController.php");
require_once("./Controllers/ColorInputController.php");


//PART 1. Call a controller and collect the page
//Call on the controller(s)
$inputExampleController = new InputExampleController();
$page = $inputExampleController->DoControll();

//PART 2. Show form input controller and "merge" of two controller output
/*$inputExampleController = new InputExampleController();
$pagePart1 = $inputExampleController->DoControll();

$formInputController = new FormInputController();
$pagePart2 = $formInputController->DoControll();
$page = $pagePart1->Merge($pagePart2);
*/


//PART 3.  Configure a controller by adding a view 
//$colorView = new FormColorView();
/*$colorView = new SelectColorView();
$inputController = new ColorInputController($colorView);
$page = $inputController->DoControll();
*/

//Generate XHTML
$view = new PageView("UTF-8");
$view->AddStyleSheet("style.css");
echo $view->GetXHTML10StrictPage($page->m_title, $page->m_body);

//var_dump($_GET);
