<?php

require_once("./Views/SelectColorView.php");
require_once("./Views/ColorView.php");


/**
 * Controller to show basic Controller behaviour and use of views
 *  1. Collect input
 *  2. React to input
 *  3. Generate output
 **/
class InputExampleController {

  /**
   * @return Page instance
   **/
  public function DoControll() {
    //Create view instances
    $selectColorView = new SelectColorView();
    $colorView = new ColorView();
    
    //Collect input from user
    $selectedColor = $selectColorView->GetUserselectedColor();
    
    
    //React to input
    switch ($selectedColor) {
        case SelectColorView::RED   : $colorBox = $colorView->DoRedBox(); break;
        case SelectColorView::GREEN : $colorBox = $colorView->DoGreenBox(); break;
        default 					: $colorBox = $colorView->DoWhiteBox();
    }
    
    //Generate output
    $page = new Page();
    $page->m_title = "Select the color";
    $page->m_body .= $selectColorView->DoSelectionMenu();
    $page->m_body .= $colorBox;
    return $page;
  }
}
