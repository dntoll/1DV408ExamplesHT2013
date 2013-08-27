<?php

namespace Model;

class ProductArray {
	private $m_products = array();
	
	public function __construct() {
		
	}
	
	public function add(Product $product) {
		$this->m_products[] = $product; 
	}
	
	public function get() {
		return $this->m_products;
	}
}

class Product {
	private $m_id; //Integer
	private $m_title; //String
	private $m_description; //String
	
	public function __construct($id, $title, $description) {
		$this->m_id = $id;
		$this->m_title = $title;
		$this->m_description = $description;
	}
	
	public function getId() {
		return $this->m_id;
	}
	
	public function getTitle() {
		return $this->m_title;
	}
	
	public function getDescription() {
		return $this->m_description; 
				
	}
}
