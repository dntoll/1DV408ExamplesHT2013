<?php

namespace model;

interface IProductList {

	
	/** getAllProducts?
	 * @return array of Product 
	 */
	public function getProductArray();

	/**
	 * Get product from unique index
	 * @param  String $uniqueIndex
	 * @return Product
	 */
	public function getProduct($uniqueIndex);


	/**
	 * @param  String  $uniqueIndex 
	 * @return boolean              
	 */
	public function hasProduct($uniqueIndex);
}