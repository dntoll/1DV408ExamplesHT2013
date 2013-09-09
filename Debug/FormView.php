<?php

require_once("UserName.php");

class FormView {
	private static $name = "NameOfUser";
	private static $button = "button";
	public function getHTML() {
		return "<form action='?' method='post'>
					User name: <input type='text' name='" . self::$name . "'>
					</input>
					<input type='submit' name='" . self::$button . "'/>
				</form>";

	}

	/**
	 * @return \model\UserName [description]
	 */
	public function getUserName() {

		assert($this->hasUserName());

		$fromClient = rtrim($_POST[self::$name]);

		return new \model\UserName($fromClient);
	}
	
	/**
	 * @return boolean [description]
	 */
	public function hasUserName() {
		return isset($_POST[self::$name]);
	}
}