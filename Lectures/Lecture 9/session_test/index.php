<?php


session_start();

class SessionTest {
	private static $sessionLocation = "session_test";



	public function someFunc() {
		if (isset($_SESSION[self::$sessionLocation]) == false) {
			$_SESSION[self::$sessionLocation] = array();
			$_SESSION[self::$sessionLocation]["webbläsare"] = $_SERVER["HTTP_USER_AGENT"];
			$_SESSION[self::$sessionLocation]["ip"] = $_SERVER["REMOTE_ADDR"];
		}

		if ($_SESSION[self::$sessionLocation]["webbläsare"] != $_SERVER["HTTP_USER_AGENT"]) {
			echo "sessionstjuv!!!";	
			$_SESSION[self::$sessionLocation]["felaktig session"] = true;
		}

		if ($_SESSION[self::$sessionLocation]["ip"] != $_SERVER["REMOTE_ADDR"]) {
			echo "sessionstjuv ip!!!";	
		}


		var_dump($_COOKIE);



		if (isset($_COOKIE["somecookie"])) {
			//är det en giltig cookie?
			$cookieEndTime = file_get_contents("endtime.txt");
			echo "$cookieEndTime";

			if (time() > $cookieEndTime) {
				echo "cookie is too old";
			} else {
				echo "cookie is fine";
			}
		} 

		$endtime = time() + 10;

		file_put_contents("endtime.txt", "$endtime");
		setcookie("somecookie", "value", $endtime );

		}
}