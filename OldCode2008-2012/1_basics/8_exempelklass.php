<?php

//The classes used are in other files
require_once("classes/ClassName.php"); //relative path
require_once("classes/OtherClass.php"); //relative path


//Create an instance of the class "ClassName"
$instance  = new ClassName();

//Create another instance of OtherClass from the \Examples\SubExamples\ namespace
$anotherInstance = new \Examples\SubExamples\OtherClass();

//Call on a member function and provide a parameter
$instance->FunctionName($anotherInstance);

//Call on a static function
echo "\Examples\SubExamples\OtherClass::GetPi()" . \Examples\SubExamples\OtherClass::GetPi();
echo "</br>";
//using a const
echo "\Examples\SubExamples\OtherClass::PI" . \Examples\SubExamples\OtherClass::PI;

//using public variables directly
echo "</br>Member 1 [" .$instance->m_publicMemberVariable1 . "]";
echo "</br>Member 2 [" .$instance->m_publicMemberVariable2 . "]";

