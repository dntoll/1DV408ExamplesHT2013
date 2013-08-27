<?php
    
namespace Shop\Model;


/**
 * Interface för att kunna byta ut produkthanterare
 * 
 * Jämför ProductHandler som är utan databas med ProductHandlerWithDB
 * 
 * Båda implementerar interfacet.
 */
interface IProductHandler {
	
		/**
		 * @return array
		 */
		public function GetCategories();
		
		/**
	    * @return array of Product objects indexed by id
	    */
		public function GetAllProducts();
		
		/**
		 * @return Product
		 */
		public function GetProductById($a_id);
		
		/**
		 * @return array of Product objects indexed by id
		 */
		public function GetProductsByCategory($a_id);
		
		
}