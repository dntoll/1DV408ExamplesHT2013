<?php


namespace Examples\SubExamples;

/**
 * OtherClass demonstrates static and const
 */
class OtherClass {
  //A static field hangs on the "class object" OtherClass::$g_pi, 
  //this one is private so it can only be used inside this class
  private static $g_pi = 3.14;
  
  //A class constant OtherClass::PI used for everything that does not change
  //This is public
  const PI = 3.1415;

  
  //Static function called by using class name OtherClass::GetPi();
  public static function GetPi() {
    return OtherClass::$g_pi;
  }
}