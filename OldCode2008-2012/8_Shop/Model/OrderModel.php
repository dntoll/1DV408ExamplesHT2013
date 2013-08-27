<?php
    namespace Shop\Model;
	
	require_once("./Model/OrderLine.php");
	
	
	/**
	 * Representerar två saker 
	 * 	1. Aktiv order(varukorg) som lagras som id i sessionen
	 *  2. Håller databasuppkopplingen för Order och OrderLines
	 */
	class OrderModel {

		//Tabellnamn		
		private $m_orderTableName = "Order";
		private $m_orderLineTableName = "OrderLines";
		
		//Databasuppkoppling
		private $m_dbConnection = NULL;
		
		//Sessionsplats
		private $m_orderIdSessionLocation = "OrderModel::m_orderId";
		
		
		public function __construct(\Common\DBConnection $connection, $tablePrefix) {
			//se till att vi inte kan skapa en instans utan att ha en session
			if (isset($_SESSION) == false) {
				throw new \Exception("OrderModel kräver session!");
			}
			
			$this->m_dbConnection = $connection;
			
			//Skapa tabellnamn med hjälp utav prefix
			$this->m_orderTableName = $tablePrefix . $this->m_orderTableName;
			$this->m_orderLineTableName = $tablePrefix . $this->m_orderLineTableName;
			
			
			
		}
		
		public function BuyProduct(Product $product) {
			//Har jag en aktiv order?
			if (isset($_SESSION[$this->m_orderIdSessionLocation]) == false) {
				//skapa en order och spara orderid
				$_SESSION[$this->m_orderIdSessionLocation] = $this->CreateNewOrder();
			}
			//TODO:
			//finns det en orderline för den här produkten redan?
				//hämta den och öka antalet
			//annars skapa en orderline
			$orderLine = new OrderLine();
			$orderLine->m_orderId = $_SESSION[$this->m_orderIdSessionLocation];
			$orderLine->m_productId = $product->pk;
			
			//spara till databasen
			$this->SaveOrderLine($orderLine);
		}
		
		/**
		 * Skapa en ny order
		 * Just nu är det bara orderid som är intressant
		 * 
		 * @return int orderid
		 */
		private function CreateNewOrder() {
			$sql = "INSERT INTO $this->m_orderTableName () VALUES()";
		
			$stmt = $this->m_dbConnection->Prepare($sql);
			
			if ($stmt === FALSE) {
				return false;
			}
			
			$stmt->execute();
			
			$ret = $stmt->insert_id; //returnera primärnyckeln
			
			$stmt->close();
			
			return $ret;
		}
		
		/**
		 * Spara en NY orderline i databasen
		 */
		private function SaveOrderLine(OrderLine $orderLine) {
			$sql = "INSERT INTO $this->m_orderLineTableName (m_orderId, m_productId) VALUES(?,?)";
		
			$stmt = $this->m_dbConnection->Prepare($sql);
			
			$stmt->bind_param("ii", $orderLine->m_orderId, $orderLine->m_productId);
			
			if ($stmt === FALSE) {
				return false;
			}
			
			$stmt->execute();
			
			//sätter indexet i objektet (används dock inte)
			$orderLine->m_orderLineId = $stmt->insert_id;
			
			$stmt->close();
			
			return $orderLine;
		}
		
		/**
		 * Hämta ut de orderrader som hör till ordern som ligger i sessionen
		 * 
		 * TODO: borde ta en parameter istället för $_SESSION[$this->m_orderIdSessionLocation]
		 * 
		 * @return array of OrderLine
		 */
		public function GetOrderLines() {
			$sql = "SELECT * FROM $this->m_orderLineTableName WHERE m_orderId = ?";
		
			$stmt = $this->m_dbConnection->Prepare($sql);
			
			$stmt->bind_param("i", $_SESSION[$this->m_orderIdSessionLocation]);
			
			$arr = $this->m_dbConnection->RunAndFetchObjects($stmt, "\Shop\Model\OrderLine", "m_orderLineId");
			
			return $arr;			
		}
	}
