<?php

namespace View;

class ProductView {
	
	/**
	 * @return String HTML
	 */
	public function showProduct(\Model\Product $product) {
		
		$listLink = NavigationView::getProductListLink();
		$title = $product->getTitle();
		$description = $product->getDescription();
		return "
			<div>
				<h1>Product: $title</h1>
				
				$description
				<br/>
				<a href='$listLink'>Back to list</a>
			</div>
		";
	}
	
	/**
	 * @param  $productArray array (of \Model\Product)
	 */
	public function showListOfProducts(\Model\ProductArray $productArray) {
		
		$ret = "<h2>Products</h2>";
		$ret .= "<ul>";
		foreach ($productArray->get() as $product) {
			$linkToProduct = NavigationView::getProductLink($product);
			$ret .= "<li><a href='$linkToProduct'>" . $product->getTitle() . "</a></li>";
		}
		$ret .= "</ul>";
		
		return $ret;
	}
}
