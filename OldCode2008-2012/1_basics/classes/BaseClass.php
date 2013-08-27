<?php

/**
 * BaseClass
 * Abstract class demonstrates member variables abstract functions and non-static member functions
 */
abstract class BaseClass {
  //protected member variables can only be used inside this class 
  //or by a subclass and must be accessed using $this->m_protectedMember
  protected $m_protectedMember = 1;
  
  /**
   * Class constructor
   * note that there can be only one constructor per class
   */
  public function __construct() {
     echo "BaseClass constructor called<br/>";
     $this->m_protectedMember = 2;
  }
  
  /**
   * Abstract functions have no body and class must be inherited...
   * Note that the parameter has a typename "OtherClass"
   * Type safety can be used this way but only with class-names and not with basic types like string
   */
  public abstract function FunctionName(OtherClass $parameter);
  
  /**
   * Another function to use inside the subclass below....
   */
  public function OtherFunction() {
    echo "In BaseClass::OtherFunction<br/>";
  }
}