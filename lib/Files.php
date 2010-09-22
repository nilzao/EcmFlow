<?php
class knl_lib_Files {
    private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

  public function getFilesFull(){
  	$files = isset($_FILES) ? $_FILES : array();
  	return $files; 
  }
  
  public function getFile($key){
  	$files = isset($_FILES[$key]) ? $_FILES[$key] : array();
  	return $files; 
  }
}
?>
