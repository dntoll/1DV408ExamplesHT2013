<?php


class DebugView {
	
	public function getDebugData() {
		
		$dumps = "
			<h2>Debug</h2>
			<table>
				<tr>
					<td>";
		
		$dumps .= $this->arrayDump($_GET, "GET");
		$dumps .= $this->arrayDump($_POST, "POST");
		$dumps .= $this->arrayDump($_COOKIE, "COOKIES");
		//$dumps .= $this->arrayDump($_SERVER, "SERVER");
		$dumps .= $this->arrayDump($_SESSION, "SESSION");
		
		
		
		$dumps .= "
					</td>
				   
				   </table>";
		return $dumps;
	}
	
	
	private function arrayDump($array, $title) {
		$ret = "<h3>$title</h3>
		
				<ul>";
		foreach ($array as $key => $value) {
			$value = htmlspecialchars($value);
			$key = htmlspecialchars($key);
			$ret .= "<li>$key => [$value]</li>";
		}
		$ret .= "</ul>";
		return $ret;
	}
}
