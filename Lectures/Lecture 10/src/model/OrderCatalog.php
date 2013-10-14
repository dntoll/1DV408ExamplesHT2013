<?php

namespace model;

class OrderCatalog {
	/**
	 * @param Order $order [description]
	 */
	public function add(Order $order) {
		var_dump($order);		

		$orderString = $this->getOrderString($order);
		
		$checksum = md5($orderString);
		$file = "./orders/$checksum.txt";

		file_put_contents($file, $orderString );
	}



	private function getOrderString(Order $order) {

		$ret = "Order: \n";
		$ret .= "Adress: ";
		$ret .= $order->getAdress()->getStreet() . "\n";

		foreach ($order->getCart()->getProductLines() as $key => $productLine) {
			$product = $productLine->getProduct();
			$name = $product->getName();
			$costSEK = $product->getCostSEK();
			$amount = $productLine->getAmount();
			$totalSEK = $productLine->getTotalSEK();

			$ret .= "$name $amount x $costSEK = $totalSEK SEK\n";
		}
		$sum = $order->getCart()->getSumSEK();
		$ret .= "Totalkostnad : $sum SEK\n";

		return $ret;
	}
}