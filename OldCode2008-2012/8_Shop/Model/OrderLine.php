<?php
    namespace Shop\Model;
	
	/**
	 * Sparat undan frågan för att komma ihåg hur tabellen skapades 
	 *
	 * CREATE TABLE  `l6shop`.`shop_orderlines` (
			`m_orderLineId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`m_orderId` INT NOT NULL ,
			`m_productId` INT NOT NULL ,
			INDEX (  `m_orderId` ,  `m_productId` )
		) ENGINE = MYISAM ;
	 */
	
	/**
	 * Dataklass för en rad i varukorgen
	 */
	class OrderLine {
		public $m_orderLineId = 0;
		public $m_orderId = 0;
		public $m_productId = 0; 
		//public $m_numberOfProducts = 1;
	}
