<?php

require_once("./Views/ColorView.php");
require_once("./Views/FormColorView.php");

/** 
 * Example controller
 * Note:
 *  Looks very similar to InputExampleController!!!
 *    Only view differs...
 *    -> Refactor to one class and abstract view!
 */
class FormInputController {

  /** 
   * @return Page instance
   **/
  public function DoControll() {
    //Create view instances
    $selectColorView = new FormColorView();
    $colorView = new ColorView();
    
    //Collect input from user
    $selectedColor = $selectColorView->GetUserselectedColor();
    
    
    //React to input
    switch ($selectedColor) {
        case FormColorView::RED   : $colorBox = $colorView->DoRedBox(); break;
        case FormColorView::GREEN : $colorBox = $colorView->DoGreenBox(); break;
        default                   : $colorBox = $colorView->DoWhiteBox(); 
    }
    
    //Generate output
    $page = new Page();
    $page->m_title = "Select the color";
    $page->m_body .= $selectColorView->DoSelectionMenu();
    $page->m_body .= $colorBox;
    return $page;
  }
}
