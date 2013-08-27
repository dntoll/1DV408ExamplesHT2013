<?php



namespace Shop\Model;



require_once("ProductDAL.php");


/**
 * The product handler contains all products and provides access to them
 */
class ProductHandler implements IProductHandler{
  private $m_productDAL = NULL;
  private $m_products = array(); //used instead of a DB
  private $m_categories = array("TV", 
                                "Computers");
  
  public function __construct(\DBConnection $connection) {
    $this->m_productDAL = new ProductDAL($connection);
  }
  
  
  /**
   * @return array of Product objects indexed by id
   */
  public function GetAllProducts() {
    return $this->m_productDAL->GetAllInstances();
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
  	
    return $this->m_productDAL->SelectByPk($productId);
  }
  
  /**
   * @param int $categoryId category index
   * @return array of string category stings indexed by id
   */
  public function GetProductsByCategory($categoryId) {
    return $this->m_productDAL->SelectBy("m_category", $categoryId);
  }
  
}
