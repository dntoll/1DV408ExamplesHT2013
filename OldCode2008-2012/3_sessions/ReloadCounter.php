<?php

/**
 * Counts how many times the page has been reloaded
 * Saves a file on disk and uses session
 * 
 * This class is a singleton
 * http://en.wikipedia.org/wiki/Singleton_pattern
 */
class ReloadCounter {
  /**
   * Make sure no one else uses this adress 
   * @var string
   */
  private static $sessionAdress = "ReloadCounter::Reloads";
  
  /**
   * SingleTon Instance
   * @var ReloadCounter $instance
   */
  private static $instance = null;

  /**
   * getInstance returns the only instance 
   * getInstance creates the instance if it does not exists
   * @return ReloadCounter
   */
  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new ReloadCounter();
    }
    return self::$instance;
  }

  /**
  * @return int how many times the page is reloaded     
  **/
  public function getReloadCount() {
    return $_SESSION[self::$sessionAdress];
  }
  
  /** 
   * is private so we can make sure it is only called once per call
   */
  private function __construct() {
    
    //Check if session is started
    assert(isset($_SESSION));
    

    if (isset($_SESSION[self::$sessionAdress])) {
      //increase reloads
      $_SESSION[self::$sessionAdress]++;
    } else {
      //allocate memory
      $_SESSION[self::$sessionAdress] = 1;
    }
  }
}

