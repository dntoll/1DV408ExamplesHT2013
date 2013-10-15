<?php

namespace model;

class DatabaseProductList implements IProductList {


	public function __construct(\mysqli $mysqli) {

		$this->mysqli = $mysqli; 
	}

	/** getAllProducts?
	 * @return array of Product 
	 */
	public function getProductArray() {
		$sql = "SELECT `unique`, title, price FROM products";
		$stmt = $this->mysqli->prepare($sql);
		if ($stmt == FALSE) {
			throw new \Exception("prepare of [$sql] failed " . $this->mysqli->error);
		}
		
		$result = $stmt->execute();
		if ($result == FALSE) {
			throw new \Exception("execute of [$sql] failed " . $stmt->error);
		}

		$result = $stmt->bind_result($unique, $name, $priceSEK);
		if ($result == FALSE) {
			throw new \Exception("execute of [$sql] failed " . $stmt->error);
		}

	    $ret = array();

	    while ($stmt->fetch()) {
	        $ret[] = new Product($name, $unique, $priceSEK);
	    }

		return $ret;
	}

	/**
	 * Get product from unique index
	 * @param  String $uniqueIndex
	 * @return Product
	 */
	public function getProduct($uniqueIndex) {
		$sql = "SELECT `unique`, title, price FROM products WHERE `unique` = ?";
		$stmt = $this->mysqli->prepare($sql);
		if ($stmt == FALSE) {
			throw new \Exception("prepare of [$sql] failed " . $this->mysqli->error);
		}

		$result = $stmt->bind_param("s", $uniqueIndex);
		if ($result == FALSE) {
			throw new \Exception("execute of [$sql] failed " . $stmt->error);
		}
		
		$result = $stmt->execute();
		if ($result == FALSE) {
			throw new \Exception("execute of [$sql] failed " . $stmt->error);
		}

		$result = $stmt->bind_result($unique, $name, $priceSEK);
		if ($result == FALSE) {
			throw new \Exception("execute of [$sql] failed " . $stmt->error);
		}

	    $ret = array();

	    if ($stmt->fetch()) {
	        $ret[] = new Product($name, $unique, $priceSEK);
	        return $ret[0];
	    }

		throw new \Exception("no product with index exists");
	}


	/**
	 * @param  String  $uniqueIndex 
	 * @return boolean              
	 */
	public function hasProduct($uniqueIndex) {
		try {
			$this->getProduct($uniqueIndex);
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}
}