<?php


require_once("./Views/SelectColorViewBase.php");
/**
 * Basic view class 
 * 
 * Two responsabilities:
 *  Generate output
 *  Collect input
 */
class SelectColorView extends SelectColorViewBase {
  //Key to make sure no mixup between classes 
  private $m_getKey = "SelectColorViewColor";
  
  /**
  * Collect input
  */
  public function GetUserselectedColor() {
    //Has input been given?
    if (isset( $_GET[$this->m_getKey]) == true) {
      //return the input
      return $_GET[$this->m_getKey];
    } 
    return FALSE;
  }
  
  /**
   * Generate output
   */
  public function DoSelectionMenu() {
    $ret = "<div>
              <h2>Select a color</h2>
              <span>
                <a href=\"?$this->m_getKey=" . SelectColorViewBase::RED . "\">Red</a>
                <a href=\"?$this->m_getKey=" . SelectColorViewBase::GREEN . "\">Green</a>
              </span>
            </div><br/>\n";
    
    return $ret;
  }

}
