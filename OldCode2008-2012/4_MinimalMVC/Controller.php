<?php

class Controller {
	
  /*
   * 1. Check input
   * 2. Alter model
   * 3. Generate output
   * 
   * @return String HTML
   */
  public function DoControll(Model $model, View $view) {
    if ($view->HasInput()) {
      $model->SetState($view->GetInput());
    }
  
    $ret = $view->DoOutput($model->GetData());
    
    return $ret;
  }
}
