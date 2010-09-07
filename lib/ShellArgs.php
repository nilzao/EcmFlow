<?php

class knl_lib_ShellArgs extends knl_lib_Registry {
	private static $instance;
	private $argv;
	
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct(){}
    
    public function setShellArgs($args = array()){
    	$this->argv = $args;
    }
    
    public function getShellArg($argnum){
    	$shellArg = isset($this->argv[$argnum]) ? $this->argv[$argnum] : "";
    	return $shellArg;
    }
    
    public function getShellArgArray(){
    	return $this->argv;
    }
    
}
?>
