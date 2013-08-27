<?php

/**
 * A view that only generates output 
 * This view is/can be used from several controllers
 */
class ColorView {
  
  
  public function DoRedBox() {
    return "<div class='red'></div>";
  }
  
  public function DoGreenBox() {
    return "<div class='green'></div>";
  }
  
  public function DoWhiteBox() {
    return "<div class='white'></div>";
  }

}
