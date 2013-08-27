<?php


require_once("./Views/SelectColorViewBase.php");
require_once("./Views/ColorView.php");


/**
 * Controller to show basic Controller behaviour and use of views
 *  1. Collect input
 *  2. React to input
 *  3. Generate output
 **/
class ColorInputController {
  private $m_selectColorView;
  
  public function __construct(SelectColorViewBase $selectColorView) {
  	$this->m_selectColorView = $selectColorView;
  }
  
  /**
   * @return Page instance
   **/
  public function DoControll() {
    //Create view instances
    
    $colorView = new ColorView();
    
    //Collect input from user
    $selectedColor = $this->m_selectColorView->GetUserselectedColor();
    
    
    //React to input
    switch ($selectedColor) {
        case SelectColorViewBase::RED   : $colorBox = $colorView->DoRedBox(); break;
        case SelectColorViewBase::GREEN : $colorBox = $colorView->DoGreenBox(); break;
        default 					: $colorBox = $colorView->DoWhiteBox();
    }
    
    //Generate output
    $page = new Page();
    $page->m_title = "Select the color";
    $page->m_body .= $this->m_selectColorView->DoSelectionMenu();
    $page->m_body .= $colorBox;
    return $page;
  }
}
