<?php


namespace Shop\Model;

/**
 * Represents a product
 * 
 * Dataklass för produkter
 */
class Product {
  //TODO: byt namn på pk (även i tabell)
  public $pk = 0;
  public $m_title;
  public $m_desription;
  public $m_price;
  public $m_category;
  
  /**
   * Copies the properties to their member variables, this is used instead of constructor to 
   * Let the objects be created with different parameters, main reason for this is that I use fetch_object
   * to create objects...
   * 
   * This can also be done by using default parameters in the constructor like this:
   *  public function __construct($title = "", $description = "", $price = 0, $categoryId = 0)
   * 
   * @param string $title
   * @param string $description
   * @param int $price
   * @param int $categoryId
   */
  public static function Create($title, $description, $price, $categoryId) {
  	$ret = new Product();
	
    $ret->m_title = $title;
    $ret->m_description = $description;
    $ret->m_price = $price;
    $ret->m_category = $categoryId;
	
	return $ret;
  }  
  
}
