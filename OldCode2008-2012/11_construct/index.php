<?php



class Person {
	private $m_name = "";
	private $m_age = -1;
    
	private function __construct() {
		
	}
	/**
	 * @return Person
	 */
	public static function Create() {
		return new Person();
	}
	
	public static function CreateWithName($name) {
		$ret = new Person();
		
		$ret->m_name = $name;
		
		return $ret;
	}
	
	public static function CreateWithNameAndAge($name, $age) {
		$ret = new Person();
		$ret->m_name = $name;
		$ret->m_age = $age;
		return $ret;
	}
}

$daniel = Person::Create();
$daniel = Person::CreateWithName("Daniel");
$daniel = Person::CreateWithNameAndAge("Daniel", 33);

$nisse = new Person();

