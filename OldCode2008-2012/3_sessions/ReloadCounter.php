<?php

/**
 * Counts how many times the page has been reloaded
 * Saves a file on disk and uses session
 */
class ReloadCounter {

  //Checks so the counter is updated only once per call
  private static $g_hasBeenConstructedBeforeThisCall = false;
  
  //makes sure we dont missspell the session adress
  const SESSION_ADRESS = "ReloadCounter::ReloadCounter";
  
  
  /** Constructor
   * called when an instance of ReloadCounter is created
   * $rc = new ReloadCounter();     
   *
   */
  public function __construct() {
    
    //Check if session is started
    if (isset($_SESSION) == false) {
      //throw exception so the class cannot vbe instantiated before session_start is called.
      throw new Exception("Session IS NOT started, ReloadCounter uses session, please call session_start() before any calls to ReloadCounter");
    } 
    
    //Make sure the count is updated only once per HTTP request
    if (ReloadCounter::$g_hasBeenConstructedBeforeThisCall == false) {
      
      //if this is the first call set the counter to 1 else set it to (n + 1)
      // isset checks if the adress exists in the session array
      if (isset($_SESSION[ReloadCounter::SESSION_ADRESS]) == false) {
        $_SESSION[ReloadCounter::SESSION_ADRESS] = 1;
      } else {
        $_SESSION[ReloadCounter::SESSION_ADRESS]++;
      }
      ReloadCounter::$g_hasBeenConstructedBeforeThisCall = true;
    }
    
  }
  /**
  * @return int how many times the page is reloaded     
  **/
  public function GetReloadCount() {
    return $_SESSION[ReloadCounter::SESSION_ADRESS];
  }
}



//Note NO end php tag
