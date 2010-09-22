<?php
abstract class knl_lib_Registry {
  
  public static function getSession(){
    $tipo = "Session";
    return call_user_func("knl_lib_".$tipo."::getInstance");
  }
  
  public static function getRequestObj(){
  	$request = knl_lib_Request::getInstance();
  	return $request;
  }

  public static function getShellArgs(){
  	$shell = knl_lib_ShellArgs::getInstance();
  	return $shell;
  }
  
  public static function getFiles(){
  	$files = knl_lib_Files::getInstance();
  	return $files;
  }

}
?>
