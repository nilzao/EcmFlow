<?php

abstract class knl_lib_Registry {
  
  public function getSession(){
    $tipo = "Session";
    return call_user_func("knl_lib_".$tipo."::getInstance");
  }
  

  public function getRequest(){
  	$request = knl_lib_Request::getInstance();
  	return $request;
  }

  public function getShellArgs()
  {
  	$shell = knl_lib_ShellArgs::getInstance();
  	return $shell;
  }

}
?>
