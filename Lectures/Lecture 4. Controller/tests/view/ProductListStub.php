<?php


class ProductListStub extends \view\ProductList {

	private $buyProduct = null;

	public function setProductToBuy(\Model\Product $product) {
		$this->buyProduct =$product;
	}

	public function userBuysProduct() {
		return $this->buyProduct != null;
	}
}