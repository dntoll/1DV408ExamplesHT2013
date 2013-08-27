<?php
namespace Shop\View;


/**
 * Responsibilities
 *  Handle navigation input/output
 *  Create links to different parts of the applikation(controllers)
 *  Handle navigation-input 
 *  Create main menu
 */
class NavigationView {

  //Menu alternatives
  const UserViewsProducts = "Product"; //single product displayed
  const UserViewsCategories = "Category"; //all products
  
  //Index Strings
  const ProductId = "ProductIndex";
  const CategoryIndex = "CategoryIndex";  
  
  private $m_userBuyButton = "didBuyProduct";
  
  /**
   * @return const active controller type
   */  
  public function GetActiveControllerType() {
    
    if (isset($_GET[NavigationView::CategoryIndex]) ) {
      return NavigationView::UserViewsCategories;
    }
    
    if (isset($_GET[NavigationView::ProductId]) ) {
      return NavigationView::UserViewsProducts;
    }
     
    //No input
    return NULL;
  }
  
  /**
   * @return int the selected category
   */
  public function GetActiveCategory() {
    if (isset($_GET[NavigationView::CategoryIndex]) ) {
      return $_GET[NavigationView::CategoryIndex];
    }
     
    return NULL;
  }
  
  /**
   * @return int the selected product id
   */
  public function GetSelectedProductId() {
    if (isset($_GET[NavigationView::ProductId]) ) {
      return $_GET[NavigationView::ProductId];
    } else {
      throw NULL;
    }
  }
  
  /**
   * Creates a XHTMl for the main menu
   *
   * @param array $categories string-array of categories key as index
   * @return string XHTML containing links to different categories
   */
  public function GetMenu($categories) {
    
    $page = new \Common\Page();
    $page->m_title = "Shop";
    $page->m_body = "
      <div> 

        <a href='?'>All Products</a> ";
        foreach ($categories as $catId => $cat) {
            $page->m_body .= "<a href='?" . NavigationView::CategoryIndex . "=$catId'>$cat</a> ";
        }
   $page->m_body .= "</div>
    ";
    return $page;
  }
  
  /** 
   * Used by ProductView to create links to a single product
   * 
   * @param int $productId index of the product
   * @param string $title what the link should contain
   * 
   * @return string XHTML containing a link to a product
   */
  public function GenerateProductLink($productId, $title) {
    return "<a href='?" . NavigationView::ProductId . "=$productId'>$title</a>";
  }
  
  /**
   * Används av produktvyn för att avgöra ifall en användare köpte den valda produkten
   */
  public function DidUserBuyProduct(\Shop\Model\Product $a_product) {
  	if (isset($_GET[$this->m_userBuyButton])) {
  		return true;
  	}
	return false;
  }
  
  /**
   * Skapa HTML för en köpknapp och navigera till produktvyn vid klick
   */
  public function GenerateBuyButton(\Shop\Model\Product $a_product) {
  	return "<a href='?" . NavigationView::ProductId . "=$a_product->pk&$this->m_userBuyButton=true'>Buy!!!</a>";
  }
  
  public function Relocate(\Shop\Model\Product $a_product) {
    header("Location: ?" . NavigationView::ProductId . "=$a_product->pk");
    return $page;
  }
  
}
