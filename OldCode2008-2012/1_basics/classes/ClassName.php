<?php

require_once("IAmAnInterface.php"); //relative path
require_once("BaseClass.php"); //relative path

/**
 * A subclass of BaseClassName which implements the interface IAmAnInterface
 */
class ClassName extends BaseClass implements IAmAnInterface {
  
  //Private member variable initated before constructor
  private $m_memberVariable = "initiated to a string";
  
  //public members can be declarated in two ways I prefer to use the public keyword
  public $m_publicMemberVariable1 = 1;
  var    $m_publicMemberVariable2; //not initialized
  
  /**
   * The class constructor
   * 
   * Note we can only have one constructor
   */
  public function __construct() {
    //parent constructor must be called explicitly but member variables are initated if declared so...
    parent::__construct();
    echo "ClassName constructor called $this->m_protectedMember <br/>";
    
    //using a member variable
    $this->m_memberVariable = 'Member variables must be called on using "$this->"';
    
    //How not to do it!
    $m_memberVariable = "<- this is a new local variable ";
  }
  
  /**
   * A function from the BaseClassName class
   * Takes a parameter of OtherClass in the namespace \Examples\SubExamples\
   */
  public function FunctionName(\Examples\SubExamples\OtherClass $parameter) {
    echo "FunctionName called " . $parameter->GetPi() . "<br/>";
  }
  
  /**
   * Overriden function where the parent class has an implementation of the function...
   */
  public function OtherFunction() {
    //call the parents version of this function
    parent::OtherFunction();
  }
  
  /**
   * Implementation of the IAmAnInterface interface
   */
  public function DoThis() {
    
  }
  
  public function someFunc() {
  	
  }
  
  /*public function someFunc($param) {
  	
  }*/
}