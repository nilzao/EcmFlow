<?php
class knl_lib_DataBase {
	public static $conn;
	
	private static function setDataBase(){
		if(empty(self::$conn)){
			$dbhost = knl_lib_Config::getInstance()->get_dbhost();
			$dbuser = knl_lib_Config::getInstance()->get_dbuser();
			$dbpassword = knl_lib_Config::getInstance()->get_dbpassword();
			$dbname = knl_lib_Config::getInstance()->get_dbname();
			self::$conn = NewADOConnection('mysqli');
			self::$conn->Connect($dbhost,$dbuser,$dbpassword,$dbname);
			self::$conn->EXECUTE("set names 'utf8'");
			self::$conn->debug = knl_lib_Config::getInstance()->get_dbdebug();
		}
	} 
	
	public static function getDataBase() {
		self::setDataBase();
		return self::$conn;
	}
}
?>
