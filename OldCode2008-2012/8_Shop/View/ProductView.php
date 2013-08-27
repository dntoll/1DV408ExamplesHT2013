<?php

namespace Shop\View;


/**
 * Generates product specific output
 */
class ProductView {
  
  
  /**
   * Generates a List (really a table) of products
   * 
   * @param NavigationView $navigationView used in order to create proper links
   * @param array $products of Product objects
   * @return string XHTML string containing the products
   */
  public function GenerateProductList($products, NavigationView $navigationView) {
    $ret = "
            <table>
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>";
      
    foreach ($products as $key => $product) {
     $ret .= $this->GenerateProductLine($product, $key, $navigationView);
    }
    
    $ret .= "
            </tbody>
          </table>";
    
    return $ret;
  }
  
  /**
   * Used by GenerateProductList to create one table row containing a product
   * 
   * @param \Shop\Model\Product $product 
   * @param int $productId id of the product
   * @param NavigationView $navigationView used in order to create proper links
   * 
   * @return string XHTML string containing the product table row
   */
  private function GenerateProductLine(\Shop\Model\Product $product, $productId, NavigationView $navigationView) {
    $ret = "<tr>
              <td>
                " . $navigationView->GenerateProductLink($productId, $product->m_title) . "
              </td>
              <td>$product->m_price</td>
              
            </tr>";
            
    return $ret;
  }
  
  /**
   * Used by Describe a product
   * 
   * @param \Shop\Model\Product $product 
   *
   * @return string XHTML string containing the product description
   */
  public function GetProductPage(\Shop\Model\Product $product, 
  								 NavigationView $navigationView) {
    $page = new \Common\Page();
    
    $page->m_title = $product->m_title;
    
    $page->m_body = "
              <div>
                <h2>$product->m_title</h2>
                <p>$product->m_description</p>
                <h3>Price:  $product->m_price:-</h3>
                " . $navigationView->GenerateBuyButton($product) . "
              </div>";
    
    return $page;
    
  }
						
  /**
   * Generera felmeddelande och visa id på den produkt som saknas...
   */		 
  public function ProductNotFoundPage($productId) {
  	$page = new \Common\Page();
	$page->m_title = "Unknown product";
	$page->m_body = "<div>
						<h2>Product not found</h2>
						<p>Sorry cannot find the product you are looking for</p>
						<p>Product with id=$productId not found</p>
					</div>";
        
    return $page;
  }
  
  
}



