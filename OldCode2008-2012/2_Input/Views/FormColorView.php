<?php

require_once("./Views/SelectColorViewBase.php");

/**
 * FormColorView
 * 
 * Another example view that generates the same kind of output as SelectColorView 
 *  Collects input for the controller (GetUserselectedColor() method)
 *  Generates HTML output (DoSelectionMenu() method)
 */
class FormColorView extends SelectColorViewBase {

  /** 
   * String form radio button color
   *  used in GetUserselectedColor() and in DoSelectionMenu()
   *  so in order to avoid string dependecies it is stored here.
   *  And private so it cannot be accessed from outside this class           
   */
  private $m_getKey = "FormColorViewColor";
  
  /**
   *  Get method for the selected color
   */ 
  public function GetUserselectedColor() {
  
    //First check with isset if the variable index exists in the array at $this->m_getKey
    if (isset( $_POST[$this->m_getKey]) == true) {
      //return the variable
      return $_POST[$this->m_getKey];
    }
    
    return FALSE;
  }
  
  /** 
   *  Generate HTML   
   *  @RETURN HTML string
   */  
  public function DoSelectionMenu() {
    //Two empty strings
    $redChecked = "";
    $greenChecked = "";
    
    //check input and create HTML depending on it
    $previouslyChecked = $this->GetUserselectedColor();
    if ($previouslyChecked == SelectColorViewBase::RED) {
      $redChecked = "checked='checked'";
    } else if ($previouslyChecked == SelectColorViewBase::GREEN) {
      $greenChecked = "checked='checked'";
    }
  
    //Create the return HTML string
    //note that we might add information to the url even if we post
    $ret = "
        <br/>
    		<div>
              <h2>Select a color</h2>
              <form method='post' action=\"?controller=test\"> 
                <input type='radio' name='$this->m_getKey' value='" . SelectColorViewBase::RED . "' $redChecked>Red</input>
                <input type='radio' name='$this->m_getKey' value='" . SelectColorViewBase::GREEN . "' $greenChecked>Green</input>
                <input type='submit'/>
              </form>
            </div>\n";
    
    return $ret;
  }

}
