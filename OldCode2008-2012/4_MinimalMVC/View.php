<?php

class View {
  private $m_getPosition = "SOME_UNIQUE_INDEX";
  
  public function HasInput() {
    return isset($_GET[$this->m_getPosition]);
  }
  
  public function GetInput() {
    return $_GET[$this->m_getPosition];
  }
  
  public function DoOutput($a_state) {
    return "
    <html> <!-- mm... not standard... -->
      <body>
        <div>The model is in '$a_state' state</div>
        
        <div>
          <a href='?$this->m_getPosition=1'>One</a>
          <a href='?$this->m_getPosition=2'>Two</a>
          <a href='?$this->m_getPosition=3'>Three</a>
          <a href='?'>No input</a>
        </div>
      </body>
    </html>
    ";
  }
}
