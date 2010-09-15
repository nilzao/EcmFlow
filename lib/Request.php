<?php

class knl_lib_Request extends knl_lib_Registry {
    private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

  public function getRequest($key){
  	$request = isset($_REQUEST[$key]) ? $_REQUEST[$key] : "";
  	return $request; 
  }
  
  public function getPost($key){
  	$post = isset($_POST[$key]) ? $_POST[$key] : "";
  	return $post; 
  }

  public function getGet($key){
  	$get = isset($_GET[$key]) ? $_GET[$key] : "";
  	return $get; 
  }

}
?>