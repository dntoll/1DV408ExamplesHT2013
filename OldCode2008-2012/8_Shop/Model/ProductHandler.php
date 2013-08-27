<?php

namespace Shop\Model;

require_once("./Model/IProductHandler.php");

require_once("Product.php");


/**
 * Fejkklass som användes i början för att visa hur vi kan byta ut delar av applikationen mha interface
 * Den klass som används är istället 'ProductHandlerWithDB'
 * 
 * The product handler contains all products and provides access to them
 * In order to simplify this example, no database access is used but arrays created on startup
 * 
 * This class would be a great place to place DB access code to select data
 */
class ProductHandler implements IProductHandler{
  
  private $m_products = array(); //used instead of a DB
  private $m_categories = array("TV", 
                                "Computers");
  
  public function __construct() {
    
    $this->GenerateFakeDB();
    
  }
  
  /**
   * Temporary function to fake a database access
   */
  private function GenerateFakeDB() {
    
    //TVs        
    $this->m_products[] = Product::Create("Samsung TV", "50\" tv with remote", 2500, 0);
    $this->m_products[] = Product::Create("Philips TV", "45\" tv with remote", 2000, 0);
    $this->m_products[] = Product::Create("Sony TV", "40\" tv with remote", 1500, 0);
    $this->m_products[] = Product::Create("Tony TV", "30\" tv with remote", 1000, 0);
    $this->m_products[] = Product::Create("TV", "20\" tv with remote", 500, 0);
    $this->m_products[] = Product::Create("Another TV", "20\" tv with remote", 500, 0);
    //Computers
    $this->m_products[] = Product::Create("Dell Inspiron 620", "För dig som vill ha en tillförlitlig, 
                                                            lättanvändlig, stationär hemdator med hög produktivitet och anslutningar för upp till 8 medieenheter, 
                                                            två storlekar, Classic Black och uppgradering till 4 starka färger som tillval. ", 4790, 1);
  }
  
  /**
   * @return array of Product objects indexed by id
   */
  public function GetAllProducts() {
    return $this->m_products;
  }  
  
  /**
   * @return array of string category stings indexed by id
   */
  public function GetCategories() {
    return $this->m_categories;
  }
  
  /**
   * @param int $productId product-index
   * @return Product the selected product or NULL
   */
  public function GetProductById($productId) {
    if (isset($this->m_products[$productId]) )
      return $this->m_products[$productId];
    else 
      return NULL;
  }
  
  /**
   * @param int $categoryId category index
   * @return array of string category stings indexed by id
   */
  public function GetProductsByCategory($categoryId) {
    $ret = array();
    
    foreach ($this->m_products as $key => $product) {
      if ($product->m_category == $categoryId) {
        $ret[$key] = $product; //note that id is index
      }
    }
    
    return $ret;
  }
  
}
