<?php

class Model {

  private $m_state = 0;

  public function GetData() {
    return $this->m_state;
  }
  
  public function SetState($a_newState) {
    $this->m_state = $a_newState;
  }
}
