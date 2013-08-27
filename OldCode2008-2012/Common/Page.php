<?php

  namespace Common;
  /**
   * Basic class to accumulate several properties of a webbpage
   * Used in order to let several controllers contribute to different parts of the (X)HTML document 
   * and still just return one object.
   *
   */
  class Page {
      
    //Properties of the document
    public $m_title = "";
    public $m_body = "";
    
    //Other properties one could ask for in such a class
    //public $m_css; //special css files only used by one controller
    //public $m_javascripts; //javascripts used
    //public $m_metaTags; //meta tags
    //public $m_redirectAdress; //dont generate output but redirect the user to this adress...
    //...
    
    
    
    /** Merges(adds) two Page object and returns the combined result 
     * $param Page $otherPage page to merge with
     * @return Page
     */
    public function Merge(Page $otherPage) {
      $ret = new Page();
      
      //Note $this must be used to access the member-variables of the object!!!
      $ret->m_title = $this->m_title . " " . $otherPage->m_title;
      $ret->m_body = $this->m_body . "\n" .$otherPage->m_body;
      
      return $ret;
    }
  }

