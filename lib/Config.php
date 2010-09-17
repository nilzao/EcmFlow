<?php
class knl_lib_Config {
	private static $instance;
	private $dbhost;
	private $dbuser;
	private $dbpassword;
	private $dbname;
	private $dbdebug;
	private $dbdriver;
	
	private function __construct(){}
	
	public static function getInstance(){
		if (!isset(self::$instance)){
  			self::$instance = new self();
	  	}
	  	self::$instance->dbhost = "localhost";
		self::$instance->dbuser = "root";
		self::$instance->dbpassword = "";
		self::$instance->dbname = "ecmflow";
		self::$instance->dbdebug = false;
		self::$instance->dbdriver = 'mysqli';
	  	return self::$instance;
	}
	
	public function get_dbhost(){
		return $this->dbhost;
	}
	
	public function get_dbuser(){
		return $this->dbuser;
	}
	
	public function get_dbpassword(){
		return $this->dbpassword;
	}
	
	public function get_dbname(){
		return $this->dbname;
	}
	
	public function get_dbdebug(){
		return $this->dbdebug;
	}
	
	public function get_dbdriver(){
		return $this->dbdriver;
	}
}
?>